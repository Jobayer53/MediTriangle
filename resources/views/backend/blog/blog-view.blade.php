
@extends('backend.config.app')


@section('content')
<div class="container-fluid">
    <div class="layout-specing">
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
        <div class="row mb-3">
            <div class="d-md-flex justify-content-between">
                <h5 class="mb-0">Blog</h5>
                <nav aria-label="breadcrumb" class="d-inline-block mt-4 mt-sm-0">
                    <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('d.service') }}">Dashboard</a></li><i style="font-size:12px;padding-left:6px" class="fa-solid fa-chevron-right"></i>
                        <li class="breadcrumb-item active" aria-current="page">Owner</li><i style="font-size:12px;padding-left:6px" class="fa-solid fa-chevron-right"></i>
                        <li class="breadcrumb-item active" aria-current="page">Blog Preview</li>
                    </ul>
                </nav>
            </div>
        </div><!--end row-->

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <img src="{{asset('frontend/blog/'.$blog->image.'')}}" class="mb-3" style="padding-top: 40px; width: 100%">
                        <h2>{{ $blog->title }}</h2>
                        <h4>{{ $blog->category->name }}</h4>

                        <b>Published in</b> {{ \Carbon\Carbon::parse($blog->updated_at)->format('d/m/Y') }} — by <b>{{ $blog->author }}</b>
                        <p>{!! $blog->content !!}</p>

                    </div>
                    <div class=" ">

                        <a href="{{ route('blog.index') }}" class="btn btn-primary btn-sm float-end mb-3 me-3  ">Back</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection
