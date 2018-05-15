@extends('admin.layout.app')
@section('title', ' coupon')
@section('content')
    <div class="inner-block">
        <h2>Danh sách coupon
        </h2>
        <table class="table table-condensed">
            <thead>
            <tr>
                <th>Stt</th>
                <th>Mã coupon</th>
                <th>Số tiền</th>
                <th>Thời gian bắt đầu</th>
                <th>Thời gian kết thúc</th>
                <th>Trạng thái</th>
            </tr>
            </thead>
            <tbody>
            @php
                $i = 1;
            @endphp
            @forelse($categories as $category)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$category->uuid}}</td>
                    <td>{{number_format($category->price, 0, ',', '.')}} vnđ</td>
                    <td>{{$category->timestart}}</td>
                    <td>{{$category->timeend}}</td>
                    <td>
                        @if($category->timeend < \Carbon\Carbon::now() || $category->quantity <= 0)
                            Đã hết hạn
                            @else
                            Đang có khuyến mãi
                        @endif
                    </td>
                </tr>
                @php
                    $i++;
                @endphp
            @empty
                <tr>
                    <td colspan="12"><h2 class="text-center no_data">{{ trans('messages.no_data') }}</h2></td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <!-- pagination -->
        <div class="row text-center">
            {{ $categories->links() }}
        </div>
    </div>
@endsection