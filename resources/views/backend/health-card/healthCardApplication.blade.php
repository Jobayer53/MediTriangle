<?php
use App\Models\HealthCard;
?>

@extends('backend.config.app')

@section('content')
<div class="container-fluid">
    <div class="layout-specing">
        <div class="row">
            <div class="col-lg-12 m-auto">
                <div class="" >

                    <div class="row">
                        <div class="row d-flex flex-row-reverse">
                            <div class="col-xl-5 col-lg-5 col-md-8 mt-4 mt-md-0">
                                <div class="justify-content-md-end">

                                    <form method="GET" id="searchForm" class="d-flex search-form">
                                        @csrf
                                        <input id="searchInput" class="form-control me-2" type="search" name="search" placeholder="Search..." aria-label="Search" @if (Request::get('search')) value="{{ Request::get('search')}}" @endif>
                                        <button class="btn btn-default btn-lg" type="submit"><i class="fa-solid fa-search"></i></button>
                                        <a href="{{route('health.card.data')}}" class="btn btn-secondary btn-lg">Clear</a>
                                    </form>

                                </div>
                            </div><!--end col-->
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive shadow rounded ">
                        @if ($applicatios->count() != 0 )
                            <table class="table t bg-white mb-0" id="resultsTable">
                                <thead>
                                    <tr>
                                       <th >ID</th>
                                       <th >Name</th>
                                        <th>Phone Number</th>
                                        <th >Address</th>
                                        <th >Passport/Nid</th>
                                        <th >Status</th>

                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach ($applicatios as $data)
                                    <tr>
                                        <td>{{ $data->slug }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td class="">{{$data->number }}</td>
                                        <td>  {{$data->address}} </td>
                                        <td>  {{$data->passport_nid? $data->passport_nid:'NO DATA'}} </td>
                                        <td> <span class="badge bg-soft-info">{{ $data->status }}</span> </td>


                                        {{-- <td><span class="badge bg-soft-{{ $data->status == 0?'danger':'success' }}">{{ $data->status == 0 ?'Deactive':'active' }}</span></td> --}}
                                        {{-- <td><span class="badge bg-soft-{{ $data->status == 0?'danger':'success' }}">{{ $data->status == 0 ?'Deactive':'active' }}</span></td> --}}
                                        <td class="">
                                            <a href="{{route('health.card.edit',$data->id)}}" class=" btn btn-icon btn-pills btn-soft-success d" ><i class="fa-solid fa-pen-to-square"></i></a>

                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @else
                        <span class="text-center bg-soft-warning" id="noData"><p class="m-0">No Data Found !</p></span>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <!-- PAGINATION START -->
        <div class="col-12 mt-4">
            <div class="d-md-flex align-items-center text-center justify-content-between">
                {{ $applicatios->links('pagination::bootstrap-4') }}
            </div>
        </div><!--end col-->
        <!-- PAGINATION END -->
    </div><!--end row-->
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
function performSearch() {
    const query = $('#searchInput').val();

    $.ajax({
        url: '{{ route('health.card.view.search') }}',
        type: 'GET',
        data: { search: query },
        success: function(response) {
            const results = response.data;
            let rows = '';

            if (results.length > 0) {
                results.forEach(result => {
                    rows += `<tr>
                                <td>${result.slug}</td>
                                <td>${result.name}</td>
                                <td>${result.number}</td>
                                <td>${result.address}</td>
                                <td>${result.passport_nid || 'NO DATA'}</td>
                                <td><span class="badge bg-soft-info">${result.status}</span></td>
                                <td>
                                    <a href="{{ url('health-card/edit/${result.id}') }}" class="btn btn-icon btn-pills btn-soft-success"><i class="fa-solid fa-pen-to-square"></i></a>
                                </td>
                            </tr>`;
                });

                $('#tableBody').html(rows);
                $('#noData').addClass('d-none');
            } else {
                $('#tableBody').empty();
                $('#noData').removeClass('d-none');
            }
        },
        error: function(xhr) {
            console.error('Error:', xhr);
        }
    });
}

// Optionally, you can trigger search on pressing Enter
$('#searchInput').keypress(function(e) {
    console.log($this.val);

    if (e.which == 13) {
        performSearch();
        e.preventDefault();
    }
});
</script>
@endsection


