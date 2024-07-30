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
                        <li class="breadcrumb-item"><a href="{{ route('d.service') }}">Dashboard</a></li><i style="font-size:12px;padding-left:6px" class="fa-solid fa-chevron-right"></i>
                        <li class="breadcrumb-item active" aria-current="page">Owner</li><i style="font-size:12px;padding-left:6px" class="fa-solid fa-chevron-right"></i>
                        <li class="breadcrumb-item active" aria-current="page">Blog</li>
                    </ul>
                </nav>
            </div>
        </div><!--end row-->
        <button class="btn btn-primary btn-sm my-3" data-bs-toggle="modal" data-bs-target="#create">Create Blog</button>
        <div class="row">
            <div class="col-lg-12">
                    @if (session('danger'))
                        <div class="alert alert-danger">{{ session('danger') }}</div>
                    @endif
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th><strong>#</strong></th>
                                        <th><strong>Blog Title</strong></th>
                                        <th><strong>Category Name</strong></th>
                                        <th><strong>Author's Name</strong></th>
                                        <th><strong>Image</strong></th>
                                        <th><strong>Status</strong></th>
                                        <th><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blog as $sl => $blogs)
                                        <tr>
                                            <td><strong>{{ $sl + 1 }}</strong></td>
                                            <td><span class="w-space-no">{{ $blogs->title }}</span>  </td>
                                            <td><span class="w-space-no">{{ $blogs->category->name }}</span></td>
                                            <td><span class="w-space-no">{{ $blogs->author }}</span></td>
                                            <td>
                                                <div class="d-flex align-items-center"><img src="{{ asset('frontend/blog') }}/{{ $blogs->image }}"
                                                        class="rounded-lg me-2" width="20" alt="">
                                            </td>
                                            <td><span
                                                    class="badge  {{ $blogs->status == 'inactive' ? 'text-bg-danger' : 'badge light' }} text-bg-primary">{{ $blogs->status }}</span>
                                            </td>

                                            <td>
                                                <divsm class="d-flex">
                                                    <a href="{{ route('blog.edit', $blogs->id) }}"
                                                        class="btn btn-primary shadow btn-sm sharp me-1"><i class="fa fa-pencil"></i></a>

                                                    <a href="{{ route('blog.show', $blogs->id) }}"
                                                        class="btn btn-info shadow btn-sm sharp me-1"><i class="fa fa-eye"></i></a>

                                                    <form action="{{ route('blog.destroy', $blogs->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger shadow btn-sm sharp"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </divsm
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $blog->links( 'pagination::bootstrap-5') }}
                        </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Blog</h1>
        <button type="button" class=" btn text-dark" data-bs-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">
            <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="">

                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <label class="col-form-label ">Category Name
                                    *</label>
                                <select name="category_id"
                                    class="form-control @error('category_id') is-invalid @enderror">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                    <option value="" disabled>If category is not in the list, than firstly add the
                                        category's information</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label class=" col-form-label">Author's Name</label>
                                <div class="">
                                    <input type="text" class="form-control @error('author') is-invalid @enderror"
                                        placeholder="Author's Name" name="author" value="{{ old('author') }}">
                                    @error('author')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label class="col-sm-3 col-form-label">Blog Title <span
                                        class="required-tag">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Enter blog title" name="title" value="{{ old('title') }}">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 col-md-6 ">
                                <label for="formFile" class="form-label">Image <span
                                        style="font-size: 12px;font-style: italic">width-110px / height-80px</span>
                                </label>
                                <input class="form-control @error('image') is-invalid @enderror" type="file"
                                    id="formFile" name="image" value="{{ old('image') }}">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label class="col-form-label">Blog Part <span
                                        style="font-size: 11px;font-style: italic">Alternate</span></label>
                                <select name="blog_id" class="form-control @error('blog_id') is-invalid @enderror">
                                    <option value="">Select blog</option>
                                    @foreach ($blog as $blg)
                                        <option value="{{ $blg->id }}">{{ $blg->slug }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 col-form-label">Content <span
                                        class="required-tag">*</span></label>
                                <textarea id="summernote" class=" @error('content') is-invalid @enderror" name="content">{{ old('content') }}</textarea>
                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-top mt-5">
                    <div class="">
                        <h4 class='card-title'>SEO</h4>
                    </div>

                    <div class="">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">Slug <span class="required-tag">*</span></label>
                                <div class="">
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                        placeholder="blog slug" name="slug" value="{{ old('slug') }}">
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-sm-3 col-form-label">SEO Title</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" placeholder="Title" name="seo_title"
                                        value="{{ old('seo_title') }}">
                                    @error('seo_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class=" col-form-label">SEO Description</label>
                                <textarea class="form-control" rows="5" @error('seo_description') is-invalid @enderror" name="seo_description"
                                    placeholder="Write description" is-invalid>{{ old('seo_title') }}</textarea>
                                @error('seo_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-sm-3 col-form-label">SEO Tags</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" placeholder="Tags" name="seo_tags"
                                        value="{{ old('seo_tags') }}">
                                    @error('seo_tags')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary  btn-sm ">Submit</button>
                </div>
            </form>
        </div>

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
