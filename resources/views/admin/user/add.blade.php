@extends('admin.layout.app')
@section('title', 'product')
@section('content')
    <div class="inner-block">
        <div class="product-block">
            <div class="pro-head">
                <h2>{{trans('messages.user_add_lable')}}</h2>
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
                <form action="{{route('user.add')}}" method="post" role="form" class="form-add-info">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">{{trans('messages.first_name_last_name_lable')}}</label>
                        <input type="text" class="form-control <?php echo $errors->has('name') ? 'input-error' : '';?>" name="name" value="{{old('name')}}" placeholder="{{trans('messages.first_name_last_name_lable')}}">
                    </div>
                    <div class="form-group">
                        <label for="">{{trans('messages.email_lable')}}</label>
                        <input type="email" class="form-control <?php echo $errors->has('email') ? 'input-error' : '';?>" name="email" value="{{old('email')}}" placeholder="{{trans('messages.input_email_lable')}}">
                    </div>
                    <div class="form-group">
                        <label for="">{{trans('messages.pass_lable')}}</label>
                        <input type="password" class="form-control <?php echo $errors->has('password') ? 'input-error' : '';?>" name="password" value="{{old('password')}}" placeholder="{{trans('messages.input_pass_lable')}}">
                    </div>
                    <div class="form-group">
                        <label for="">{{trans('messages.input_pass_same_lable')}}</label>
                        <input type="password" class="form-control <?php echo $errors->has('cp-pass') ? 'input-error' : '';?>" name="cp-pass" value="{{old('cp-pass')}}" placeholder="{{trans('messages.input_pass_same_lable')}}">
                    </div>
                    <div class="form-group">
                        <label for="">{{trans('messages.user_type_lable')}}</label>
                        <select class="form-control <?php echo $errors->has('type') ? 'input-error' : '';?>" id="access_control" name="type">
                            <option value="">{{trans('messages.user_choose_type_lable')}}</option>
                            <option value="{{\App\User::ADMIN}}">{{trans('messages.user_admin_lable')}}</option>
                            <option value="{{\App\User::EMPLOYEES}}">Nhân viên</option>
                            <option value="{{\App\User::CUSTOMER}}">Khách hàng</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary submit-form">{{trans('messages.user_add_lable')}}</button>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
@endsection