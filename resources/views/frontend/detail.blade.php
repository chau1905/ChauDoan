@extends('frontend.layout.app')


@section('content')
<!--============================= BOOKING =============================-->
<div style="margin-top: 100px;" class="text-center">
    <img src="{{asset('/storage/product/'.$product->image)}}" class="img-fluid" alt="{{$product->name}}" style="height: 300px">
</div>

<!--//END BOOKING -->
<!--============================= RESERVE A SEAT =============================-->
<section class="reserve-block">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5>{{$product->name}}</h5>
                <p><span>{{number_format($product->price, 0, ',', '.')}}</span> vnđ</p>
                <p class="reserve-description">Innovative cooking, paired with fine wines in a modern setting.</p>
            </div>
            <div class="col-md-6">
                <div class="reserve-seat-block">
                    <div class="reserve-btn">
                        <div class="featured-btn-wrap">
                            <a href="#" class="btn btn-danger">Order</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--//END RESERVE A SEAT -->
<!--============================= BOOKING DETAILS =============================-->
<section class="light-bg booking-details_wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-12 responsive-wrap">
                <div class="booking-checkbox_wrap">
                    <div class="booking-checkbox">
                        <p>{!! $product->description !!}</p>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')
    <script>
        $('.fixed').addClass('is-sticky');
    </script>
@endpush
<!--//END BOOKING DETAILS -->
@endsection
