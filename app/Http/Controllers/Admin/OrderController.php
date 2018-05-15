<?php

namespace App\Http\Controllers\Admin;

use App\Coupon;
use App\Http\Requests\AddOrderRequest;
use App\Http\Requests\EditOrderRequest;
use App\Http\Requests\MenuOrderRequest;
use App\Http\Requests\MergeOrderRequest;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\Http\Controllers\Controller;
use App\TablePosition;
use Carbon\Carbon;
class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::select('orders.id', 'orders.status', 'orders.total', 'tables_position.name', 'orders.updated_at')
//            ->groupBy('orders.table_id')
            ->join('tables_position', 'orders.table_id', '=', 'tables_position.id')
            ->orderBy('orders.created_at', 'DESC')
            ->paginate(DEFAULT_PAGINATION_PER_PAGE);
        return view('admin.order.index', ['orders' => $orders]);
    }

    public function form_add()
    {
        $orders = Order::select('table_id')->whereIn('status', [Order::ORDER, Order::UNPAID])->get();
        $idNotOrder = [];
        foreach ($orders as $order) {
            $idNotOrder[] = $order->table_id;
        }
        $tables = TablePosition::select('id', 'name')
            ->whereNotIn('id', $idNotOrder)
            ->get();
        $products = Product::select('id', 'name', 'price')->get();
        return view('admin.order.add', ['tables'=> $tables, 'products' => $products]);
    }

    public function add(AddOrderRequest $request)
    {

        if(!count($request->input('product')) > 0) {
            return redirect()->back()->with('alert-warning', 'Không có sản phẩm nào, vui lòng chọn sản phẩm');
        }
        $products = Product::select('price')->whereIn('id', $request->input('product'))->get();

        $total = 0;

        foreach ($products as $pro) {
            $total += $pro->price;
        }

        $order = Order::create([
            'table_id' =>$request->input('table'),
            'total' => $total,
            'status' => Order::ORDER,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        foreach ($request->input('product') as $cart) {
            OrderDetail::create([
                'order_id' =>$order->id,
                'product_id' => $cart,
                'total' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
        return redirect()->route('order.index')->with('alert-success', 'Order thành công');

    }
    public function form_edit($id)
    {
        $orders = OrderDetail::select('products.name', 'order_detail.total', 'products.price')
            ->leftJoin('products', 'order_detail.product_id', '=', 'products.id')
            ->where('order_detail.order_id', trim($id))->get();

        $status = Order::select('orders.id', 'orders.status', 'orders.total')
            ->where('id', $id)
            ->firstOrFail();

        return view('admin.order.edit', ['orders' =>$orders, 'status'=> $status]);
    }
    public function edit($id, EditOrderRequest $request)
    {

        $order = Order::select('total')->where('id', trim($id))->first();

        $subTotal = 0;

        if($request->has('coupon') && !empty($request->get('coupon'))) {
            $coupon = Coupon::select('price', 'quantity')->where('uuid', $request->get('coupon'))
                ->where('timestart', '<', Carbon::now())
                ->where('timeend', '>', Carbon::now())
                ->first();
            if (count($coupon) > 0) {
                $subTotal = $coupon->price;

                $quantity = ($coupon->quantity - 1) > 0 ? $coupon->quantity - 1 : 0;
                $coupon->update(['quantity'=> $quantity]);
            }
        }

        $total = $order->total - $subTotal;

        if($total < 0) {
            $total = 0;
        }

        $data = [
            'status' => $request->input('status'),
            'total' => $total,
            'updated_at' => Carbon::now()
        ];

        Order::where('id', trim($id))->update($data);

        return redirect(route('order.index'))
            ->with('alert-success', trans('messages.successfully_updated', ['name' => 'Cập nhật đơn hàng']));
    }

    public function form_merge($id)
    {
        $tables = Order::select('tables_position.id', 'tables_position.name')
            ->join('tables_position', 'orders.table_id', '=', 'tables_position.id')
            ->where('orders.id', '<>', $id)
            ->whereIn('orders.status', [Order::ORDER, Order::UNPAID])
            ->distinct()
            ->get();
        return view('admin.order.merge', ['tables' =>$tables, 'id'=>$id]);


    }

    public function merge(MergeOrderRequest $request)
    {
//        'table' => 'required|integer',
//            'id_order' => 'required|integer',
        $order = Order::select('id', 'table_id', 'total')->where('table_id', $request->input('table'))
            ->whereIn('status', [Order::ORDER, Order::UNPAID])
            ->first();


        $orderSend = Order::select('id', 'table_id', 'total')->where('id', $request->input('id_order'))->firstOrFail();

        $orderDetail = OrderDetail::select('id')->where('order_id', $order->id)->get();

        if(!count($orderDetail) > 0) {
            return redirect(route('order.index'))
                ->with('alert-warning', 'Đã có lỗi xả ra vui lòng thử lại');
        }

        foreach ($orderDetail as $data) {
            OrderDetail::where('id', $data->id)
                ->update(['order_id' => $request->input('id_order')]);
        }

        $total = $order->total + $orderSend->total;

        $orderSend->update(['total' => $total]);

        Order::where('id', $order->id)->delete();

        return redirect(route('order.index'))
            ->with('alert-success', 'Gộp bàn thành công');


    }


    public function menu_form($id)
    {
        $products = Product::select('id', 'name', 'price')->get();
        return view('admin.order.add_menu', ['id'=> $id, 'products' => $products]);

    }

    public function menu(MenuOrderRequest $request)
    {

        if(!count($request->input('product')) > 0) {
            return redirect()->back()->with('alert-warning', 'Không có sản phẩm nào, vui lòng chọn sản phẩm');
        }
        $products = Product::select('price')->whereIn('id', $request->input('product'))->get();

        $total = 0;

        foreach ($products as $pro) {
            $total += $pro->price;
        }
//        dd($total);

        foreach ($request->input('product') as $cart) {
            OrderDetail::create([
                'order_id' =>$request->input('id_order'),
                'product_id' => $cart,
                'total' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        $order = Order::select('total')->where('id', $request->input('id_order'))->firstOrFail();
//        dd($order);
        $total += $order->total;

        Order::where('id', $request->input('id_order'))->update(['total' => $total]);

        return redirect()->route('order.index')->with('alert-success', 'Order thành công');
    }


    public function printOrder($id)
    {
        $orders = OrderDetail::select('products.name', 'order_detail.total', 'products.price', 'order_detail.created_at')
            ->leftJoin('products', 'order_detail.product_id', '=', 'products.id')
            ->where('order_detail.order_id', trim($id))->get();
        $price = Order::select('total')->where('id', $id)->first();


        return view('admin.order.print', ['orders' => $orders, 'price'=>$price->total]);

    }
}
