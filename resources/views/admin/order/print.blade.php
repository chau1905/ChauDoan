<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="T shop" />
    <link rel="icon" href="{{asset('images/nal_logo_sge_icon.ico')}}" sizes="192x192" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title'){{config('app.name', 'mobile') }}</title>

    <!-- Styles -->
    <link href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/trumbowyg/dist/ui/trumbowyg.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/style.css') }}" rel="stylesheet">

    <style>
        .none-css {
            display: none;
        }
    </style>
    <!-- Scripts -->
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <!--Google Fonts-->
    <link href='//fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>
    <!--static chart-->
</head>
<body>
<div class="inner-block">
    <h2>Phiếu thanh toán</h2>
    <table class="table table-condensed">
        <thead>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Tổng tiền</th>
            <th>Thời gian order</th>
            <th width="80px"></th>
        </tr>
        </thead>
        <tbody>
        @forelse($orders as $order)
            <tr>
                <td>{{$order->name}}</td>
                <td>{{$order->total}}</td>
                <td>{{number_format($order->price*$order->total, 0 , ',', '.')}} vnđ</td>
                <td>{{$order->created_at}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="12"><h2 class="text-center no_data">{{ trans('messages.no_data') }}</h2></td>
            </tr>
        @endforelse
        <tr><td colspan="6">Tổng tiền : <strong>{{number_format($price, 0 , ',', '.')}} vnđ</strong></td></tr>
        </tbody>
    </table>

    <p class="text-center"><a class="btn btn-primary print-button" onclick="myFunction();">Xuất bản</a></p>
</div>
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('bower_components/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('bower_components/trumbowyg/dist/trumbowyg.min.js') }}"></script>
<script src="{{ asset('js/admin/common.js') }}"></script>
<script>
    function myFunction() {
        $('.print-button').addClass('none-css');
        window.print();
    }
</script>
</body>
</html>