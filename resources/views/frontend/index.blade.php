@extends('frontend.layout.app')


@section('content')
<!-- SLIDER -->
    {{--<section class="slider d-flex align-items-center">--}}

    {{--</section>--}}

<section class="slider d-flex align-items-center">
    <!-- <img src="images/slider.jpg" class="img-fluid" alt="#"> -->
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="slider-title_box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="slider-content_wrap">
                                {{--<h1>Bạn muốn tìm gì ?</h1>--}}
                                <h5>Bạn muốn tìm gì ?</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-10">
                            <form class="form-wrap mt-4" action="{{route('frontend.index')}}" method="get">
                                {{ csrf_field() }}
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <input type="text" placeholder="Nhập nội dung muốn tìm kiếm" class="btn-group1" name="name" value="{{old('name')}}">
                                    @if(count($categories) > 0)
                                    <select name="category" class="btn-group2" style="margin-right: 10px;">
                                        <option value="">Tất cả danh mục</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{old('category') == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                            @endforeach
                                    </select>
                                    @endif
                                    <button type="submit" class="btn-form"><span class="icon-magnifier search-icon"></span>TÌM KIẾM<i class="pe-7s-angle-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="main-block light-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="styled-heading">
                    <h3>Thực đơn của chúng tôi</h3>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse($products as $product)
            <div class="col-md-4 featured-responsive">
                <div class="featured-place-wrap">
                    <a href="{{route('frontend.index.detail', $product->id)}}">
                        <img src="{{asset('/storage/product/'.$product->image)}}" class="img-fluid" alt="{{$product->name}}">
                        <span class="featured-rating-orange">6.5</span>
                        <div class="featured-title-box">
                            <h6>{{$product->name}}</h6>
                            <p>{{$product->category}} </p> <span>• </span>
                            <p><span>{{number_format($product->price, 0, ',', '.')}}</span> vnđ</p>
                            <div class="bottom-icons">
                                <div class="closed-now"><a href="{{route('cart.product', $product->id)}}">Order</a></div>
                                <span class="ti-heart"></span>
                                <span class="ti-bookmark"></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
                @empty
                <div class="text-center">Không có sản phẩm nào</div>
                @endforelse
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="featured-btn-wrap">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
<!--//END FEATURED PLACES -->
@push('scripts')
    <script>
        $(window).scroll(function() {
            // 100 = The point you would like to fade the nav in.

            if ($(window).scrollTop() > 100) {

                $('.fixed').addClass('is-sticky');

            } else {

                $('.fixed').removeClass('is-sticky');

            };
        });
    </script>
@endpush
@endsection