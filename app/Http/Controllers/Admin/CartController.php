<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CartUpdateRequest;
use App\Http\Requests\OrderRequest;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\TablePosition;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{

    public function cart($id)
    {
            $product = Product::select('id', 'price', 'name', 'image')
                ->where('id', trim($id))
                ->firstOrFail();
        Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => 1, 'price' => $product->price, 'options' => ['image' => $product->image]]);
        return redirect()->back()->with('alert-success', 'Sản phẩm đã được thêm vào order');
    }

    public function all_cart()
    {
        $carts = Cart::content();

            $orders = Order::select('table_id')->whereIn('status', [Order::ORDER, Order::UNPAID])->get();
        $idNotOrder = [];
        foreach ($orders as $order) {
            $idNotOrder[] = $order->table_id;
        }
        $positions = TablePosition::select('id', 'name')
            ->whereNotIn('id', $idNotOrder)
            ->get();

        return view('admin.cart', ['carts' => $carts, 'positions' => $positions]);
    }
    public function delete($rowId)
    {
        Cart::remove($rowId);
        return redirect()->back()->with('alert-success', 'Xóa thành công');

    }
    public function update($rowId, CartUpdateRequest $request) {
        Cart::update($rowId, $request->input('quantity')); // Will update the quantity
        return redirect()->back()->with('alert-success', 'Cập nhật thành công');
    }

    public function order(OrderRequest $request)
    {

        $carts = Cart::content();
        if(!count($carts) > 0) {
            return redirect()->back()->with('alert-warning', 'Order không được rỗng');
        }
        $order = Order::create([
            'table_id' =>$request->input('position'),
            'total' =>$request->input('total'),
            'status' => Order::ORDER,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        foreach ($carts as $cart) {
            OrderDetail::create([
                'order_id' =>$order->id,
                'product_id' => $cart->id,
                'total' => $cart->qty,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
        Cart::destroy();
        return redirect()->route('order.index')->with('alert-success', 'Order thành công');

    }
}
