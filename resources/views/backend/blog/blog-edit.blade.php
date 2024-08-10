@extends('backend.config.app')

@section('sum-style')
    <!-- include libraries(jQuery, bootstrap) -->

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
@endsection

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
                        <li class="breadcrumb-item">Blog</li><i style="font-size:12px;padding-left:6px" class="fa-solid fa-chevron-right"></i>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('doctor.manage') }}">Manage</a></li><i style="font-size:12px;padding-left:6px" class="fa-solid fa-chevron-right"></i>
                        <li class="breadcrumb-item active" aria-current="page">Update</li>
                    </ul>
                </nav>
            </div>
        </div><!--end row-->
            <div class="col-lg-12">
                <form action="{{ route('blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card">
                      

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-6 mb-3">
                                    <label class="col-sm-3 col-form-label">Category Name</label>
                                    <select name="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                        <option value="" disabled>If category is not in the list, than firstly add the
                                            category's information</option>
                                    </select>
                                </div>

                                <div class="form-group col-6">
                                    <label class="col-sm-3 col-form-label">Author's Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" value="{{ $blog->author }}"
                                            name="author">
                                    </div>
                                </div>

                                <div class="form-group col-6 mb-3">
                                    <label class="col-sm-3 col-form-label">Blog Title</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" value="{{ $blog->title }}"
                                            name="title">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Image</label>
                                    <input class="form-control" type="file" id="formFile" name="image">
                                </div>

                                <div class="form-group col-12 mb-3">
                                    <label class="col-sm-3 col-form-label">Content</label>
                                    <textarea id="summernote" name="content">{{ $blog->content }}</textarea>
                                </div>

                                <div class="form-group col-6">
                                    <label class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="active"
                                                {{ $blog->status == 'active' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                Active
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="inactive"
                                                {{ $blog->status == 'inactive' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                Inactive
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="p-3">
                            <h4 class=''>SEO</h4>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-lg-6  mb-3">
                                    <label class=" col-form-label">Slug <span class="required-tag">*</span></label>
                                    <div class="">
                                        <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                            placeholder="blog slug" name="slug" value="{{ $blog->slug }}">
                                        @error('slug')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-lg-6  mb-3">
                                    <label class=" col-form-label">SEO Title</label>
                                    <div class="">
                                        <input type="text" class="form-control" value="{{ $blog->seo_title }}"
                                            name="seo_title">
                                    </div>
                                </div>
                            </div>



                            <div class="form-group  mb-3">
                                <label class=" col-form-label">SEO Description</label>
                                <textarea class="form-control" rows="5" name="seo_description">{{ $blog->seo_description }}</textarea>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label">SEO Tags</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" value="{{ $blog->seo_tags }}"
                                        name="seo_tags">
                                </div>
                            </div>

                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary btn-sm float-end mb-3 me-3 ">Update</button>
                        </div>
                    </div>



                </form>
            </div>
    </div>
</div>
@endsection

@section('sum-script')
    <script>
        $('#summernote').summernote({
            placeholder: 'Write content for your blog',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>
@endsection
