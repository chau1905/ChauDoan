@extends('admin.layout.app')
@section('title', 'Add salary')
@section('content')
    <div class="inner-block">
        <div class="product-block">
            <div class="pro-head">
                <h2>Thêm lương cho nhân viên</h2>
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
                <form action="{{route('salary.add')}}" method="POST" role="form" class="form-add-info" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Chọn nhân viên</label>
                        <select class="form-control data-select-all <?php echo $errors->has('user') ? 'input-error' : '';?>" name="user">
                            @if(count($users) > 0)
                                <option value="">Chọn nhân viên</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}" {{old('user') == $user->id ?'selected':''}}>{{$user->name}}</option>
                                @endforeach
                            @else
                                <option value="">Không có nhân viên nào cần thêm lương, vui lòng nhập nhân viên</option>
                            @endif

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Lương của nhân viên</label>
                        <input type="text" class="form-control <?php echo $errors->has('salary') ? 'input-error' : '';?>" name="salary" value="{{old('salary')}}" placeholder="Nhập lương của nhân viên">
                    </div>
                    <button type="submit" class="btn btn-primary submit-form">Thêm</button>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
@endsection