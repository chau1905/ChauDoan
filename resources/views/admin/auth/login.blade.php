@extends('admin.layout.mini')

@section('content')
    <div class="login-page">
        <div class="login-main">
            <div class="login-head">
                <h1>{{trans('messages.login_lable')}}</h1>
            </div>
            <div class="login-block">
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
                <form action="{{url('login')}}" method="post" role="form">
                    {{ csrf_field() }}
                    <input type="text" name="email" placeholder="Email" value="{{old('email')}}" required="">
                    <input type="password" name="password" class="lock" placeholder="Mật khẩu" value="{{old('password')}}">
                    <input type="submit" name="Sign In" value="Đăng nhập">
                    {{--<h3>{{trans('messages.not_member')}}<a href="{{ route('register') }}">{{trans('messages.register_lable')}}</a></h3>--}}
                    <h2>{{trans('messages.or_login')}}</h2>
                </form>
                    <h5><a href="{{url('/')}}">{{trans('messages.return_home')}}</a></h5>
            </div>
        </div>
    </div>
    <!--inner block end here-->

@endsection
