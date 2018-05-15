@extends('admin.layout.app')
@section('title', 'Gộp bàn')
@section('content')
<div class="inner-block">
    <div class="product-block">
        <div class="pro-head">
            <h2>Gộp bàn

            </h2>
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
            <form action="{{route('order.merge')}}" method="POST" role="form" class="form-add-info">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="">Chon bàn cần nhập</label>
                    <select class="form-control <?php echo $errors->has('table') ? 'input-error' : '';?>" name="table">
                        @if(count($tables) > 0)
                        <option value="">Chọn bàn</option>
                        @foreach ($tables as $table)
                        <option value="{{$table->id}}" {{old('table') == $table->id ?'selected':''}}>{{$table->name}}</option>
                        @endforeach
                        @else
                        <option value="">Vui lòng thêm bàn</option>
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <input type="hidden" name="id_order" value="{{$id}}">
                </div>
                <button type="submit" class="btn btn-primary submit-form">Gộp bàn</button>
            </form>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
@endsection