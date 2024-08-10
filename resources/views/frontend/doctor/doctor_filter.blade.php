@extends('frontend.config.app')

@section('content')

<div class="container-fluid py-5">
    <div class="container">
        <div class="row ">
            <div class="col-lg-5 m-auto d-flex ">
                <select name="department" class="form-control bg-white  me-4" id="department">
                    <option value="" disabled selected>Select Department</option>
                    @foreach ($departments as  $department)
                    <option value="{{ $department->id }}">{{ $department->department }}</option>
                    @endforeach
                </select>
                <button id="department_req" class="btn btn-primary btn-sm ">Request</button>
            </div>
            <div class="col-lg-5 m-auto d-flex">
                <input type="text" class="form-control bg-white   me-4" id="search" placeholder="Search Doctor..." >
                <button id="search_req" class="btn btn-primary btn-sm">Request</button>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-5">
            <div class="container">
                <div class="row g-5 doctor">
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

@section('script')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $('#department_req').click(function() {
            let department = $('#department').val();

            $.ajax({
                type: "GET",
                url: `/get/doctor/department/${department}`,
                success: function(data) {
                    // Log the received data
                    console.log(department);
                    if(department == null){
                        $('#department').addClass('border border-danger');
                    }else{
                        $('#department').removeClass('border border-danger');
                        // Clear the existing doctor entries before appending new ones
                        $('.doctor').empty();
                        // Ensure data is an array
                    if (Array.isArray(data)) {
                        data.forEach(function(doctor) {
                            $('.doctor').append(
                                `<div class="col-12 col-md-6 col-lg-3">
                                    <div class="card" style="width: 18rem;">
                                        <div class="card-body">
                                            <img class="card-img-top pb-3 rounded" src="{{ asset('uploads/doctor/` + doctor.profile + `') }}" alt="Card image" style="width:100%">
                                            <h4 class="card-title">` + doctor.name + `</h4>
                                            <p class="card-text text-primary">` + doctor.con_department.department + `</p>
                                            <p class="card-text"><i class="fa-solid fa-house-medical text-primary p-2"></i>` + doctor.con_hospital.hospital + `</p>
                                            <p class="card-text"><i class="fa-solid fa-stethoscope text-primary p-2"></i>` + doctor.career_title + `</p>
                                            <a class="btn btn-outline-dark btn-sm mt-3" href="{{ route('link.appoinment') }}">Appointment</a>
                                        </div>
                                    </div>
                                </div>`
                            );
                        });
                    } else {
                        console.log('Data is not an array:', data);
                    }
                    }


                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });
        $('#search_req').click(function() {
            let search = $('#search').val();
            if(!search){
                $('#search').addClass('border border-danger');
            }else{
                $.ajax({
                    type: "GET",
                    url: `/get/doctor/search/${search}`,
                    success: function(data) {
                        $('#search').removeClass('border border-danger');

                        $('.doctor').empty();

                        if (Array.isArray(data)) {
                            data.forEach(function(doctor) {
                                $('.doctor').append(
                                    `<div class="col-12 col-md-6 col-lg-3">
                                        <div class="card" style="width: 18rem;">
                                            <div class="card-body">
                                                <img class="card-img-top pb-3 rounded" src="{{ asset('uploads/doctor/` + doctor.profile + `') }}" alt="Card image" style="width:100%">
                                                <h4 class="card-title">` + doctor.name + `</h4>
                                                <p class="card-text text-primary">` + doctor.con_department.department + `</p>
                                                <p class="card-text"><i class="fa-solid fa-house-medical text-primary p-2"></i>` + doctor.con_hospital.hospital + `</p>
                                                <p class="card-text"><i class="fa-solid fa-stethoscope text-primary p-2"></i>` + doctor.career_title + `</p>
                                                <a class="btn btn-outline-dark btn-sm mt-3" href="{{ route('link.appoinment') }}">Appointment</a>
                                            </div>
                                        </div>
                                    </div>`
                                );
                            });
                        } else {
                            console.log('Data is not an array:', data);
                        }
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }

        });

    });
</script>


{{-- <script>
    $(document).ready(function(){
        $('#department_req').click(function(){
            let department = $('#department').val();
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({

                type: "GET",
                url: `/get/doctor/department/${department}`,
                success: function (data) {

                    // $('.doctor').addClass('d-none');
                    data.foreach(function (doctor) {
                        $('.doctor').append(
                            `<div class="col-12 col-md-6 col-lg-3">
                        <div class="card " style="width: 18rem;">
                            <div class="card-body">
                                <img class="card-img-top pb-3 rounded" src="{{ asset('uploads/doctor/`+doctor.profile+`') }}" alt="Card image" style="width:100%">
                            <h4 class="card-title">`+doctor.name+`</h4>
                            <p class="card-text text-primary">`+doctor.con_department.department +`</p>
                            <p class="card-text"><i class="fa-solid fa-house-medical text-primary p-2"></i>`+ doctor.con_hospital.hospital +`</p>
                            <p class="card-text"><i class="fa-solid fa-stethoscope text-primary p-2"></i>`+doctor.career_title +`</p>
                            <a class="btn btn-outline-dark btn-sm mt-3" href="{{ route('link.appoinment') }}">Appointment</a>
                            </div>
                        </div>
                    </div>`
                        )
                    });
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });

        });

    });
</script> --}}
@endsection
