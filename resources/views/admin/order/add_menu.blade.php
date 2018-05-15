@extends('admin.layout.app')
@section('title', 'Thêm order mới')
@section('content')
    <div class="inner-block">
        <div class="product-block">
            <div class="pro-head">
                <h2>Thêm order</h2>
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
                <form action="{{route('order.menu')}}" method="POST" role="form" class="form-add-info">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="checkbox">
                            @foreach($products as $product)
                                <label><input type="checkbox" value="{{$product->id}}" name="product[]">{{$product->name}} - {{number_format($product->price, 0, ',', '.')}} vnđ</label>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="id_order" value="{{$id}}">
                    </div>
                    <button type="submit" class="btn btn-primary submit-form">Thêm order</button>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
@endsection