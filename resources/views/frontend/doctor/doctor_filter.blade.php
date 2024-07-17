@extends('frontend.config.app')

@section('content')

<div class="container-fluid py-5">
    <div class="container">
        <div class="row ">
            <div class="col-lg-5 m-auto d-flex ">
                <select name="department" class="form-control bg-white border-0 me-4" id="">
                    <option value="" disabled selected>Select Department</option>
                    @foreach ($departments as  $department)
                    <option value="{{ $department->id }}">{{ $department->department }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary btn-sm ">Request</button>
            </div>
            <div class="col-lg-5 m-auto d-flex">
                <input type="text" class="form-control bg-white border-0 me-4" placeholder="Search Doctor...">
                <button class="btn btn-primary btn-sm">Request</button>
            </div>
        </div>
    </div>
</div>




        <div class="container-fluid py-5">
            <div class="container">
                <div class="row g-5">
                    @foreach ($doctors as $doctor )
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card " style="width: 18rem;">
                            <div class="card-body">
                                <img class="card-img-top pb-3 rounded" src="{{ asset('uploads/doctor/'.$doctor->profile) }}" alt="Card image" style="width:100%">
                            <h4 class="card-title">{{ $doctor->name }}</h4>
                            <p class="card-text text-primary">{{ $doctor->con_department->department }}</p>
                            <p class="card-text"><i class="fa-solid fa-house-medical text-primary p-2"></i>{{ $doctor->con_hospital->hospital }}</p>
                            <p class="card-text"><i class="fa-solid fa-stethoscope text-primary p-2"></i>{{ $doctor->career_title }}</p>
                            <a class="btn btn-outline-dark btn-sm mt-3" href="{{ route('link.appoinment') }}">Appointment</a>
                            </div>
                        </div>
                    </div>
                        @endforeach

                </div>
            </div>
        </div>


@endsection
