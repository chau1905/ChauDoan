@extends('admin.layout.app')
@section('title', 'order')
@section('content')
    <div class="inner-block">
        <div class="pro-head">
            <h2>Chỉnh sửa order
                <a href="{{route('order.menu_form', $status->id)}}" class="btn btn-success pull-right">Thêm thực đơn</a>order.menu_form
                <a href="{{route('order.form_merge', $status->id)}}" class="btn btn-warning pull-right" style="margin-left: 10px;margin-right: 10px;">Gộp bàn</a>
            </h2>
        </div>
        <div class="error">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="col-md-12 product-grid">
            <form action="{{route('order.edit', $status->id)}}" method="post" role="form" class="form-add-info">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="">{{trans('messages.status')}}</label>
                    @if($status->status == \App\Order::ORDER)
                    <select class="form-control <?php echo $errors->has('status') ? 'input-error' : '';?>" name="status">
                        <option value="{{\App\Order::UNPAID}}">Chưa thanh toán</option>
                        <option value="{{\App\Order::PAID}}">Đã thanh toán</option>
                        <option value="{{\App\Order::CANCEL}}">Đã hủy</option>
                    </select>
                    @elseif($status->status == \App\Order::UNPAID)
                        <select class="form-control <?php echo $errors->has('status') ? 'input-error' : '';?>" name="status">
                            <option value="{{\App\Order::PAID}}">{{trans('messages.paid')}}</option>
                        </select>
                    @endif

                </div>
                <div class="form-group">
                    <input type="text" value="{{old('coupon')}}" placeholder="mã giảm giá nếu có" name="coupon" class="form-control <?php echo $errors->has('coupon') ? 'input-error' : '';?>">
                </div>
                <button type="submit" class="btn btn-warning submit-form">{{trans('messages.edit_lable')}}</button>
            </form>
        </div>
        <h2>{{trans('messages.list_product_lable')}}</h2>
        <table class="table table-condensed">
            <thead>
            <tr>
                <th>{{trans('messages.name_product_lable')}}</th>
                <th>{{trans('messages.quantity')}}</th>
                <th>Giá tiền</th>
                <th width="80px"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{$order->name}}</td>
                    <td>{{$order->total}}</td>
                    <td>{{number_format($order->price*$order->total, 0 , ',', '.')}} vnđ</td>
                </tr>
            @empty
                <tr>
                    <td colspan="12"><h2 class="text-center no_data">{{ trans('messages.no_data') }}</h2></td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection