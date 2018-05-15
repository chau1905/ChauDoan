<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Colorlib">
    <meta name="description" content="#">
    <meta name="keywords" content="#">
    <!-- Page Title -->
    <title>Coffee</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('template/frontend/css/bootstrap.min.css')}}">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700,900" rel="stylesheet">
    <!-- Simple line Icon -->
    <link rel="stylesheet" href="{{asset('template/frontend/css/simple-line-icons.css')}}">
    <!-- Themify Icon -->
    <link rel="stylesheet" href="{{asset('template/frontend/css/themify-icons.css')}}">
    <!-- Hover Effects -->
    <link rel="stylesheet" href="{{asset('template/frontend/css/set1.css')}}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('template/frontend/css/style.css')}}">
</head>

<body>
<!--============================= HEADER =============================-->
<div class="nav-menu">
    <div class="bg transition">
        <div class="container-fluid fixed is-sticky">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <a class="navbar-brand" href="{{route('frontend.index')}}">Listing</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="icon-menu"></span>
                            </button>
                            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                                <ul class="navbar-nav">

                                    <li class="nav-item active">
                                        <a class="nav-link" href="{{route('all_cart.product')}}">
                                            Order :
                                            {{\Cart::count()}}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--//END HEADER -->
<div class="flash-message" style="margin-top: 100px;">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(session('alert-' . $msg))
            <div class="alert alert-{{ $msg }}">
                {{ session('alert-' . $msg) }}
            </div>
        @endif
    @endforeach
</div>
@yield('content')
<!--============================= FOOTER =============================-->
<footer class="main-block dark-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="copyright">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    <p>Copyright &copy; 2018 Listing. All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    <ul>
                        <li><a href="#"><span class="ti-facebook"></span></a></li>
                        <li><a href="#"><span class="ti-twitter-alt"></span></a></li>
                        <li><a href="#"><span class="ti-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--//END FOOTER -->




<!-- jQuery, Bootstrap JS. -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset('template/frontend/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('template/frontend/js/popper.min.js')}}"></script>
<script src="{{asset('template/frontend/js/bootstrap.min.js')}}"></script>

@stack('scripts')

<!-- Swipper Slider JS -->
<script src="{{asset('template/frontend/js/swiper.min.js')}}"></script>
<script>
    $(document).ready(function () {
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 3,
            slidesPerGroup: 3,
            loop: true,
            loopFillGroupWithBlank: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
        if ($('.image-link').length) {
            $('.image-link').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        }
        if ($('.image-link2').length) {
            $('.image-link2').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        }
    })

</script>
</body>

</html>
