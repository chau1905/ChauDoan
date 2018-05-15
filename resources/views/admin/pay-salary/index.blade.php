@extends('admin.layout.app')
@section('title', 'pay salary')
@section('content')
    <div class="inner-block">
        <h2>Thanh toán tiền cho nhân viên</h2>
        <table class="table table-condensed">
            <thead>
            <tr>
                <th>Lương tháng</th>
                <th>Tên nhân viên</th>
                <th>Số tiền thanh toán</th>
                <th>Trạng thái</th>
                <th width="80px"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($pays as $pay)
                <tr style="margin-bottom: 10px;">
                    <td>{{$pay->month}} - {{$pay->year}}</td>
                    <td>{{$pay->name}}</td>
                    <td>{{number_format($pay->total, 0, '.', ',')}} vnđ</td>
                    <td>
                        @if($pay->type == \App\Paysalary::PAID)
                            Đã thanh toán
                        @else
                            Chưa thanh toán
                        @endif
                    </td>
                    <td>
                        @if($pay->type !== \App\Paysalary::PAID)
                            <a href="{{route('pay-salary.update', $pay->id)}}" class="btn btn-success">Xác nhận thanh toán</a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="12"><h2 class="text-center no_data">{{ trans('messages.no_data') }}</h2></td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <!-- pagination -->
        <div class="row text-center">
            {{ $pays->links() }}
        </div>
    </div>
@endsection