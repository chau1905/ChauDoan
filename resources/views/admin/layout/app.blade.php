<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Khóa Học Lập Trình Laravel Framework 5.x Tại Khoa Phạm">
    <meta name="author" content="">
    <title>Coffee</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('jquery-ui/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{asset('template/ad/bower_components/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{asset('template/ad/bower_components/metisMenu/dist/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('template/ad/dist/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{asset('template/ad/bower_components/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="{{asset('template/ad/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{asset('template/ad/bower_components/datatables-responsive/css/dataTables.responsive.css')}}" rel="stylesheet">
    <link href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/trumbowyg/dist/ui/trumbowyg.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">Coffee</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <!-- /.dropdown -->
            <li>
                <a href="{{route('all_cart.product')}}">
                    Order : {{\Cart::count()}}
                </a>
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li>
                        <a href="{{route('admin.index')}}"><i class="fa fa-dashboard fa-fw"></i>Trang chủ</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Danh mục<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('category.index')}}">Danh sách danh mục</a>
                            </li>
                            <li>
                                <a href="{{route('category.add.form')}}">Thêm danh mục</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-table" aria-hidden="true"></i>Vị trí<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('table.index')}}">Danh sách vị trí</a>
                            </li>
                            <li>
                                <a href="{{route('table.add.form')}}">Thêm vị trí</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-cube fa-fw"></i>Sản phẩm<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('product.index')}}">Danh sách sản phẩm</a>
                            </li>
                            <li>
                                <a href="{{route('product.add.form')}}">Thêm sản phẩm</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-tint" aria-hidden="true"></i>Nguyên liệu<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('raw.index')}}">Danh sách nguyên liệu</a>
                            </li>
                            <li>
                                <a href="{{route('raw.add.form')}}">Thêm nguyên liệu</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    @if (\Laratrust::hasRole('admin'))
                    <li>
                        <a href="#"><i class="fa fa-users fa-fw"></i>Tài khoản<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('user.index')}}">Danh sách tài khoản</a>
                            </li>
                            <li>
                                <a href="{{route('user.add.form')}}">Thêm tài khoản</a>
                            </li>
                            <li>
                                <a href="{{route('user.add.form')}}">Đổi mật khẩu</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-money" aria-hidden="true"></i>Tài chính<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('salary.index')}}">Danh sách lương nhân viên</a>
                            </li>
                            <li>
                                <a href="{{route('salary.add.form')}}">Thêm lương nhân viên</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-building" aria-hidden="true"></i>Chấm công<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('time-keeping.index')}}">Chấm công</a>
                            </li>
                            <li>
                                <a href="{{route('time-keeping.add.form')}}">Thêm chấm công</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-credit-card" aria-hidden="true"></i>Trả lương<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('pay-salary.index')}}">Danh sách trả lương</a>
                            </li>
                            <li>
                                <a href="{{route('pay-salary.form_add')}}">Thêm trả lương</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-globe" aria-hidden="true"></i>Coupon<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('coupon.index')}}">Danh sách coupon</a>
                            </li>
                            <li>
                                <a href="{{route('coupon.add.form')}}">Thêm coupon</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    @endif
                    <li>
                        <a href="#"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>Order<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('order.index')}}">Danh sách order</a>
                                <a href="{{route('order.form_add')}}">Thêm order</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                    <li>
                        <a href="{{route('statis.index')}}"><i class="fa fa-bar-chart-o fa-fw"></i>Thống kê</a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(session('alert-' . $msg))
                    <div class="alert alert-{{ $msg }}">
                        {{ session('alert-' . $msg) }}
                    </div>
                @endif
            @endforeach
        </div>
        @yield('content')
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


<!-- jQuery -->
<script src="{{asset('template/ad/bower_components/jquery/dist/jquery.min.js')}}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{asset('template/ad/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="{{asset('template/ad/bower_components/metisMenu/dist/metisMenu.min.js')}}"></script>

<!-- Custom Theme JavaScript -->
<script src="{{asset('template/ad/dist/js/sb-admin-2.js')}}"></script>

<!-- DataTables JavaScript -->
<script src="{{asset('template/ad/bower_components/DataTables/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template/ad/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js')}}"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('bower_components/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('bower_components/trumbowyg/dist/trumbowyg.min.js') }}"></script>
<script src="{{ asset('jquery-ui/jquery-ui.js') }}"></script>
<script src="{{ asset('js/admin/common.js') }}"></script>
<script src="{{asset('morris.js-0.5.1/raphael-min.js')}}"></script>
<script src="{{asset('morris.js-0.5.1/morris.min.js')}}"></script>

<script>
    $(document).ready(function () {
        $( function() {
            $( "#datepicker" ).datepicker();
        } );

        $( function() {
            $( ".datepicker" ).datepicker();
        } );
    })
</script>
@stack('scripts')
</body>

</html>
