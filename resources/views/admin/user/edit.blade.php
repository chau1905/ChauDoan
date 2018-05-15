@extends('admin.layout.app')
@section('title', 'product')
@section('content')
    <div class="inner-block">
        <div class="product-block">
            <div class="pro-head">
                <h2>{{trans('messages.user_edit_lable')}}</h2>
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
                <form action="{{route('user.edit', $user->id)}}" method="post" role="form" class="form-add-info">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">{{trans('messages.pass_lable')}}</label>
                        <input type="password" class="form-control <?php echo $errors->has('password') ? 'input-error' : '';?>" name="password" value="{{old('password')}}" placeholder="{{trans('messages.input_pass_lable')}}">
                    </div>
                    <div class="form-group">
                        <label for="">{{trans('messages.input_pass_same_lable')}}</label>
                        <input type="password" class="form-control <?php echo $errors->has('cp-pass') ? 'input-error' : '';?>" name="cp-pass" value="{{old('cp-pass')}}" placeholder="{{trans('messages.input_pass_same_lable')}}">
                    </div>
                    <button type="submit" class="btn btn-warning submit-form">{{trans('messages.edit_lable')}}</button>
                </form>
                <form action="{{route('user.delete', $user->id)}}" class="form-edit" method="post">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-danger" value="{{trans('messages.delete')}}">
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
@endsection