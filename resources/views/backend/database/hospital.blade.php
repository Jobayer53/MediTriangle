@extends('backend.config.app')


@section('content')
{{-- Modals --}}
<div class="modal fade" id="update" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom p-3">
                <h5 class="modal-title" id="exampleModalLabel">Update Hospital</h5>
                <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body p-3 pt-4">
                <form action="{{ route('d.hospital.update') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Hospital</label>
                                <input name="hospital" type="text" class="update form-control @error('country') is-invalid @enderror" value="">
                                <input name="id" type="hidden" class="update_id form-control @error('country') is-invalid @enderror" value="">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Modals --}}
{{-- //Directions --}}
<div class="container-fluid">
    <div class="layout-specing">
        <div class="row">
            <div class="col-xl-9 col-lg-6 col-md-4">
                <h5 class="mb-0">Database</h5>
                <nav aria-label="breadcrumb" class="d-inline-block mt-2">
                    <ul class="breadcrumb breadcrumb-muted bg-transparent rounded mb-0 p-0">
                        <li class="breadcrumb-item">Hospital</li><i style="font-size:12px;padding-left:6px" class="fa-solid fa-chevron-right"></i>
                        <li class="breadcrumb-item active" aria-current="page">Add Hospital</li>
                    </ul>
                </nav>
            </div><!--end col-->

            <div class="col-xl-3 col-lg-6 col-md-8 mt-4 mt-md-0">
                <div class="justify-content-md-end">
                    <form>
                        <div class="row justify-content-end align-items-center">
                            <div class="col-sm-12 col-md-7 mt-4 mt-sm-0">
                                <div class="d-grid">
                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#appointmentform">Add Hospital</a>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form><!--end form-->
                </div>
            </div><!--end col-->
        </div>

            {{-- Modals --}}
        <div class="modal fade" id="appointmentform" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header border-bottom p-3">
                        <h5 class="modal-title" id="exampleModalLabel">Hospital</h5>
                        <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                    <div class="modal-body p-3 pt-4">
                        <form action="{{ route('d.hospital.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="">


                                    <div class="row g-3" >
                                        <div class="col">
                                            <label for="" class="form-label"> Hospital image first<span class="text-danger " style="font-size: 9px;">*</span></label>
                                            <input type="file" class="form-control mb-2"  name="imageFirst"  accept="image/*" />
                                        </div>
                                        <div class="col">
                                            <label for="" class="form-label"> Hospital image second</label>
                                            <input type="file" class="form-control mb-2"  name="imageSecond"  accept="image/*" />
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col mb-3">
                                            <label class="form-label">Country <span class="text-danger">*</span></label>
                                            <select class="form-select form-control country  @error('country_id') is-invalid @enderror" name="country_id">
                                                <option value="">-- Select Country --</option>
                                                @forelse ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->country }}</option>
                                                @empty
                                                <option disabled>No Data Found !</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label">State <span class="text-danger">*</span></label>
                                                <select class="form-select form-control @error('state_id') is-invalid @enderror" id="state" name="state_id">
                                                    <option value="">-- Select State --</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                {{-- State --}}


                                <div class="col-md-12 mb-3">
                                    <label for="" class="form-label"> Hospital name <span class="text-danger">*</span></label>
                                    <input type="text"  name="hospital" class="form-control"  placeholder="Appolo "/>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="" class="form-label"> Description <span class="text-danger ">*</span></label>
                                   <textarea class="form-control" name="description" id="" cols="30" rows="5"></textarea>
                                </div>


                                <div class="col-lg-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modals --}}
<hr>
        <div class="row">
            {{-- Website INfo --}}
            <div class="col-md-12">
                <div class="table-responsive shadow rounded">
                    @if ($datas->count() != 0 )
                    <table class="table table-center bg-white mb-0">
                        <thead>
                            <tr>
                                <th class="border-bottom p-3" >Country</th>
                                <th class="border-bottom p-3" >State</th>
                                <th class="border-bottom p-3" style="min-width: 180px;">Hospital</th>
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
                                    <td class="p-3">
                                        <span class="{{ $data->con_country == null ?'badge bg-soft-info':'' }}">{{ $data->con_country == null ?'Unknown':$data->con_country->country }}</span>
                                    </td>
                                    <td class="p-3">
                                        <span class="{{ $data->con_state == null ?'badge bg-soft-info':'' }}">{{ $data->con_state == null ?'Unknown':$data->con_state->state }}</span>
                                    </td>
                                    <th class="p-3">{{ $data->hospital }}</th>
                                    <td class="p-3"><span class="badge bg-soft-{{ $data->status == 0?'danger':'success' }}">{{ $data->status == 0 ?'Deactive':'active' }}</span></td>
                                    <td class="p-3"><span class="badge bg-soft-success">{{ $data->created_at->diffForHumans() }}</span></td>
                                    <td class="text-end p-3">
                                        @if (Auth::guard('admin_model')->user()->can('edit') )
                                        <a href="{{ $data->hospital }}" data-value="{{ $data->id }}" class="update_value btn btn-icon btn-pills btn-soft-success" data-bs-toggle="modal" data-bs-target="#update"><i class="fa-solid fa-pen-to-square"></i></a>
                                        @endif
                                        @if (Auth::guard('admin_model')->user()->can('delete') )
                                        <a href="{{ route('hospital.delete',$data->id) }}" data-bs-toggle="modal" data-bs-target="#LoginFormTwo" class="delete_value btn btn-icon btn-pills btn-soft-danger"><i class="fa-solid fa-trash"></i></a>
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
                <div class="button">
                    <a href="{{ route('d.department') }}" class="btn btn-info btn-sm">Add Department</a>
                </div>
            </div>
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
                                <p class="text-danger">It will Delete every single data under this id !</p>
                                <p class="text-muted mb-0">Do you really want to delete those records? This process cannot be undone</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-secondary" id="close-modal" data-dismiss="modal">Close</button> --}}
                            <a href="" id="delete_confirmTwo" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Modals end --}}
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $(".btn").click(function(){
            var val = $(this).attr('href');
            $('#delete_confirmTwo').attr('href', val);
        });
        $(".update_value").click(function(){
            var upid = $(this).attr('data-value');
            var upval = $(this).attr('href');
            $('.update').val(upval);
            $('.update_id').val(upid);
        });
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



    </script>

    {{-- @if (session('succ'))
        <script>
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            Toast.fire({
            icon: 'success',
            title: '{{ session('succ') }}'
            })
        </script>
    @endif
    @if (session('err'))
        <script>
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            Toast.fire({
            icon: 'warning',
            title: '{{ session('err') }}'
            })
        </script>
    @endif --}}
@endsection
