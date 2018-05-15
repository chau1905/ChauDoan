@extends('admin.layout.app')
@section('title', 'product')
@section('content')
    <div class="inner-block">
        <div class="product-block">
            <div class="pro-head">
                <h2>{{trans('messages.list_product_lable')}}
                </h2>
            </div>
            <div class="col-md-12" style="margin-top: 20px;margin-bottom: 30px;">
                <form action="{{route('product.index')}}" method="get" role="form" class="form-add-info">
                    <div class="form-group">
                        <div class="col-md-10 pull-left">
                            <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Nhập tên sản phẩm">
                        </div>
                        <div class="col-md-2">
                            <input type="submit" value="tìm kiếm" class="btn btn-info">
                        </div>
                    </div>
                </form>
            </div>
            @forelse ($products as $product)
                <div class="item  col-xs-6 col-sm-4 col-md-3 service">
                    <div class="thumbnail">
                            <img class="group list-group-image" src="{{asset('/storage/product/'.$product->image)}}" alt="{{$product->name}}" />
                            <div class="caption">
                                <h3 class="group inner list-group-item-heading text-center"><a class="showCommonModel" data-toggle="modal" data-target="#service_model" href="{{route('product.detail', $product->id)}}">{{$product->name}}</a></h3>
                                <p class="lead text-center">@php echo number_format($product->price, 0 , ',', '.'); @endphp {{trans('messages.money')}}</p>
                                <p>
                                    <a href="{{route('cart.product', $product->id)}}" class="btn btn-success">Order</a>
                                    <a class="btn btn-warning pull-right" href="{{route('product.edit.form', $product->id)}}">{{trans('messages.edit_lable')}}</a>
                                </p>
                            </div>
                    </div>
                </div>
            @empty
                <h1 class="text-center">{{trans('messages.no_data')}}</h1>
            @endforelse
            <div class="col-xs-12 text-center">
                {{ $products->links() }}
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade common_ajax" id="service_model"></div><!-- /.modal -->
@endsection