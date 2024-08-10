@extends('frontend.config.app')
@section('style')
<link rel="stylesheet" href="{{asset('frontend/css/deloma-slider.css')}}">
	<!-- primeflex for test demo -->
    {{-- <link rel="stylesheet" href="https://unpkg.com/primeflex@3.3.1/primeflex.css"/> --}}
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

@endsection

@section('content')
<div class="container-fluid py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 ">
                <div class="slideshow-container">
                    <div class="mySlides  ">
                        <img fetchPriority="high" class=" " width="100%" height="400px" src="{{asset('uploads/hospital/'.$hospital->image_first.'')}}" alt="">
                    </div>
                    <div class="mySlides ">
                        <img fetchPriority="high" class="" width="100%" height="400px" width="90%" height="auto" src="{{asset('uploads/hospital/'.$hospital->image_second.'')}}" alt="">
                    </div>
                    <a class="prev" onclick="plusSlides(-1)">❮</a>
                    <a class="next" onclick="plusSlides(1)">❯</a>
                </div>
            </div>
            <div class="col-lg-5">
                <h1 class="">{{ $hospital->hospital }}</h1>
                <h6>Location: {{ $hospital->con_state->state . ', '. $hospital->con_country->country }}</h6>
            </div>
            <div class="col-lg-12 mt-4">
                <h6 class="text-center">Description </h6>
                <p>{{ $hospital->description }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script defer="defer" type="text/javascript" src="{{asset('frontend/js/deloma-slider.js')}}"></script>
@endsection
