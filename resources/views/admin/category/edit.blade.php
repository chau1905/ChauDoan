@extends('admin.layout.app')
@section('title', 'Edit category')
@section('content')
    <div class="inner-block">
        <div class="product-block">
            <div class="pro-head">
                <h2>{{trans('messages.edit_category')}}</h2>
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
                <form action="{{route('category.edit', $category->id)}}" method="post">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Danh mục</label>
                            <input type="text" class="form-control <?php echo $errors->has('name') ? 'input-error' : '';?>" name="name" value="{{$category->name}}" placeholder="Nhập danh mục">
                        </div>
                        <div class="form-group">
                            <label for="">Loại danh mục</label>
                            <select class="form-control <?php echo $errors->has('type') ? 'input-error' : '';?>" name="type">
                                <option value="{{\App\Category::TYPE_SERVICE}}">Danh mục hàng nhập</option>
                                <option value="{{\App\Category::TYPE_PRODUCT}}" {{\App\Category::TYPE_PRODUCT == $category->type ? 'selected' : ''}}>Danh mục sản phẩm</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea class="trumbowyg" name="desc">{{$category->description}}</textarea>
                        </div>
                    <button type="submit" class="btn btn-warning submit-form">{{trans('messages.edit_category')}}</button>
                </form>
                <form action="{{route('category.delete', $category->id)}}" class="form-edit" method="post">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-danger" value="{{trans('messages.delete_category')}}">
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
@endsection