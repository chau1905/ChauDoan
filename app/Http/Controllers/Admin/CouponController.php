<?php

namespace App\Http\Controllers\Admin;

use App\Coupon;
use App\Http\Requests\CouponRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Webpatser\Uuid\Uuid;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        $categories = Coupon::select('id','uuid', 'timestart', 'timeend','quantity', 'price');
        $categories = $categories->orderBy('id', 'DESC')
            ->paginate(DEFAULT_PAGINATION_PER_PAGE);
        return view('admin.coupon.index', ['categories' =>$categories]);
    }

    public function form_add()
    {
        return view('admin.coupon.add');
    }

    public function add(CouponRequest $request)
    {

        Coupon::insert(
            [
                'uuid' => str_random(13),
                'price' => $request->input('price'),
                'quantity' => $request->input('quantity'),
                'timestart' => Carbon::parse($request->input('timestart')),
                'timeend' => Carbon::parse($request->input('timeend'))
            ]
        );

        return redirect(route('coupon.index'))
            ->with('alert-success', trans('messages.successfully_created', ['name' => 'Coupon']));
    }
}
