@extends('frontend.config.app')
@section('style')
<link rel="stylesheet" href="{{asset('frontend/css/deloma-slider.css')}}">
	<!-- primeflex for test demo -->
    <link rel="stylesheet" href="https://unpkg.com/primeflex@3.3.1/primeflex.css"/>

    <!-- jquery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script defer="defer" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

@endsection

@section('content')
<div class="container-fluid py-5">
    <div class="container">

        <div class="row">
            <div class="col-lg-7 ">
                <div id="slider" class="del-slider" >
                    <div>
                        <img fetchPriority="high" class="w-full " width="1800" height="400px" src="{{asset('uploads/hospital/'.$hospital->image_first.'')}}" alt="">
                    </div>
                    <div>
                        <img fetchPriority="high" class="w-full " width="1800" height="400px" width="90%" height="auto" src="{{asset('uploads/hospital/'.$hospital->image_second.'')}}" alt="">
                    </div>
                    <img fetchPriority="high" class="w-full " width="1800" height="400px" src="{{asset('uploads/hospital/'.$hospital->image_first.'')}}" alt="">
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
<script defer="defer" type="text/javascript">

    $(document).ready(function()
    {
        /*
         * demo code!!!
         *
         * this demo uses a timeout to show that this slider is
         * web core vitals (SEO) friendly since first slide,
         * which is important for 'largest contentful paint' (LCP)
         * metric is immediately visible without the javascript being initialized
         */
        setTimeout(function() { $("#slider").delSlider(); }, 1000);

        // production code!!!
        // $("#slider").delSlider();
    });

</script>
@endsection
