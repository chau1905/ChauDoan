@extends('admin.layout.app')
@section('title', 'user')
@section('content')
    <div class="inner-block">
        <div class="pro-head">
            <h2>Quản lí chấm công </h2>
        </div>
        <table class="table table-condensed">
            <thead>
            <tr>
                <th>{{trans('messages.stt_lable')}}</th>
                <th>Tên nhân viên</th>
                <th>Chức vụ</th>
                <th>Ca làm</th>
                <th>Thời gian chấm công</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1;?>
            @forelse ($timekeepings as $timekeeping)
                <tr>
                    <td style="padding-bottom: 20px;">{{$i}}</td>
                    <td>{{$timekeeping->name}}</td>
                    <td>
                        @if($timekeeping->type_user == \App\User::ADMIN)
                            Quản trị viên
                        @elseif($timekeeping->type_user == \App\User::EMPLOYEES)
                            Nhân viên
                        @endif

                    </td>
                    <td>
                        @if($timekeeping->type == \App\TimeKeeping::CA_SANG)
                            Ca sáng
                            @elseif($timekeeping->type == \App\TimeKeeping::CA_TOI)
                            Ca tối
                        @endif
                    </td>
                    <td>{{$timekeeping->time}}</td>
                    <td><a href="{{route('time-keeping.detail', $timekeeping->user_id)}}" class="btn btn-info showCommonModel" data-toggle="modal" data-target="#service_model">Chi tiết nhân viên</a></td>
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
            {{ $timekeepings->links() }}
        </div>
        <div class="clearfix"></div>
        <!-- Modal -->
        <div class="modal fade common_ajax" id="service_model"></div><!-- /.modal -->
    </div>
@endsection