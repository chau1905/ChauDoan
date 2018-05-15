@extends('admin.layout.app')
@section('title', 'order')
@section('content')
    <div class="inner-block">
        <h2>Các order chưa xử <lí></lí></h2>
        <table class="table table-condensed">
            <thead>
            <tr>
                <th>{{trans('messages.time')}}</th>
                <th>Tên bàn</th>
                <th>Trạng thái</th>
                <th>Số tiền</th>
                <th width="80px"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{$order->updated_at}}</td>
                    <td>{{$order->name}}</td>
                    <td>
                        @if($order->status == \App\Order::PAID)
                            Đã thanh toán
                        @elseif($order->status == \App\Order::UNPAID)
                            Chưa thanh toán
                        @elseif($order->status == \App\Order::ORDER)
                            Đang order
                        @elseif($order->status == \App\Order::CANCEL)
                            Đã hủy
                        @endif
                    </td>
                    <td>{{number_format($order->total, 0, ',', '.')}} {{trans('messages.money')}}</td>
                    <td>
                        @if($order->type == \App\Order::UNPAID || $order->type == \App\Order::ORDER)
                            <a href="{{route('order.edit.form', $order->id)}}" class="btn btn-warning ">{{trans('messages.edit_lable')}}</a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="12"><h2 class="text-center no_data">{{ trans('messages.no_data') }}</h2></td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <!-- pagination -->
        <div class="row text-center">
            {{ $orders->links() }}
        </div>
    </div>
@endsection