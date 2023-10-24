@extends('layout.layout.layout')

@section('content')

<!-- begin #page-title -->
<section class="hero-section d-flex justify-content-center align-items-center bg-[length:auto_100% bg-cover bg-no-repeat bg-bottom h-[700px] lg:h-[70vh] visible" id="section_1"  style="background: url(../assets/img/layanan.jpg) center 0px / cover no-repeat; background-position: top;
    background-repeat: no-repeat;">
                <div class="container mb-5">
                    <h1 class="text-white text-center"><b style="text-shadow: 0px 2px 7px black;">LAYANAN DINAS DPMPTSP</b></h1>
                    <h6 class="text-white text-center"><b style="text-shadow: 0px 2px 7px black;">Mari Bersama-sama Menciptakan Pemerintahan Yang Jujur dan Bersih, Laporkan Setiap Pelanggaran Yang Terjadi Di Lingkungan Kerja</b></h6>
                </div>
            </section>
<!-- end #page-title -->
<section class="featured-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 mb-lg-2">
                <div class="custom-block bg-white shadow-lg">      
                    <div class="d-flek"> 
                        <?php
                            if(count($data['layanan']) > 0){
                                foreach ($data['layanan'] as $val) {
                        ?>
                         <div class="col-lg-4">
                            <!-- BEGIN card -->
                            <div class="card shadow border-0 mb-2" >
                                <div class="card-body p-6">
                                    <div class="mb-3 w-50px h-50px rounded-3  text-white d-flex align-items-center justify-content-center position-relative">
                                        <img src="{{asset($val->image)}}" alt="{{$val->nama}}" width="100%">
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
                        <div class="card shadow border-0 mb-2" >
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
    </div>
</section>

@endsection