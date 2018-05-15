@extends('admin.layout.app')
@section('title', ' Add coupon')
@section('content')
    <div class="inner-block">
        <div class="product-block">
            <div class="pro-head">
                <h2>Thêm coupon</h2>
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
                <form action="{{route('coupon.add')}}" method="POST" role="form" class="form-add-info">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Số tiền</label>
                        <input type="text" class="form-control <?php echo $errors->has('price') ? 'input-error' : '';?>" name="price" value="{{old('price')}}" placeholder="Nhập số tiền">
                    </div>
                    <div class="form-group">
                        <label for="">Số lượng</label>
                        <input type="text" class="form-control <?php echo $errors->has('quantity') ? 'input-error' : '';?>" name="quantity" value="{{old('quantity')}}" placeholder="Nhập số lượng">
                    </div>
                    <div class="form-group">
                        <label for="">Thời gian bắt đầu</label>
                        <input type="text" class="form-control <?php echo $errors->has('timestart') ? 'input-error' : '';?> datepicker" name="timestart" value="{{old('timestart')}}" placeholder="Thời gian bắt đầu">
                    </div>
                    <div class="form-group">
                        <label for="">Thời gian kết thúc</label>
                        <input type="text" class="form-control <?php echo $errors->has('timeend') ? 'input-error' : '';?> datepicker" name="timeend" value="{{old('timeend')}}" placeholder="Thời gian kết thúc">
                    </div>
                    <button type="submit" class="btn btn-primary submit-form">Thêm coupon</button>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
@endsection