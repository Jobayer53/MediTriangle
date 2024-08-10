@extends('frontend.config.app')
@section('style')
<style>
    .contact_page{
    top: 100px;
}
@media (max-width: 576px) {
    .contact_page{
        top: -86px;
    }
}
.turquoise{
    color: #3cbdb2;
}
.icon_color{
    color: #1475a5;
}
</style>

@endsection

@section('content')
<div class="contianer-fluid " style="height:60vh; ">
    <div class="container" >
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <h2
                    style="position:absolute; top: 37%; left:19%;"
                    ><span> <i class="fa-solid fa-triangle-exclamation icon_color me-2"></i></span>404  </h2>

                    <p class="text-center" style="position:absolute; top: 44%; left:19%;font-size: 25px;">Page Not Found</p>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
