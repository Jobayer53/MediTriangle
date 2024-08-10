@extends('backend.config.app')
@section('content')
<div class="container-fluid">
    <div class="layout-specing">
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
        <div class="row mb-3">
            <div class="d-md-flex justify-content-between">
                <h5 class="mb-0">Category</h5>
                <nav aria-label="breadcrumb" class="d-inline-block mt-4 mt-sm-0">
                    <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                        <li class="breadcrumb-item">Category</li><i style="font-size:12px;padding-left:6px" class="fa-solid fa-chevron-right"></i>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('doctor.manage') }}">Manage</a></li><i style="font-size:12px;padding-left:6px" class="fa-solid fa-chevron-right"></i>
                        <li class="breadcrumb-item active" aria-current="page">Update</li>
                    </ul>
                </nav>
            </div>
        </div><!--end row-->
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    @if(session('danger'))
                        <div class="alert alert-danger">{{ session('danger') }}</div>
                    @endif

                    <div class="card-body">
                        <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="col-sm-3 col-form-label">Name</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" placeholder="Enter Category Name"
                            name="name" value="{{ $category->name }}" required>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="col-sm-3 col-form-label">Slugs</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" placeholder="Enter Category Name"
                                                name="slug" value="{{ $category->slug }}" required>
                                                @error('slug')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- <div class="mb-3 col-md-6">
                                            <label for="formFile" class="form-label">Add Category Image</label>
                                            <input class="form-control" @error('image') is-invalid @enderror" type="file"
                                                id="formFile" name="image">
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> --}}
                                    </div>

                                    <div class="form-group row mt-4">
                                        <label class="col-sm-1 col-form-label">Status:</label>
                                        <div class="col-sm-9 mt-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" value="active"
                                                    {{ $category->status == 'active' ? 'checked' : '' }}>
                                                <label class="form-check-label">
                                                    Active
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" value="inactive"
                                                    {{ $category->status == 'inactive' ? 'checked' : '' }}>
                                                <label class="form-check-label">
                                                    Inactive
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                            <div class="border-top mt-4">
                                <div class="">
                                    <div class=" mt-4 mb-3" >
                                        <label class="col-sm-3 col-form-label">SEO Title</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" value="{{ $category->seo_title }}"
                                            name="seo_title" required>
                                            @error('seo_title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class=" mb-3">
                                        <label class="col-form-label">SEO Description</label>
                                        <textarea class="form-control" rows="5" name="seo_description" required>{{ $category->seo_description }}</textarea>
                                        @error('seo_description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class=" col-form-label">SEO Tags</label>
                                        <div class="">
                                            <input type="text" class="form-control" value="{{ $category->seo_tags }}"
                                            name="seo_tags" required>
                                            @error('seo_tags')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="float-end">
                                {{-- <button type="button" class="btn btn-secondary me-3 btn-sm" data-bs-dismiss="modal">Close</button> --}}
                                <button type="submit" class="btn btn-primary  btn-sm ">Update</button>
                            </div>


                        </form>
                    </div>

                </div>
            </div>
        </div>




</div>
</div>
@endsection
{{-- <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Category</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-6">
                    <label class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" placeholder="Enter Category Name"
                            name="name" value="{{ $category->name }}">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="col-sm-3 col-form-label">Slugs</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" placeholder="Enter Category Name"
                            name="slug" value="{{ $category->slug }}">
                    </div>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="formFile" class="form-label">Edit Category Image</label>
                    <input class="form-control" type="file" id="formFile" name="image">
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="active"
                                {{ $category->status == 'active' ? 'checked' : '' }}>
                            <label class="form-check-label">
                                Active
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="inactive"
                                {{ $category->status == 'inactive' ? 'checked' : '' }}>
                            <label class="form-check-label">
                                Inactive
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class='card-title'>SEO</h4>
        </div>

        <div class="card-body">

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">SEO Title</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" value="{{ $category->seo_title }}"
                        name="seo_title">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">SEO Description</label>
                <textarea class="from-control" rows="5" name="seo_description">{{ $category->seo_description }}</textarea>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">SEO Tags</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" value="{{ $category->seo_tags }}"
                        name="seo_tags">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form> --}}
