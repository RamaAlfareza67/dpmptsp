@extends('layout.layout.layout')

@section('content')

<!-- begin #page-title -->
<div id="page-title" class="page-title has-bg">
    <div class="bg-cover" data-paroller="true" data-paroller-factor="0.5" data-paroller-factor-xs="0.2" style="background: url(../assets/img/cover/cover-8.jpg) center 0px / cover no-repeat"></div>
    <div class="container">
        <h1 style="color:black;">Layanan <a style="color:red;">Dinas</a></h1>
        <p>Layanan yang disediakan DPMPTSP</p>
    </div>
</div>
<!-- end #page-title -->
<div class="context">
    <div class="container mt-4">  
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-4 -->
            <div class="display-6 fw-bolder mb-3 d-flex align-items-center justify-content-center">           
            </div>
            <p class="fs-18px mb-5"></p>
            <?php
                if(count($data['layanan']) > 0){
                    foreach ($data['layanan'] as $val) {
            ?>
            <div class="col-lg-4">
                <!-- BEGIN card -->
                <div class="card shadow border-0 mb-5" >
                    <div class="card-body p-6">
                        <div class="mb-3 w-50px h-50px rounded-3 bg-indigo text-white d-flex align-items-center justify-content-center position-relative">
                            <img src="{{asset($val->image)}}" alt="{{$val->nama}}" width="10%">
                        </div>
                        <h2>{{$val->nama}}</h2>
                        <p class="fw-bold text-gray-600 mb-0">
                        {{$val->deskripsi}}
                        </p>
                        <a href="{{$val->link}}" class="stretched-link" target="_blank"></a>
                    </div>
                </div>
                <!-- END card -->
            </div>
            <?php 
                    } 
                } else { 
            ?>
            <div class="col-lg-12">
                <!-- BEGIN card -->
                <div class="card shadow border-0 mb-5" >
                    <div class="card-body p-6">
                        <p class="fw-bold text-gray-600 mb-0 text-center">
                        Kosong
                        </p>
                    </div>
                </div>
                <!-- END card -->
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="area" >
    <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
    </ul>
</div >
@endsection