@extends('admin.layout.app')
@section('title', 'index')
@section('content')
    <div class="inner-block">
        <div class="pro-head">
            <h2>Danh sách order</h2>
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
        @if(count($carts) > 0)
        <table class="table table-bordered" style="margin-top: 50px;">
            <thead>
            <tr>
                <th>{{trans('messages.stt_lable')}}</th>
                <th>{{trans('messages.image')}}</th>
                <th>{{trans('messages.product')}}</th>
                <th>{{trans('messages.quantity')}}</th>
                <th>{{trans('messages.price_product_lable')}}</th>
                <th>{{trans('messages.total_money')}}</th>
                <th width="80px"></th>
            </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                    $total = 0;
                @endphp
                @forelse($carts as $cart)
                    <tr>
                        <td>{{$i}}</td>
                        <td><img src="{{asset('/storage/product/'.$cart->options->image)}}" style="max-height: 50px;" alt="{{$cart->name}}"></td>
                        <td>{{$cart->name}}</td>
                        <td>
                            <form action="{{route('cart_update', $cart->rowId)}}" method="post" enctype="multipart/form-data">
                                {{ method_field('PUT')}}
                                {{ csrf_field() }}
                                <input type="number" name="quantity" value="{{$cart->qty}}">
                                <button type="submit"><i class="fa fa-repeat" aria-hidden="true"></i></button>
                            </form>
                        </td>
                        <td>{{number_format($cart->price, 0, ',', '.')}} {{trans('messages.money')}}</td>
                        <td>{{number_format($cart->subtotal, 0, ',', '.')}} {{trans('messages.money')}}</td>
                        <td><a href="{{route('cart_delete', $cart->rowId)}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                    </tr>
                    @php
                        {{$i ++;}}
                        $total = $total + $cart->subtotal;
                    @endphp
                @empty
                    <tr>
                        <td colspan="6">{{trans('messages.no_data')}}</td>
                    </tr>
                @endforelse
                    <tr>
                        <td colspan="6">{{trans('messages.total_price')}}</td>
                        <td>{{number_format($total, 0, ',', '.')}} {{trans('messages.money')}}</td>
                    </tr>
            </tbody>
        </table>
        <form action="{{route('cart_order')}}" method="post" style="margin: 30px 0px;">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputEmail1">Chọn bàn</label>
                <select class="form-control" id="sel1" name="position">
                    <option value="">Vui lòng chọn bàn</option>
                    @foreach($positions as $position)
                     <option value="{{$position->id}}">{{$position->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" id="exampleInputPassword1" name="total" value="{{$total}}">
            </div>
            <button type="submit" class="btn btn-success">Order</button>
        </form>
        @else
            <h1 class="text-center" style="padding-bottom: 300px;padding-top: 50px;">Vui lòng thêm sản phẩm vào order</h1>
        @endif

    </div>
@endsection