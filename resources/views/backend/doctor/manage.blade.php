@extends('backend.config.app')
@section('content')
{{-- Modals Delete--}}
<div class="modal fade" id="LoginFormTwo" tabindex="-1" aria-labelledby="LoginForm-title" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="LoginForm-title">Are You Sure?</h5>
                <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="p-3 rounded box-shadow">
                    <p class="text-danger mb-0">This process cannot be undone ! <br> Do you really want to delete those records?</p>
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" id="close-modal" data-dismiss="modal">Close</button> --}}
                <a href="" id="delete_confirmTwo" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="LoginForm-title" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded shadow border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="createModal">Create Doctor</h5>
                <button type="button" class="btn btn-icon btn-close " data-bs-dismiss="modal" id="close-modal"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('doctor.store') }}" method="POST" class="mt-4" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        {{-- from database  --}}
                        {{-- Country --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Country <span class="text-danger">*</span></label>
                                <select class="form-select form-control country @error('country_id') is-invalid @enderror" name="country_id">
                                    <option value="">-- Select Country--</option>
                                    @forelse (App\Models\CountryModel::where('status',1)->get() as $country)
                                    <option value="{{ $country->id }}">{{ $country->country }}</option>
                                    @empty
                                    <option disabled>No Data Found !</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        {{-- State --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">State <span class="text-danger">*</span></label>
                                <select class="form-select form-control state @error('state_id') is-invalid @enderror" id="state" name="state_id">
                                    <option value="">-- --- --</option>
                                </select>
                            </div>
                        </div>
                        {{-- Hospital --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Hospital <span class="text-danger">*</span></label>
                                <select class="form-select form-control hospital @error('hospital_id') is-invalid @enderror" id="hospital" name="hospital_id">
                                    <option value="">-- --- --</option>
                                </select>
                            </div>
                        </div>
                        {{-- Department --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Department <span class="text-danger">*</span></label>
                                <select class="form-select form-control @error('department_id') is-invalid @enderror" id="departmentVal" name="department_id">
                                    <option value="">-- --- --</option>
                                </select>
                            </div>
                        </div>

                        {{-- Break --}}
                        <hr>

                        <div class="col-md-6">
                            <x-Input type="text" label="Doctor Name" name="name"  placeholder="Doctor"/>
                        </div>

                        <div class="col-md-6">
                            <x-Input type="text" label="Career Title" name="career_title"  placeholder="MBBs"/>
                        </div>

                        <div class="col-md-6">
                            <x-Input type="number" label="Fee" name="fee" placeholder="Tk."/>
                        </div>

                        <div class="col-md-6">
                            <x-Input type="number" label="Vat" name="vat" placeholder="0%" />
                        </div>

                        <div class="col-md-6">
                            <x-Input type="file" label="Profile" name="profile" />
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Speciality</label>
                                <textarea type="text" class="form-control @error('speciality') is-invalid @enderror" label="Speciality" name="speciality"  placeholder="Bio"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
{{-- Modals end --}}

<div class="container-fluid">

    <div class="layout-specing">
        <div class="row mb-3">
            <div class="d-md-flex justify-content-between">
                <h5 class="mb-0">Doctors</h5>


                <nav aria-label="breadcrumb" class="d-inline-block mt-4 mt-sm-0">
                    <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                        <li class="breadcrumb-item">Manage</li><i style="font-size:12px;padding-left:6px" class="fa-solid fa-chevron-right"></i>
                        {{-- <li class="breadcrumb-item active" aria-current="page"></li> --}}
                    </ul>
                </nav>
            </div>

        </div><!--end row-->


        <div class="row">
            {{-- Website INfo --}}
            <div class="col-md-12">
                <button class="btn btn-sm btn-primary my-2" data-bs-toggle="modal" data-bs-target="#createModal" >Add Doctor</button>
                <div class="table-responsive shadow rounded">
                    @if ($datas->count() != 0 )
                    <table class="table table-center bg-white mb-0">
                        <thead>
                            <tr>
                                <th class="border-bottom p-3" >Doctor</th>
                                <th class="border-bottom p-3" >Information</th>
                                <th class="border-bottom p-3" >Database</th>
                                <th class="border-bottom p-3">Status</th>
                                <th class="border-bottom p-3">Created</th>
                                @if (Auth::guard('admin_model')->user()->can('edit') || Auth::guard('admin_model')->user()->can('delete'))
                                <th class="border-bottom p-3 text-end" style="min-width: 100px;">Action</th>
                                @else
                                <th></th>
                                @endif

                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                <tr>
                                    <td class="p-3"><img style="width:40px" src="{{ asset('uploads/doctor/'.$data->profile) }}" alt="">
                                    </td>

                                    <td class="p-3">
                                        <p class="mb-0"><span class="badge bg-secondary ">{{ $data->name }}</span></p>
                                        <hr style="margin:0.2rem 0">
                                        <p class="mb-0">{{ $data->career_title }}</p>
                                        <hr style="margin:0.2rem 0">
                                        <p class="mb-0">{{ $data->speciality }}</p>
                                    </td>

                                    <td class="p-3">
                                        <p class="mb-0">{{ $data->con_country == null ?'Unknown':$data->con_country->country }}</p>
                                        <hr style="margin:0.2rem 0">
                                        <p class="mb-0">{{ $data->con_state == null ?'Unknown':$data->con_state->state }}</p>
                                        <hr style="margin:0.2rem 0">
                                        <p class="mb-0">{{ $data->con_hospital == null ?'Unknown':$data->con_hospital->hospital }}</p>
                                        <hr style="margin:0.2rem 0">

                                        <p class="mb-0"><span class="badge bg-secondary ">{{ $data->con_department == null ?'Unknown':$data->con_department->department }}</span></p>
                                    </td>

                                    <td class="p-3"><span class="badge bg-soft-{{ $data->status == 0?'danger':'success' }}">{{ $data->status == 0 ?'Deactive':'active' }}</span></td>

                                    <td class="p-3"><span class="badge bg-soft-success">{{ $data->created_at->diffForHumans() }}</span></td>
                                    <td class="text-end p-3">
                                        @if (Auth::guard('admin_model')->user()->can('edit'))

                                        <a href="{{ route('doctor.edit',$data->id) }}" class="update_value btn btn-icon btn-pills btn-soft-success"><i class="fa-solid fa-pen-to-square"></i></a>
                                        @endif
                                        @if (Auth::guard('admin_model')->user()->can('delete'))

                                        <a href="{{ route('doctor.delete',$data->id) }}" data-bs-toggle="modal" data-bs-target="#LoginFormTwo" class="delete_value btn btn-icon btn-pills btn-soft-danger"><i class="fa-solid fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                    <span class="text-center bg-soft-warning"><p class="m-0">No Data Found !</p></span>
                    @endif
                </div>
            </div>
            <div class="mt-3 d-flex justify-content-between">
                {{ $datas->links('pagination::bootstrap-4') }}
                {{-- <div class="button">
                    <a href="{{ route('doctor.link') }}" class="btn btn-info btn-sm">Add Doctor</a>
                </div> --}}
            </div>
        </div>

    </div>
</div>
@endsection
@section('script')
<script>
    $(".delete_value").click(function(){
            var val = $(this).attr('href');
            $('#delete_confirmTwo').attr('href', val);
        });
</script>

<script>
    $('.country').change(function(){
        var country = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'POST',
            url:'{{ route('d.hospital.ajax') }}',
            data:{'country_id':country},
            success:function(data) {
                $('#state').html(data);
            }
        })
    });
    // State
    $('.state').change(function(){
        var state = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'POST',
            url:'{{ route('d.department.ajax') }}',
            data:{'state_id':state},
            success:function(data) {
                $('#hospital').html(data);
            }
        })
    });
    // Hospital
    $('.hospital').change(function(){
        var hospital = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:'{{ route('d.doctor.ajax') }}',
            data:{'hospital_id':hospital},
            success:function(data) {
                console.log(data);
                $('#departmentVal').html(data);
            }
        })
    });
</script>
@endsection
