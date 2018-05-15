@extends('admin.layout.app')
@section('title', 'user')
@section('content')
    <div class="inner-block">
        <div class="pro-head">
            <h2>Lương của nhân viên</h2>
        </div>
        <table class="table table-condensed">
            <thead>
            <tr>
                <th>{{trans('messages.stt_lable')}}</th>
                <th>Tên nhân viên</th>
                <th>Chức vụ</th>
                <th>Số lương</th>
                <th>Thời gian</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1;?>
            @forelse ($salaries as $salary)
                <tr>
                    <td style="padding-bottom: 20px;">{{$i}}</td>
                    <td>{{$salary->name}}</td>
                    <td>
                        @if($salary->type == \App\User::ADMIN)
                            Quản trị viên
                        @elseif($salary->type == \App\User::EMPLOYEES)
                            Nhân viên
                        @endif

                    </td>
                    <td>{{number_format($salary->salary, 0, ',', '.')}} {{trans('messages.money')}}</td>
                    <td>{{$salary->updated_at}}</td>
                    <td><a href="{{route('salary.edit.form', $salary->id)}}" class="btn btn-warning ">{{trans('messages.edit_lable')}}</a></td>
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
            {{ $salaries->links() }}
        </div>
        <div class="clearfix"></div>
    </div>
@endsection