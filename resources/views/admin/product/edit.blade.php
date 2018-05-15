@extends('admin.layout.app')
@section('title', 'Edit product')
@section('content')
    <div class="inner-block">
        <div class="product-block">
            <div class="pro-head">
                <h2>{{trans('messages.edit_product')}}</h2>
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
                <form action="{{route('product.edit', $product->id)}}" method="post" enctype="multipart/form-data">
                    {{ method_field('PUT')}}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" class="form-control <?php echo $errors->has('name') ? 'input-error' : '';?>" name="name" value="{{$product->name}}" placeholder="Nhập tên sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="">{{trans('messages.price')}}</label>
                        <input type="text" class="form-control <?php echo $errors->has('price') ? 'input-error' : '';?>" name="price" value="{{$product->price}}" placeholder="Nhập giá sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="">{{trans('messages.category')}}</label>
                        <select class="form-control data-select-all <?php echo $errors->has('category') ? 'input-error' : '';?>" name="category">
                            @if(count($categories) > 0)
                                <option value="">{{trans('messages.choose_category')}}</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{$product->category_id == $category->id ?'selected':''}}>{{$category->name}}</option>
                                @endforeach
                            @else
                                <option value="">{{trans('messages.no_category')}}</option>
                            @endif

                        </select>
                    </div>
                    <div class="form-group">
                        <div class="show_image">
                            <img src="{{asset('/storage/product/'.$product->image)}}" class="img-responsive" alt="{{$product->name}}" style="max-width: 300px;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">{{trans('messages.image')}} </label>
                        <input type="file" class="form-control <?php echo $errors->has('image-service') ? 'input-error' : '';?>" name="image-service">
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea class="trumbowyg" name="description">{{$product->description}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-warning submit-form">{{trans('messages.edit_product')}}</button>
                </form>
                <form action="{{route('product.delete', $product->id)}}" class="form-edit" method="post">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-danger" value="{{trans('messages.delete_product')}}">
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
@endsection