@extends('admin.layout.app')
@section('title', 'user')
@section('content')
    <div class="inner-block">
        <div class="pro-head">
            <h2>{{trans('messages.user_lable')}}
            </h2>
        </div>
        <table class="table table-condensed">
            <thead>
            <tr>
                <th>{{trans('messages.stt_lable')}}</th>
                <th>{{trans('messages.first_name_last_name_lable')}}</th>
                <th>{{trans('messages.email_lable')}}</th>
                <th>Quyền người dùng</th>
                <th>{{trans('messages.updated_at_lable')}}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1;?>
            @forelse ($users as $user)
                <tr>
                    <td style="padding-bottom: 20px;">{{$i}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @if($user->type == \App\User::ADMIN)
                            Quản trị viên
                            @elseif($user->type == \App\User::EMPLOYEES)
                            Nhân viên
                            @elseif($user->type == \App\User::CUSTOMER)
                            Người dùng
                            @endif

                    </td>
                    <td>{{$user->updated_at}}</td>
                    <td style="position: relative;">
                         {{--@if ($user->id != \Auth::user()->id && \Laratrust::hasRole('admin'))--}}
                            <form action="{{route('user.delete',['id'=>$user->id])}}" class="form-edit " method="post" style="position: absolute; top : 3px; display: inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <input type="submit" class="btn btn-danger" value="Xóa">
                            </form>
                        {{--@endif--}}
                    </td>
                </tr>
                <?php $i++ ?>
            @empty
                <tr>
                    <td colspan="12"><h2 class="text-center no_data">{{ trans('messages.no_data') }}</h2></td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="col-xs-12 text-center">
            {{ $users->links() }}
        </div>
        <div class="clearfix"></div>
    </div>
@endsection