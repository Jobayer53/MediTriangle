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
                        <li class="breadcrumb-item"><a href="{{ route('d.service') }}">Dashboard</a></li><i style="font-size:12px;padding-left:6px" class="fa-solid fa-chevron-right"></i>
                        <li class="breadcrumb-item active" aria-current="page">Owner</li><i style="font-size:12px;padding-left:6px" class="fa-solid fa-chevron-right"></i>
                        <li class="breadcrumb-item active" aria-current="page">Category</li>
                    </ul>
                </nav>
            </div>
        </div><!--end row-->
        <div class="row">

            <div class="col-lg-12">
                <button class="btn btn-primary btn-sm my-3" data-bs-toggle="modal" data-bs-target="#create">Create Category</button>
                <div class="card">
                    @if(session('danger'))
                        <div class="alert alert-danger">{{ session('danger') }}</div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-center">
                                <thead>
                                    <tr>
                                        {{-- <th style="width:50px;">
                                            <div class="form-check custom-checkbox checkbox-success check-lg me-3">
                                                <input type="checkbox" class="form-check-input" id="checkAll" required="">
                                                <label class="form-check-label" for="checkAll"></label>
                                            </div>
                                        </th> --}}
                                        <th><strong>Sl. No</strong></th>
                                        <th><strong>Catergory Name</strong></th>
                                        {{-- <th><strong>SEO Title</strong></th>
                                        <th><strong>SEO Description</strong></th>
                                        <th><strong>SEO Tags</strong></th> --}}
                                        <th><strong>Status</strong></th>
                                        <th><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($category as $sl=>$categories)
                                        <tr>
                                            {{-- <td>
                                                <div class="form-check custom-checkbox checkbox-success check-lg me-3">
                                                    <input type="checkbox" class="form-check-input" id="customCheckBox2" required="">
                                                    <label class="form-check-label" for="customCheckBox2"></label>
                                                </div>
                                            </td> --}}
                                            <td><strong>{{ $sl+1 }}</strong></td>

                                            <td><div class="d-flex align-items-center"><img src="{{ url('/'.$categories->image)}}" class="rounded-lg me-2" width="20" alt=""> <span class="w-space-no">{{ $categories->name }}</span></div></td>

                                            {{-- <td><span class="w-space-no">{{ $categories->seo_title }}</span></td>

                                            <td><span class="w-space-no">{{ $categories->seo_description }}</span></td>
                                            <td><span class="w-space-no">{{ $categories->seo_tags }}</span></td> --}}

                                            <td><span class="badge  {{ $categories->status == 'inactive' ? 'text-bg-danger' : 'text-bg-primary' }} badge-success">{{ $categories->status }}</span></td>

                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('category.edit', $categories->id) }}" class="btn btn-primary shadow btn-sm sharp me-1"><i class="fa fa-pencil"></i></a>

                                                    <form action="{{ route('category.destroy', $categories->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger shadow btn-sm sharp"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Create Category</h1>
            <button type="button" class=" btn text-dark" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" @error('name') is-invalid @enderror"
                                            placeholder="Enter Category Name" name="name"  required>
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
                                        <input type="text" class="form-control" @error('slug') is-invalid @enderror"
                                            placeholder="Create slugs" name="slug" required>
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
                                            checked>
                                        <label class="form-check-label">
                                            Active
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="inactive">
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
                                    <input type="text" class="form-control" @error('seo_title') is-invalid @enderror"
                                        placeholder="Enter SEO title" name="seo_title" required>
                                    @error('seo_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class=" mb-3">
                                <label class="col-form-label">SEO Description</label>
                                <textarea class="form-control" rows="5" @error('seo_description') is-invalid @enderror" name="seo_description" required></textarea>
                                @error('seo_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class=" col-form-label">SEO Tags</label>
                                <div class="">
                                    <input type="text" class="form-control" @error('seo_tags') is-invalid @enderror"
                                        placeholder="Enter SEO tags" name="seo_tags" required>
                                    @error('seo_tags')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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

</div>
</div>
@endsection
