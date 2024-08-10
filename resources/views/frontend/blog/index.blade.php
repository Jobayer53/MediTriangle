{{-- @php
    function convert_to_bengali($number)
    {
        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $bengaliDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        return str_replace($englishDigits, $bengaliDigits, $number);
    }
@endphp --}}
@extends('frontend.config.app')
@section('style')
<style>
    .rounded {
        border-radius: 10px !important;
    }
    .widget {
        border: solid 1px #EBEBEB;
        padding: 35px 30px;
        margin-bottom: 40px;
    }
    .widget .widget-header {
        margin-bottom: 30px;
    }
    .post.post-list-sm {
        clear: both;
    }
    .post.post-list-sm.circle .thumb {
        max-width: 60px;
    }

    .post.post-list-sm .thumb {
        float: left;
        position: relative;
    }
    .post .thumb {
        position: relative;
    }
    .post.post-list-sm.circle .details {
        margin-left: 80px;
    }
    .post .meta {
        font-size: 14px;
        color: #9faabb;
    }
    .post.post-list-sm:after {
        content: "";
        display: block;
        height: 1px;
        margin-bottom: 20px;
        margin-top: 20px;
        width: 100%;
        background: #EBEBEB;
        background: -webkit-linear-gradient(right, #EBEBEB 0%, transparent 100%);
        background: linear-gradient(to left, #EBEBEB 0%, transparent 100%);
    }
    .clearfix::after {
        display: block;
        clear: both;
        content: "";
    }
    .post .thumb.circle .inner {
        overflow: hidden;
        border-radius: 50%;
        width: 58px;
        height: 58px;
        background: #3BB8AE;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .inner-text {
        color: #000000;
        font-size: 40px;
    }
    .custom{
        transition: all 0.3s ease-in-out;
    }
    .custom:hover{
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15);
    }
</style>
@endsection
@section('content')
 {{--<section class="page-header py-4" style="background: #F1F8FF;">
    <div class="container-xl">
        <div class="text-center">
            <h1 class="mt-0 mb-2">Blogs</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li> <span
                        style="padding:0 6px ">/</span>
                    <li class="breadcrumb-item active" aria-current="page">blog</li>
                </ol>
            </nav>
        </div>
    </div>
</section>--}}
<div class="container-fluid py-5">
    <div class="container">
        <section class="main-content mt-3">
            <div class="container-xl">
                <div class="row gy-4">
                    <div class="col-lg-8">
                        <div class="row gy-4">
                            @forelse ($blogs as $blog )
                            <div class="col-lg-6 mb-2 ">
                                <div class="custom card bd-card p-1 position-relative  rounded bd-font">
                                    <div class="card-body">
                                        <div class="row">
                                            @if($blog->image)
                                            <img  style="width:100%; height:220px;" src="{{ asset('frontend/blog/'.$blog->image) }}">
                                            @else
                                            <img style="width:100%; height:220px;" src="{{ asset('image-not-found.avif') }}">
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <a href="{{ route('blog_view', $blog->slug) }}">
                                                    <h5 class="fw-bolder bd-font mt-1">{{ $blog->title }}</h5>
                                                </a>
                                                <p class="text-secondary mt-3">
                                                    {{ $blog->description() }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row" style="font-size: 13px">
                                            <div class="col-6 text-secondary">
                                                by <span class="text-uppercase fw-bolder">{{ $blog->author }}</span>
                                            </div>
                                            <div class="col-6 fw-bolder" style="text-align: end">
                                                <p class="text-secondary"><span style="padding-right: 3px"><img
                                                            src="{{ asset('Themes/Theme1/images/eyebig.svg') }}"
                                                            alt=""></span>{{ number_format($blog->view_count) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @empty
                            <div class="col-lg-12 mb-2 ">
                                <div class="mt-5 card bd-card p-1 position-relative  rounded bd-font">
                                    <div class="card-body text-center">
                                        <h5>No blog found</h5>
                                    </div>
                                </div>
                            </div>
                            @endforelse


                         </div>

                        <div class="spacer" data-height="50" style="height: 30px;"></div>

                        <div class="row">
                            {{ $blogs->links('pagination::bootstrap-5') }}
                        </div>



                    </div>

                    <div class="col-lg-4">
                        <div class="widget rounded">
                            <div class="widget-header text-center">
                               <h3 class="widget-title bd-font">Category</h3>
                               <svg xmlns="http://www.w3.org/2000/svg" width="33" height="6" style="filter: invert(0);">
                                <defs>
                                    <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                        <stop offset="0%" stop-color="#FE4F70"/>
                                        <stop offset="100%" stop-color="#FFA387"/>
                                    </linearGradient>
                                    </defs>
                                <path d="M33 1c-3.3 0-3.3 4-6.598 4C23.1 5 23.1 1 19.8 1c-3.3 0-3.3 4-6.599 4-3.3 0-3.3-4-6.6-4S3.303 5 0 5" stroke="url(#gradient)" stroke-width="2" fill="none"/>
                            </svg>
                            </div>
                            <div class="widget-content">
                               <!-- post -->
                               <div class="post post-list-sm circle">
                                <ul class="list-group list-group-flush">
                                    @forelse ($cats as  $category)
                                    <li class="list-group-item"><a href="{{ route('category_blog_show', $category->slug) }}" class="text text-dark">{{ $category->name }}</a></li>
                                    @empty
                                    <li class="list-group-item">No Data Found</li>
                                    @endforelse
                                  </ul>
                               </div>

                            </div>
                         </div>
                    </div>

                </div>

            </div>
        </section>
    </div>
</div>
@endsection
