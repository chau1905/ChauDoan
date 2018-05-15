@extends('admin.layout.app')
@section('title', ' Add category')
@section('content')
    <div class="inner-block">
        <div class="product-block">
            <div class="pro-head">
                <h2>{{trans('messages.add_category')}}</h2>
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
                <form action="{{route('category.add')}}" method="POST" role="form" class="form-add-info">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Danh mục</label>
                        <input type="text" class="form-control <?php echo $errors->has('name') ? 'input-error' : '';?>" name="name" value="{{old('name')}}" placeholder="Nhập danh mục">
                    </div>
                    <div class="form-group">
                        <label for="">Loại danh mục</label>
                        <select class="form-control <?php echo $errors->has('type') ? 'input-error' : '';?>" name="type">
                            <option value="">Chọn loại danh mục</option>
                            <option value="{{\App\Category::TYPE_SERVICE}}">Danh mục hàng nhập</option>
                            <option value="{{\App\Category::TYPE_PRODUCT}}">Danh mục sản phẩm</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea class="trumbowyg" name="desc">{{old('desc')}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary submit-form">{{trans('messages.add_category')}}</button>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
@endsection