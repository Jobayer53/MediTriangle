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
</style>
@endsection
@section('content')
<section class="page-header py-4" style="background: #F1F8FF;">
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
</section>
<div class="container-fluid py-5">
    <div class="container">
        <section class="main-content mt-3">
            <div class="container-xl">
                <div class="row gy-4">
                    <div class="col-lg-8">
                        <div class="row gy-4">
                            <div class="col-lg-6 mb-2">
                               <div class="card bd-card p-1 position-relative shadow-sm rounded bd-font">
                                  <a style="bottom: -16px; width:160px;" class="btn btn-default shadow text-white position-absolute start-50 translate-middle-x rounded-5" href="https://rupkotha.bn.synexdigital.com/view/parsonal-brzanding-ken-drkar">Read</a>
                                  <div class="card-body">
                                     <div class="row">
                                        <img src="https://rupkotha.bn.synexdigital.com/dashboards/Theme1/images/blog/1720872005.jpg">
                                     </div>
                                     <div class="row">
                                        <div class="col">
                                           <a href="https://rupkotha.bn.synexdigital.com/view/parsonal-brzanding-ken-drkar">
                                              <h5 class="fw-bolder bd-font">পারসোনাল ব্র্যান্ডিং কেন দরকার?</h5>
                                           </a>
                                           <p class="text-secondary mt-3">
                                              এন্টারপ্রেনার হই অথবা জব করি, পারসোনাল ব্র্যান্ডিং সবার জন্যই গুরুত্বপূর্ণ। অন্যরা কিভাবে...
                                           </p>
                                        </div>
                                     </div>
                                     <div class="row" style="font-size: 13px">
                                        <div class="col-6 text-secondary">
                                           by <span class="text-uppercase fw-bolder">হোসাইন</span>
                                        </div>
                                        <div class="col-6 fw-bolder" style="text-align: end">
                                           <p class="text-secondary"><span style="padding-right: 3px"><img src="https://rupkotha.bn.synexdigital.com/Themes/Theme1/images/eyebig.svg" alt=""></span>12</p>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                               <div class="card bd-card p-1 position-relative shadow-sm rounded bd-font">
                                  <a style="bottom: -16px; width:160px;" class="btn btn-default shadow text-white position-absolute start-50 translate-middle-x rounded-5" href="https://rupkotha.bn.synexdigital.com/view/kise-invest-krb">Read</a>
                                  <div class="card-body">
                                     <div class="row">
                                        <img src="https://rupkotha.bn.synexdigital.com/dashboards/Theme1/images/blog/1720869942.jpg">
                                     </div>
                                     <div class="row">
                                        <div class="col">
                                           <a href="https://rupkotha.bn.synexdigital.com/view/kise-invest-krb">
                                              <h5 class="fw-bolder bd-font">কিসে ইনভেস্ট করব?</h5>
                                           </a>
                                           <p class="text-secondary mt-3">
                                              সর্বজনীন পেনশন স্কিম, বন্ড, বীমা, ফিক্সড ডিপোজিট এসব করা থেকে ফিক্সড কোন এসেটে ব্যয় করুন।...
                                           </p>
                                        </div>
                                     </div>
                                     <div class="row" style="font-size: 13px">
                                        <div class="col-6 text-secondary">
                                           by <span class="text-uppercase fw-bolder">হোসাইন</span>
                                        </div>
                                        <div class="col-6 fw-bolder" style="text-align: end">
                                           <p class="text-secondary"><span style="padding-right: 3px"><img src="https://rupkotha.bn.synexdigital.com/Themes/Theme1/images/eyebig.svg" alt=""></span>1</p>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                               <div class="card bd-card p-1 position-relative shadow-sm rounded bd-font">
                                  <a style="bottom: -16px; width:160px;" class="btn btn-default shadow text-white position-absolute start-50 translate-middle-x rounded-5" href="https://rupkotha.bn.synexdigital.com/view/%E0%A6%B0%E0%A6%AC%E0%A7%80%E0%A6%A8%E0%A7%8D%E0%A6%A6%E0%A7%8D%E0%A6%B0%E0%A6%A8%E0%A6%BE%E0%A6%A5%E0%A7%87%E0%A6%B0-%E0%A6%95%E0%A6%AC%E0%A6%BF%E0%A6%A4%E0%A6%BE%E0%A6%AF%E0%A6%BC-%E0%A6%93-%E0%A6%97%E0%A6%BE%E0%A6%A8%E0%A7%87-%E0%A6%B0%E0%A6%A5-%E0%A6%AA%E0%A7%8D%E0%A6%B0%E0%A6%B8%E0%A6%99%E0%A7%8D%E0%A6%97">Read</a>
                                  <div class="card-body">
                                     <div class="row">
                                        <img src="https://rupkotha.bn.synexdigital.com/dashboards/Theme1/images/blog/1720871851.jpg">
                                     </div>
                                     <div class="row">
                                        <div class="col">
                                           <a href="https://rupkotha.bn.synexdigital.com/view/%E0%A6%B0%E0%A6%AC%E0%A7%80%E0%A6%A8%E0%A7%8D%E0%A6%A6%E0%A7%8D%E0%A6%B0%E0%A6%A8%E0%A6%BE%E0%A6%A5%E0%A7%87%E0%A6%B0-%E0%A6%95%E0%A6%AC%E0%A6%BF%E0%A6%A4%E0%A6%BE%E0%A6%AF%E0%A6%BC-%E0%A6%93-%E0%A6%97%E0%A6%BE%E0%A6%A8%E0%A7%87-%E0%A6%B0%E0%A6%A5-%E0%A6%AA%E0%A7%8D%E0%A6%B0%E0%A6%B8%E0%A6%99%E0%A7%8D%E0%A6%97">
                                              <h5 class="fw-bolder bd-font">রবীন্দ্রনাথের কবিতায় ও গানে রথ-প্রসঙ্গ</h5>
                                           </a>
                                           <p class="text-secondary mt-3">
                                              রবীন্দ্রনাথ যে সময়ে জন্মেছিলেন, কলকাতায় তখন রথ দৈনন্দিন ব্যবহারের মধ্যে সচল ছিল না।...
                                           </p>
                                        </div>
                                     </div>
                                     <div class="row" style="font-size: 13px">
                                        <div class="col-6 text-secondary">
                                           by <span class="text-uppercase fw-bolder">Jisan</span>
                                        </div>
                                        <div class="col-6 fw-bolder" style="text-align: end">
                                           <p class="text-secondary"><span style="padding-right: 3px"><img src="https://rupkotha.bn.synexdigital.com/Themes/Theme1/images/eyebig.svg" alt=""></span>4</p>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                               <div class="card bd-card p-1 position-relative shadow-sm rounded bd-font">
                                  <a style="bottom: -16px; width:160px;" class="btn btn-default shadow text-white position-absolute start-50 translate-middle-x rounded-5" href="https://rupkotha.bn.synexdigital.com/view/%E0%A6%A1%E0%A6%BF%E0%A6%B8%E0%A7%87%E0%A6%A8%E0%A7%8D%E0%A6%9F-%E0%A6%87%E0%A6%A8%E0%A6%9F%E0%A7%81-%E0%A6%AE%E0%A6%BE%E0%A6%87%E0%A6%B8%E0%A7%87%E0%A6%B2%E0%A6%AB-%E0%A6%9A%E0%A6%BF%E0%A6%95%E0%A6%BF%E0%A7%8E%E0%A6%B8%E0%A6%BE-%E0%A6%B8%E0%A6%BE%E0%A6%B9%E0%A6%BF%E0%A6%A4%E0%A7%8D%E0%A6%AF-%E0%A6%8F%E0%A6%AC%E0%A6%82-%E0%A6%86%E0%A6%A4%E0%A7%8D%E0%A6%AE%E0%A6%B8%E0%A6%AE%E0%A7%80%E0%A6%95%E0%A7%8D%E0%A6%B7%E0%A6%BE%E0%A6%B0-%E0%A6%B8%E0%A6%AE%E0%A7%80%E0%A6%95%E0%A6%B0%E0%A6%A3">Read</a>
                                  <div class="card-body">
                                     <div class="row">
                                        <img src="https://rupkotha.bn.synexdigital.com/dashboards/Theme1/images/blog/1720875495.jpg">
                                     </div>
                                     <div class="row">
                                        <div class="col">
                                           <a href="https://rupkotha.bn.synexdigital.com/view/%E0%A6%A1%E0%A6%BF%E0%A6%B8%E0%A7%87%E0%A6%A8%E0%A7%8D%E0%A6%9F-%E0%A6%87%E0%A6%A8%E0%A6%9F%E0%A7%81-%E0%A6%AE%E0%A6%BE%E0%A6%87%E0%A6%B8%E0%A7%87%E0%A6%B2%E0%A6%AB-%E0%A6%9A%E0%A6%BF%E0%A6%95%E0%A6%BF%E0%A7%8E%E0%A6%B8%E0%A6%BE-%E0%A6%B8%E0%A6%BE%E0%A6%B9%E0%A6%BF%E0%A6%A4%E0%A7%8D%E0%A6%AF-%E0%A6%8F%E0%A6%AC%E0%A6%82-%E0%A6%86%E0%A6%A4%E0%A7%8D%E0%A6%AE%E0%A6%B8%E0%A6%AE%E0%A7%80%E0%A6%95%E0%A7%8D%E0%A6%B7%E0%A6%BE%E0%A6%B0-%E0%A6%B8%E0%A6%AE%E0%A7%80%E0%A6%95%E0%A6%B0%E0%A6%A3">
                                              <h5 class="fw-bolder bd-font">ডিসেন্ট ইনটু মাইসেলফ – চিকিৎসা, সাহিত্য, এবং আত্মসমীক্ষার সমীকরণ</h5>
                                           </a>
                                           <p class="text-secondary mt-3">
                                              প্রেক্ষিত প্রথম বিশ্বযুদ্ধকালীন রাশিয়া। চরিত্রের নামগুলি কাল্পনিক হলেও ঘটনা ভয়ঙ্করভাবে...
                                           </p>
                                        </div>
                                     </div>
                                     <div class="row" style="font-size: 13px">
                                        <div class="col-6 text-secondary">
                                           by <span class="text-uppercase fw-bolder">Jisan</span>
                                        </div>
                                        <div class="col-6 fw-bolder" style="text-align: end">
                                           <p class="text-secondary"><span style="padding-right: 3px"><img src="https://rupkotha.bn.synexdigital.com/Themes/Theme1/images/eyebig.svg" alt=""></span>6</p>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </div>
                         </div>

                        <div class="spacer" data-height="50" style="height: 30px;"></div>

                        <div class="row">
                            {{ $blogs->links('pagination::bootstrap-4') }}
                        </div>



                    </div>

                    <div class="col-lg-4">
                        <div class="widget rounded">
                            <div class="widget-header text-center">
                               <h3 class="widget-title bd-font">চিরকাল বিখ্যাত</h3>
                               <img src="https://rupkotha.bn.synexdigital.com/Themes/Theme1/images/wave.svg" class="wave" alt="wave">
                            </div>
                            <div class="widget-content">
                               <!-- post -->
                               <div class="post post-list-sm circle">
                                  <div class="thumb circle">
                                     <a href="https://rupkotha.bn.synexdigital.com/view/parsonal-brzanding-ken-drkar">
                                        <div class="inner">
                                           <span class="inner-text bd-font">১</span>
                                        </div>
                                     </a>
                                  </div>
                                  <div class="details clearfix">
                                     <h6 class="post-title my-0 bd-font"><a href="https://rupkotha.bn.synexdigital.com/view/parsonal-brzanding-ken-drkar">পারসোনাল ব্র্যান্ডিং কেন দরকার?</a>
                                     </h6>
                                     <ul class="meta list-inline mt-1 mb-0">
                                        <li class="list-inline-item">07 Jul 24</li>
                                     </ul>
                                  </div>
                               </div>
                               <!-- post -->
                               <div class="post post-list-sm circle">
                                  <div class="thumb circle">
                                     <a href="https://rupkotha.bn.synexdigital.com/view/%E0%A6%A1%E0%A6%BF%E0%A6%B8%E0%A7%87%E0%A6%A8%E0%A7%8D%E0%A6%9F-%E0%A6%87%E0%A6%A8%E0%A6%9F%E0%A7%81-%E0%A6%AE%E0%A6%BE%E0%A6%87%E0%A6%B8%E0%A7%87%E0%A6%B2%E0%A6%AB-%E0%A6%9A%E0%A6%BF%E0%A6%95%E0%A6%BF%E0%A7%8E%E0%A6%B8%E0%A6%BE-%E0%A6%B8%E0%A6%BE%E0%A6%B9%E0%A6%BF%E0%A6%A4%E0%A7%8D%E0%A6%AF-%E0%A6%8F%E0%A6%AC%E0%A6%82-%E0%A6%86%E0%A6%A4%E0%A7%8D%E0%A6%AE%E0%A6%B8%E0%A6%AE%E0%A7%80%E0%A6%95%E0%A7%8D%E0%A6%B7%E0%A6%BE%E0%A6%B0-%E0%A6%B8%E0%A6%AE%E0%A7%80%E0%A6%95%E0%A6%B0%E0%A6%A3">
                                        <div class="inner">
                                           <span class="inner-text bd-font">২</span>
                                        </div>
                                     </a>
                                  </div>
                                  <div class="details clearfix">
                                     <h6 class="post-title my-0 bd-font"><a href="https://rupkotha.bn.synexdigital.com/view/%E0%A6%A1%E0%A6%BF%E0%A6%B8%E0%A7%87%E0%A6%A8%E0%A7%8D%E0%A6%9F-%E0%A6%87%E0%A6%A8%E0%A6%9F%E0%A7%81-%E0%A6%AE%E0%A6%BE%E0%A6%87%E0%A6%B8%E0%A7%87%E0%A6%B2%E0%A6%AB-%E0%A6%9A%E0%A6%BF%E0%A6%95%E0%A6%BF%E0%A7%8E%E0%A6%B8%E0%A6%BE-%E0%A6%B8%E0%A6%BE%E0%A6%B9%E0%A6%BF%E0%A6%A4%E0%A7%8D%E0%A6%AF-%E0%A6%8F%E0%A6%AC%E0%A6%82-%E0%A6%86%E0%A6%A4%E0%A7%8D%E0%A6%AE%E0%A6%B8%E0%A6%AE%E0%A7%80%E0%A6%95%E0%A7%8D%E0%A6%B7%E0%A6%BE%E0%A6%B0-%E0%A6%B8%E0%A6%AE%E0%A7%80%E0%A6%95%E0%A6%B0%E0%A6%A3">ডিসেন্ট ইনটু মাইসেলফ – চিকিৎসা, সাহিত্য, এবং আত্মসমীক্ষার সমীকরণ</a>
                                     </h6>
                                     <ul class="meta list-inline mt-1 mb-0">
                                        <li class="list-inline-item">13 Jul 24</li>
                                     </ul>
                                  </div>
                               </div>
                               <!-- post -->
                               <div class="post post-list-sm circle">
                                  <div class="thumb circle">
                                     <a href="https://rupkotha.bn.synexdigital.com/view/%E0%A6%B0%E0%A6%AC%E0%A7%80%E0%A6%A8%E0%A7%8D%E0%A6%A6%E0%A7%8D%E0%A6%B0%E0%A6%A8%E0%A6%BE%E0%A6%A5%E0%A7%87%E0%A6%B0-%E0%A6%95%E0%A6%AC%E0%A6%BF%E0%A6%A4%E0%A6%BE%E0%A6%AF%E0%A6%BC-%E0%A6%93-%E0%A6%97%E0%A6%BE%E0%A6%A8%E0%A7%87-%E0%A6%B0%E0%A6%A5-%E0%A6%AA%E0%A7%8D%E0%A6%B0%E0%A6%B8%E0%A6%99%E0%A7%8D%E0%A6%97">
                                        <div class="inner">
                                           <span class="inner-text bd-font">৩</span>
                                        </div>
                                     </a>
                                  </div>
                                  <div class="details clearfix">
                                     <h6 class="post-title my-0 bd-font"><a href="https://rupkotha.bn.synexdigital.com/view/%E0%A6%B0%E0%A6%AC%E0%A7%80%E0%A6%A8%E0%A7%8D%E0%A6%A6%E0%A7%8D%E0%A6%B0%E0%A6%A8%E0%A6%BE%E0%A6%A5%E0%A7%87%E0%A6%B0-%E0%A6%95%E0%A6%AC%E0%A6%BF%E0%A6%A4%E0%A6%BE%E0%A6%AF%E0%A6%BC-%E0%A6%93-%E0%A6%97%E0%A6%BE%E0%A6%A8%E0%A7%87-%E0%A6%B0%E0%A6%A5-%E0%A6%AA%E0%A7%8D%E0%A6%B0%E0%A6%B8%E0%A6%99%E0%A7%8D%E0%A6%97">রবীন্দ্রনাথের কবিতায় ও গানে রথ-প্রসঙ্গ</a>
                                     </h6>
                                     <ul class="meta list-inline mt-1 mb-0">
                                        <li class="list-inline-item">13 Jul 24</li>
                                     </ul>
                                  </div>
                               </div>
                               <!-- post -->
                               <div class="post post-list-sm circle">
                                  <div class="thumb circle">
                                     <a href="https://rupkotha.bn.synexdigital.com/view/kise-invest-krb">
                                        <div class="inner">
                                           <span class="inner-text bd-font">৪</span>
                                        </div>
                                     </a>
                                  </div>
                                  <div class="details clearfix">
                                     <h6 class="post-title my-0 bd-font"><a href="https://rupkotha.bn.synexdigital.com/view/kise-invest-krb">কিসে ইনভেস্ট করব?</a>
                                     </h6>
                                     <ul class="meta list-inline mt-1 mb-0">
                                        <li class="list-inline-item">07 Jul 24</li>
                                     </ul>
                                  </div>
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
