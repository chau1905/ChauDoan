@extends('admin.layout.app')
@section('title', 'Thêm nguyên liệu')
@section('content')
    <div class="inner-block">
        <div class="product-block">
            <div class="pro-head">
                <h2>Thêm bàn</h2>
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
                <form action="{{route('table.add.form')}}" method="POST" role="form" class="form-add-info">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Tên bàn</label>
                        <input type="text" class="form-control <?php echo $errors->has('name') ? 'input-error' : '';?>" name="name" value="{{old('name')}}" placeholder="Nhập tên bàn">
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea class="trumbowyg" name="desc">{{old('desc')}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary submit-form">Thêm bàn mới</button>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
@endsection