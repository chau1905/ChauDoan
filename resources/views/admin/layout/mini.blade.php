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
</head>

<body>
    <div>
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
    })
</script>
@stack('scripts')
</body>

</html>
