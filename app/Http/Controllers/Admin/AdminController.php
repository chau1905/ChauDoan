<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::select('orders.id', 'orders.status', 'orders.total', 'tables_position.name', 'orders.updated_at')
//            ->groupBy('orders.table_id')
            ->where('orders.status', Order::ORDER)
            ->join('tables_position', 'orders.table_id', '=', 'tables_position.id')
            ->orderBy('orders.created_at', 'DESC')
            ->paginate(DEFAULT_PAGINATION_PER_PAGE);

        return view('admin.index', ['orders' => $orders]);
    }

}
