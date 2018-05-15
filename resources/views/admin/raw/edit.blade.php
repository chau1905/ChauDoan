@extends('admin.layout.app')
@section('title', 'Sửa bàn')
@section('content')
    <div class="inner-block">
        <div class="product-block">
            <div class="pro-head">
                <h2>Sửa nguyên liệu</h2>
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
                <form action="{{route('raw.edit', $raw->id)}}" method="post">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Tên nguyên liệu</label>
                            <input type="text" class="form-control <?php echo $errors->has('name') ? 'input-error' : '';?>" name="name" value="{{$raw->name}}" placeholder="Nhập danh mục">
                        </div>
                        <div class="form-group">
                            <label for="">Giá</label>
                            <input type="number" class="form-control <?php echo $errors->has('price') ? 'input-error' : '';?>" name="price" value="{{$raw->price}}" placeholder="Nhập giá cho nguyên liệu">
                        </div>
                        <div class="form-group">
                            <label for="">Số lượng</label>
                            <input type="number" class="form-control <?php echo $errors->has('quantity') ? 'input-error' : '';?>" name="quantity" value="{{$raw->quantity}}" placeholder="Nhập số lượng">
                        </div>
                        <div class="form-group">
                            <label for="">Đơn vị</label>
                            <input type="text" class="form-control <?php echo $errors->has('unit') ? 'input-error' : '';?>" name="unit" value="{{$raw->unit}}" placeholder="Nhập đơn vị">
                        </div>
                        <div class="form-group">
                            <label for="">{{trans('messages.category')}}</label>
                            <select class="form-control data-select-all <?php echo $errors->has('category') ? 'input-error' : '';?>" name="category">
                                @if(count($categories) > 0)
                                    <option value="">{{trans('messages.choose_category')}}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}" {{$raw->category_id == $category->id ?'selected':''}}>{{$category->name}}</option>
                                    @endforeach
                                @else
                                    <option value="">{{trans('messages.no_category')}}</option>
                                @endif

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea class="trumbowyg" name="desc">{{$raw->description}}</textarea>
                        </div>
                    <button type="submit" class="btn btn-warning submit-form">Sửa</button>
                </form>
                <form action="{{route('raw.delete', $raw->id)}}" class="form-edit" method="post">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-danger" value="Xóa">
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
@endsection