@extends('admin.layout.app')
@section('title', 'Sửa bàn')
@section('content')
    <div class="inner-block">
        <div class="product-block">
            <div class="pro-head">
                <h2>Sửa bàn</h2>
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
                <form action="{{route('table.edit', $category->id)}}" method="post">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Tên bàn</label>
                            <input type="text" class="form-control <?php echo $errors->has('name') ? 'input-error' : '';?>" name="name" value="{{$category->name}}" placeholder="Nhập danh mục">
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea class="trumbowyg" name="desc">{{$category->description}}</textarea>
                        </div>
                    <button type="submit" class="btn btn-warning submit-form">Sửa</button>
                </form>
                <form action="{{route('table.delete', $category->id)}}" class="form-edit" method="post">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-danger" value="Xóa">
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
@endsection