@extends('frontend.config.app')
@php
    $tags = explode(',', $blog->seo_tags);

    function convert_to_bengali($number)
    {
        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $bengaliDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        return str_replace($englishDigits, $bengaliDigits, $number);
    }
@endphp
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
    .breadcrumb {
    font-size: 14px;
    padding: 0;
    margin-bottom: 20px;
    list-style: none;
    background-color: transparent;
    border-radius: 0;
}
.breadcrumb-breaker {
    padding: 0px 5px;
}
.post-single .post-header .title {
    font-size: 36px;
}
.post .meta {
    font-size: 14px;
    color: #9faabb;
}
.post-header{
    margin-bottom: 15px;
}
.post-single .post-content {
    color: #707a88;
    font-size: 16px;
}
.post .meta li:not(:last-child) {
    margin-right: 0.8rem;
}

.post-single ul li {
    list-style-type: circle;
}
.post .meta li:after {
    content: "";
    display: inline-block;
    background-color: #C60B0D;
    border-radius: 50%;
    margin-left: 1rem;
    height: 3px;
    vertical-align: middle;
    position: relative;
    top: -1px;
    width: 3px;
}
.post .meta li:last-child:after {
 background-color: transparent;
}
.post .meta a {
    color: #9faabb;
    font-weight: 400;
}
.section-title {
    font-size: 24px;
    margin: 0;
}
.section-header {
    margin-bottom: 30px;
    position: relative;
}
</style>
@endsection
@section('content')



<section class="main-content mt-3">
    <div class="container-xl">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-items"><a href="{{route('blogs')}}">Home</a></li><span class="breadcrumb-breaker">/</span>
                <li class="breadcrumb-items"><a href="#">Inspiration</a></li><span
                    class="breadcrumb-breaker">/</span>
                <li class="breadcrumb-items active" aria-current="page">{{ $blog->title }}</li>
            </ol>
        </nav>

        <div class="row gy-4">

            <div class="col-lg-12">
                <!-- post single -->
                <div class="post post-single">
                    <!-- post header -->

                    <div class="post-header">
                        <h1 class="title mt-0 mb-3 bd-font">{{ $blog->title }}</h1>
                        <ul class="meta list-inline mb-0">
                            <li class="list-inline-item"><a href="#">{{ $blog->category->name }}</a></li>
                            <li class="list-inline-item">{{ $blog->created_at->format('d M y') }}</li>
                            <li class="list-inline-item"><i class="fa-solid fa-eye"></i> {{ number_format($blog->view_count) }}</a></li>
                        </ul>
                    </div>
                    <div class="post-header mb-4">
                        <img width="100%" height="50%" src="{{asset('frontend/blog/'.$blog->image)}}" alt="">
                    </div>
                    <!-- post content -->
                    <div class="post-content clearfix">
                        <div class="entry-content bd-font" itemprop="text">
                            {!! $blog->content !!}
                        </div>
                    </div>
                    <!-- post bottom section -->
                    <div class="post-bottom">
                        <div class="row d-flex align-items-center">
                            <div class="col-md-6 col-12 text-center text-md-start">
                                <!-- tags -->
                                {{-- @foreach ($tags as $key => $tag)
                                    <a href="#" class="tag">#{{ $tag }}</a>
                                @endforeach --}}
                            </div>
                                {{-- <div class="col-md-6 col-12">
                                    <!-- social icons -->
                                    <ul class="social-icons list-unstyled list-inline mb-0 float-md-end">
                                        <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="#"><i
                                                    class="fab fa-linkedin-in"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="#"><i
                                                    class="fab fa-telegram-plane"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="far fa-envelope"></i></a>
                                        </li>
                                    </ul>
                                </div> --}}
                        </div>
                    </div>

                </div>

                {{-- @if ($blog->parts)
                    <div class="spacer" data-height="50" style="height: 50px;"></div>

                    <div class="row">
                        @foreach ($blog->parts as $key => $part)
                            @if ($part->part)

                                <div class="col-6 col-md-3">
                                    <div class="card bd-card p-1 position-relative shadow-sm rounded bd-font">
                                        <a style="bottom: -16px; width:45px;"
                                            class="btn btn-default shadow text-white position-absolute start-50 translate-middle-x rounded-5"
                                            href="{{ route('blog.view', $part->part->slug) }}">{{ $key + 1 }}</a>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="{{ route('blog.view', $part->part->slug) }}">
                                                        <h5 style="font-size: 13px;margin: 5px 0">
                                                            {{ $part->part->title }}
                                                        </h5>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="row" style="font-size: 11px">
                                                <div class="col-6 text-secondary">
                                                    <span class="fw-bolder">khaalifa</span>
                                                </div>
                                                <div class="col-6 fw-bolder" style="text-align: end">
                                                    <p class="text-secondary"><span style="padding-right: 3px"><img
                                                                src="{{ asset('Themes/Theme1/images/eye.svg') }}"
                                                                alt=""></span>{{ number_format($part->part->view_count) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                @endif --}}

                <div class="spacer" data-height="50" style="height: 50px;"></div>

                <!-- section header -->
                <div class="section-header">
                    <h3 class="section-title">Related</h3>
                    {{-- <img src="{{ asset('Themes/Theme1/images/wave.svg') }}" class="wave" alt="wave" /> --}}
                </div>

                <div class="row gy-5">
                    @foreach ($related as $blog)
                        <div class="col-lg-6 mb-2">
                            {{-- <x-blog-main :blog="$blog" /> --}}
                        </div>
                    @endforeach
                </div>
            </div>



        </div>

    </div>
</section>
@endsection
