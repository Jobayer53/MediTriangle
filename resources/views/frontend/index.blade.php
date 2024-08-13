@extends('frontend.config.app')
@section('style')
<link rel="stylesheet" href="{{asset('frontend/css/deloma-slider.css')}}">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<style>
    .prev , .next{
        color:white !important;
    }
</style>
@endsection

@section('content')

{{-- Banner --}}
<div class="owl-carousel team-carousel position-relative">
    @forelse ($banner as $banners)
    <div class="container ">
    <div  class=" mb-5 hero-header">
        <div>
            <img src="{{ asset('uploads/banner/'.$banners->image) }}" alt="">
        </div>
            <div class="row justify-content-start py-5">
                <div class="col-lg-8 text-center text-lg-start">
                    {{-- <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5" style="border-color: rgba(256, 256, 256, .3) !important;">{{ $banners->name }}</h5> --}}
                    {{-- <h1 class="display-1 text-white mb-md-4">{{ $banners->title }}</h1> --}}
                    {{-- <div class="pt-2">
                        <a href="{{ route('doctor.find') }}" class="btn btn-light rounded-pill py-md-3 px-md-5 mx-2">Find Doctor</a>
                        <a href="{{ route('link.appoinment') }}" class="btn btn-outline-light rounded-pill py-md-3 px-md-5 mx-2">Appointment</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    @empty

    @endforelse


</div>

{{-- Banner End --}}

{{-- Buttons --}}
<div class="container-fluid py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <div class="pt-2">
                        <a href="{{ route('doctor.find') }}" class="btn btn-light rounded-pill py-md-3 px-md-5 mx-2">Treatment</a>
                        <a href="{{ route('link.appoinment') }}" class="btn btn-light rounded-pill py-md-3 px-md-5 mx-2">Appointment</a>
                    </div>
            </div>
        </div>
    </div>
</div>
{{-- Health Card --}}

{{-- About Us --}}
{{-- <div class="container-fluid py-5">
    <div class="container">
        <div class="row gx-5">
            <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100 rounded" src="{{ asset('uploads/about/'.$about->photo) }}" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="mb-4">
                    <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">About Us</h5>
                    <h1 class="display-4">{{ $about->title }}</h1>
                </div>
                <p>{{ $about->description }}</p>
                <div class="row g-3 pt-3">
                    @forelse ($services->take(3) as $service)
                    <div class="col-sm-3 col-6">
                        <div class="bg-light text-center rounded-circle py-4">
                            <i class="{{ $service->icon }} text-primary mb-3" style="font-size: 35px"></i>
                            <h6 class="mb-0">{{ explode(' ',$service->service)[0] }}<small class="d-block text-primary">{{ count(explode(' ',$service->service)) > 1?explode(' ',$service->service)[1]:'unknown' }}</small></h6>
                        </div>
                    </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div> --}}
{{-- About Us End --}}
{{-- Our Service --}}
<div class="container-fluid py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5" style="max-width: 500px;">
            <h5 class="d-inline-block text-primary text-uppercase  border-5 px-2" style="background-color: #ddd">Services</h5>
            <h1 class="">Excellent Medical Services</h1>
        </div>
        <div class="row g-5">
            @forelse ($services->take(6) as $service)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                    <div class="service-icon mb-4" >
                        <i class="{{ $service->icon }} text-white" style="font-size: 35px"></i>
                    </div>
                    <h4 class="" style="position: absolute; top:120px">{{ $service->service }}</h4>
                    <p class="m-0" style="position: absolute; padding:10px;top:160px;font-size:14px">{{ $service->short_description }}</p>
                    {{-- <a class="btn btn-lg btn-primary rounded-pill" href="">
                        <i class="bi bi-arrow-right"></i>
                    </a> --}}
                </div>
            </div>
            @empty
            @endforelse
        </div>
    </div>
</div>
{{-- Oure Service End --}}
{{-- Appoinment --}}
<!-- Team Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5" style="max-width: 500px;">
            <h5 class="d-inline-block text-primary text-uppercase  border-5 px-2" style="background-color: #ddd">Hospitals </h5>
            <h1 class="">Our Hospitals In Bangladesh</h1>
        </div>
        <div class=" row  position-relative">
           @if (!$hospitalbd == null)
           @foreach($hospitalbd as $data)
           <div class="col-lg-3 col-md-4 col-sm-4 mb-5">
               <a href="{{ route('hospital.details',$data->slug) }}">
                   <div class="card hospital-card" style="height: 250px;">
                       <div class="{{ $data->image_second == null?'':'image-container' }}" style="position: relative; height: 192px;">
                           <img height="192px" src="{{ asset('uploads/hospital/'.$data->image_first) }}" class="card-img-top first-image" >
                           @if($data->image_second !== null)
                           <img height="192px" src="{{ asset('uploads/hospital/'.$data->image_second) }}" class="card-img-top second-image" >
                           @endif
                       </div>
                       <div class="card-body">
                           <h6>{{ $data->hospital }}</h6>
                       </div>
                   </div>
               </a>
           </div>
           @endforeach
           @endif


        </div>
    </div>
</div>
<div class="container-fluid py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5" style="max-width: 500px;">
            <h5 class="d-inline-block text-primary text-uppercase  border-5 px-2" style="background-color: #ddd">Hospitals </h5>
            <h1 class="">Our Hospitals In Abroad</h1>
        </div>
        <div class=" row  position-relative">
            @if (!$hospitalind == null)
                @foreach($hospitalind as $data)
                <div class="col-lg-3 col-md-4 col-sm-4 mb-5">
                    <a href="{{ route('hospital.details',$data->slug) }}">
                        <div class="card hospital-card" style="height: 250px;">
                            <div class="{{ $data->image_second == null?'':'image-container' }}" style="position: relative; height: 192px;">
                                <img height="192px" src="{{ asset('uploads/hospital/'.$data->image_first) }}" class="card-img-top first-image" >
                                @if($data->image_second !== null)
                                <img height="192px" src="{{ asset('uploads/hospital/'.$data->image_second) }}" class="card-img-top second-image" >
                                @endif
                            </div>
                            <div class="card-body">
                                <h6>{{ $data->hospital }}</h6>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            @endif



        </div>
    </div>
</div>
<!-- Team Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5" >
            <h5 class="d-inline-block text-primary text-uppercase  border-5 px-2" style="background-color: #ddd">Our Doctors</h5>
            <h1 class="">Qualified Healthcare Professionals</h1>
        </div>
        <div class=" row position-relative">
            @foreach ($doctors->take(8) as $doctor)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card doctor-card">
                        <img class="img-fluid  card-img-top" src="{{ asset('uploads/doctor/'.$doctor->profile) }}" style="object-fit: cover; height: 250px;">
                    <div class="card-body ">
                        <h3>{{ $doctor->name }}</h3>
                            <h6 class="fw-normal fst-italic text-primary mb-4">{{ $doctor->con_department?->department }}</h6>
                            <p class="mb-2" style="border-bottom: 1px solid #1ab8ae33;"><i class="fa-solid fa-house-medical text-primary p-2"></i>{{ $doctor->con_hospital?->hospital }}</p>
                            <p class="mb-2" style="border-bottom: 1px solid #1ab8ae33;"><i class="fa-solid fa-stethoscope text-primary p-2"></i>{{ $doctor->career_title }}</p>
                            <p class="m-0" style="border-bottom: 1px solid #1ab8ae33;"><i class=" fa-solid fa-book text-primary p-2"></i>{{ $doctor->speciality }}</p>
                            <div class="text-center">
                                <a href="{{route('doctor_profile.show', ['fileName'=> $doctor->pdf])}}" target="_blank" class="btn btn-sm btn-primary  mt-3 ">Profile</a>
                               {{-- <a href="{{ route('pdf.show', ['filename' => 'example.pdf']) }}" target="_blank">Open PDF</a> --}}
                                <a href="{{route('video.consultant.take', $doctor->id)}}" class="btn btn-sm btn-primary mt-3 ">Book An Appointment</a>

                            </div>

                    </div>


                </div>
            </div>
            @endforeach

        </div>
        <div class="text-center">
            <a href="{{route('doctor_view_all')}}"  class="btn btn-primary mt-5">View All</a>
        </div>
    </div>
</div>
{{-- Health Card --}}
<div class="container-fluid py-5">
    <div class="container ">
        <div class="text-center mx-auto mb-5" style="max-width: 500px;">
            <h5 class="d-inline-block text-primary text-uppercase  border-5 px-2" style="background-color: #ddd">Health Card</h5>
            <h1 class="">Awesome Medical Programs</h1>
        </div>

        <div class=" col-lg-5 col-md-12 custom-p m-auto" style="padding: 0 45px 45px 45px;">
            @if ($healths )
            <div class="bg-light rounded ">
                <div class="position-relative">
                    <div class="slideshow-container">
                        <div class="mySlides ">
                            <img fetchPriority="high" class="img-fluid rounded-top " width="100%" height="auto" src="{{asset('uploads/healthcard/'.$healths->image_first.'')}}" alt="">
                        </div>
                        <div class="mySlides ">
                            <img fetchPriority="high" class="img-fluid rounded-top  " width="100%" height="auto" src="{{asset('uploads/healthcard/'.$healths->image_second.'')}}" alt="">
                        </div>
                        <a class="prev" onclick="plusSlides(-1)">❮</a>
                        <a class="next" onclick="plusSlides(1)">❯</a>
                    </div>

                    {{-- <img fetchPriority="high" class="img-fluid rounded-top " width="100%" height="auto" src="{{asset('uploads/healthcard/'.$healths->image_first.'')}}" alt=""> --}}
                    <div class="position-absolute w-100 h-100 top-50 start-50 translate-middle rounded-top d-flex flex-column align-items-center justify-content-center" style="background: rgb(15 24 49 / 43%);">
                        <h3 class="text-white">{{$healths->name}}</h3>
                        <h1 class="display-4 text-white mb-0">
                            <small class="align-top fw-normal" style="font-size: 22px; line-height: 45px;">৳</small>{{$healths->price}}<small class="align-bottom fw-normal" style="font-size: 16px; line-height: 40px;">/ Year</small>
                        </h1>
                    </div>
                </div>
                <div class="text-center pt-5 pb-4 ">
                    <ul style="text-align: justify; list-style-type:none;">

                        @foreach(json_decode($healths->benifits) as $index => $benifit)
                        @if ($benifit !== null)
                        <li>
                            <i class="fa fa-check text-success me-1" ></i>
                             {{$benifit}} </li>
                        @endif
                        @endforeach
                    </ul>
                    <a href="{{route('health.card')}}" class="btn btn-primary rounded-pill py-2 px-3 ">Apply Now</a>
                </div>
            </div>
            @endif


        </div>
    </div>
</div>
{{-- Health Card End --}}
{{-- How we Work --}}
<div class="container-fluid py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5" style="max-width: 500px;">
            <h5 class="d-inline-block text-primary text-uppercase  border-5 px-2" style="background-color: #ddd">How We Work</h5>
            <h1 class="">How We Work</h1>
        </div>
        <div class="image_block">
            <img src="{{ asset('uploads/about/'.$about?->photo) }}" alt="" srcset="" style="width: 100%">
        </div>
        <div class="mt-5" >
           <video class="w-100"
           autoplay
           muted
           loop
           playsinline
           >
           <source src="{{ asset('uploads/about/'.$about?->video) }} " type="video/mp4">
        </video>
        </div>
    </div>
</div>
{{-- How we Work --}}



@endsection
@section('script')


<script defer="defer" type="text/javascript" src="{{asset('frontend/js/deloma-slider.js')}}"></script>

@endsection
