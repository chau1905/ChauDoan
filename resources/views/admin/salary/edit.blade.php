@extends('admin.layout.app')
@section('title', 'Edit salary')
@section('content')
    <div class="inner-block">
        <div class="product-block">
            <div class="pro-head">
                <h2>Chỉnh sửa lương nhân viên</h2>
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
                <form action="{{route('salary.edit', $salary->id)}}" method="post" enctype="multipart/form-data">
                    {{ method_field('PUT')}}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Lương của nhân viên</label>
                        <input type="text" class="form-control <?php echo $errors->has('salary') ? 'input-error' : '';?>" name="salary" value="{{$salary->salary}}" placeholder="Nhập lương của nhân viên">
                    </div>
                    <div class="form-group">
                        <label for="">{{trans('messages.category')}}</label>
                        <select class="form-control data-select-all <?php echo $errors->has('user') ? 'input-error' : '';?>" name="user">
                            @if(count($users) > 0)
                                <option value="">Chọn nhân viên</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}" {{$salary->user_id == $user->id ?'selected':''}}>{{$user->name}}</option>
                                @endforeach
                            @else
                                <option value="">Không có tài khoản nhân viên nào, vui lòng thêm tài khoản</option>
                            @endif

                        </select>
                    </div>
                    <button type="submit" class="btn btn-warning submit-form">Chỉnh sửa</button>
                </form>
                <form action="{{route('salary.delete', $salary->id)}}" class="form-edit" method="post">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-danger" value="Xóa lương nhân viên">
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
@endsection