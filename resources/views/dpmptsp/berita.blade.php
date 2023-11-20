@extends('layout.layout.layout')

@section('content')

<section class="hero-section d-flex justify-content-center align-items-center bg-[length:auto_100% bg-cover bg-no-repeat bg-bottom h-[700px] lg:h-[70vh] visible" id="section_1"  style="background: url(../assets/img/berita.jpg) center 0px / cover no-repeat; background-position: top;
    background-repeat: no-repeat;">
	<div class="container mb-5">
		<h1 class="text-white text-center"><b style="text-shadow: 0px 2px 7px black;">BERITA TERKINI DPMPTSP</b></h1>
		<!-- <h6 class="text-white text-center"><b style="text-shadow: 0px 2px 7px black;">Mari Bersama-sama Menciptakan Pemerintahan Yang Jujur dan Bersih, Laporkan Setiap Pelanggaran Yang Terjadi Di Lingkungan Kerja</b></h6> -->
	</div>
</section>

<section class="featured-section" >
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 mb-lg-0">
                            
            </div>
            <div class="col-lg-12 mb-lg-2">
            	<div class="custom-block bg-white shadow-lg">      
					<div class="d-flek"> 
					<div class="row row-space-30" style="position: relative; bottom: 0px;margin-bottom: 30px;">
						<!-- begin col-9 -->
							<?php
							if(count($data['berita']) > 0){
								foreach ($data['berita'] as $val) {
							?>
							<div class="col-lg-4 col-md-6 col-sm-12" style="position: relative; bottom: 0px;margin-bottom: 30px;">
								<article  class="kartu kartu--1">
									<div class="kartu__info-hover">
										</svg>
										<div class="kartu__clock-info">
											<svg class="kartu__clock"  viewBox="0 0 24 24"><path d="M12,20A7,7 0 0,1 5,13A7,7 0 0,1 12,6A7,7 0 0,1 19,13A7,7 0 0,1 12,20M19.03,7.39L20.45,5.97C20,5.46 19.55,5 19.04,4.56L17.62,6C16.07,4.74 14.12,4 12,4A9,9 0 0,0 3,13A9,9 0 0,0 12,22C17,22 21,17.97 21,13C21,10.88 20.26,8.93 19.03,7.39M11,14H13V8H11M15,1H9V3H15V1Z" />
											</svg><span class="kartu__time">{{$val->created_date}}</span>
										</div>
									</div>
									<div class="kartu__img"></div>
										<a href="/berita/detail/{{Crypt::encrypt($val->id)}}" class="kartu_link">
											<div class="kartu__img--hover" style="background-image: url({{$val->image}});"></div>
										</a>
									<div class="kartu__info">
										<h3 class="kartu__title">{{$val->judul}}</h3>
										<span class="kartu__by">by <a href="#" class="kartu__author" title="author">{{$val->penulis}}</a></span>
									</div>
								</article>
							</div>    
							<?php 
								} 
							} else { 
								?>
							<p class="fs-18px mb-5">Kosong</p>
							<?php } ?>
						</div>    
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection