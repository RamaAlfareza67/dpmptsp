@extends('layout.layout.layout')

@section('content')

<!-- begin #page-title -->

<!-- BEGIN section -->
<div class="section section-hero">
    <!-- BEGIN section-bg -->
    <div class="section-bg with-cover" style="background-image: url(../assets/img/tes.jpg);"></div>
    <div class="section-bg bg-black-800 bg-opacity-70"></div>
    <!-- END section-bg -->
    
    <!-- BEGIN container -->
    <div class="container position-relative">
        <!-- BEGIN section-hero-content -->
        <div class="section-hero-content">
            <!-- BEGIN row -->
            <div class="row">
                <!-- BEGIN col-8 -->
                <div class="col-lg-8 col-lg-10">
                    <!-- BEGIN hero-title-desc -->
                    <h1 class="hero-title mb-3 mt-5 pt-md-5">
                        SELAMAT DATANG DI WEBSITE DPMPTSP
                    </h1>
                    <div class="fs-18px text-white text-opacity-80 mb-5">
                        KABUPATEN INDRAMAYU
                    </div>
                    <!-- END hero-title-desc -->
                    
                    
                    
                    <a href="#" class="hero-btn fw-bold mb-n5"><i class="fa fa-arrow-right"></i> Learn About Our Company</a>
                </div>
                <!-- END col-8 -->
            </div>
            <!-- END row -->
        </div>
        <!-- END section-hero-content -->
    </div>
    <!-- END container -->
</div>
<!-- END section -->

<!-- BEGIN section -->
<div class="section">
    <!-- BEGIN container -->
    <div class="container">
        <!-- BEGIN section-title -->
        <div class="pt-lg-5 pb-lg-3 text-center">
            <div class="display-6 fw-bolder mb-3 d-flex align-items-center justify-content-center">
                Berita & Event Terbaru
            </div>
            <p class="fs-18px mb-5">Update Seputar Aktivitas, Acara dan Info lainnya</p>
            
            <!-- BEGIN row -->
            <div class="row">
                <!-- BEGIN col-3 -->
                <?php
                    if(count($data['berita']) > 0){
                        foreach ($data['berita'] as $val) {
                ?>
                <div class="col-lg-3">
                    <!-- BEGIN news -->
                    <div class="news">
                        <div class="news-media">
                            <div class="news-media-img news-media-img-lg" style="background-image: url({{$val->image}});"></div>
                        </div>
                        <div class="news-content">
                            <div class="news-title">{{$val->judul}}</div>
                            <div class="news-date">{{$val->created_date}}</div>
                        </div>
                        <a href="#" class="stretched-link"></a>
                    </div>
                    <!-- END news -->
                </div>
                <div class="text-center">
                    <a href="/berita" class="section-btn">Berita Lainnya <i class="fa fa-arrow-right mb-5"></i></a>
                </div>
                <?php 
                        } 
                    } else { 
                ?>
                    <p class="fs-18px mb-5">Kosong</p>
                <?php } ?>
            </div>
            
        <!-- END row -->
        </div>
        <!-- END section-title -->
    </div>
    <!-- END container -->
</div>
<!-- END section -->
    <!-- BEGIN container -->
    <div class="container">
        <!-- BEGIN section-title -->
        <div class="pt-lg-5 pb-lg-3 text-center">
            <div class="display-6 fw-bolder mb-3 d-flex align-items-center justify-content-center">
                Informasi Publik
            </div>
            <p class="fs-18px mb-5"></p> 
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-4 -->
            <div class="col-lg-3">
                <!-- BEGIN card -->
                <div class="card shadow border-0 mb-5" style="background-image: url(../assets/img/tes.jpg);">
                    <div class="card-body p-4">
                        <div class="work">
							<div class="image">
								<a href="#"><img src="../assets/img/work/work-img-1.jpg" alt="Work 1" /></a>
							</div>
							<div class="desc">
								<span class="desc-title">S.O.P</span>
								<span class="desc-text">Lorem ipsum dolor sit amet</span>
							</div>
						</div>
				    </div>
                </div>
                <!-- END card -->
            </div>
            <!-- END col-4 -->
            <!-- BEGIN col-4 -->
            <div class="col-lg-3">
                <!-- BEGIN card -->
                <div class="card shadow border-0 mb-5">
                    <div class="card-body p-4">
                        <div class="work">
							<div class="image">
								<a href="#"><img src="../assets/img/work/work-img-1.jpg" alt="Work 1" /></a>
							</div>
							<div class="desc">
								<span class="desc-title">S.O.P OSS</span>
								<span class="desc-text">Lorem ipsum dolor sit amet</span>
							</div>
						</div>
				    </div>
                </div>
                <!-- END card -->
            </div>
            <!-- END col-4 -->
            <!-- BEGIN col-4 -->
            <div class="col-lg-3">
                <!-- BEGIN card -->
                <div class="card shadow border-0 mb-5">
                    <div class="card-body p-4">
                        <div class="work">
							<div class="image">
								<a href="#"><img src="../assets/img/work/work-img-1.jpg" alt="Work 1" /></a>
							</div>
							<div class="desc">
								<span class="desc-title">STANDAR PELAYANAN</span>
								<span class="desc-text">Lorem ipsum dolor sit amet</span>
							</div>
						</div>
				    </div>
                </div>
                <!-- END card -->
            </div>
            <!-- END col-4 -->
             <!-- BEGIN col-4 -->
             <div class="col-lg-3">
                <!-- BEGIN card -->
                <div class="card shadow border-0 mb-5">
                    <div class="card-body p-4">
                        <div class="work">
							<div class="image">
								<a href="#"><img src="../assets/img/work/work-img-1.jpg" alt="Work 1" /></a>
							</div>
							<div class="desc">
								<span class="desc-title">STANDAR PELAYANAN OSS</span>
								<span class="desc-text">Lorem ipsum dolor sit amet</span>
							</div>
						</div>
				    </div>
                </div>
                <!-- END card -->
            </div>
            <!-- END col-4 -->
            <!-- BEGIN col-4 -->
            <div class="col-lg-3">
                <!-- BEGIN card -->
                <div class="card shadow border-0 mb-5">
                    <div class="card-body p-4">
                        <div class="work">
							<div class="image">
								<a href="#"><img src="../assets/img/work/work-img-1.jpg" alt="Work 1" /></a>
							</div>
							<div class="desc">
								<span class="desc-title">STANDAR PELAYANAN OSS</span>
								<span class="desc-text">Lorem ipsum dolor sit amet</span>
							</div>
						</div>
				    </div>
                </div>
                <!-- END card -->
            </div>
            <!-- END col-4 -->
            <!-- BEGIN col-4 -->
            <div class="col-lg-3">
                <!-- BEGIN card -->
                <div class="card shadow border-0 mb-5">
                    <div class="card-body p-4">
                        <div class="work">
							<div class="image">
								<a href="#"><img src="../assets/img/work/work-img-1.jpg" alt="Work 1" /></a>
							</div>
							<div class="desc">
								<span class="desc-title">STANDAR PELAYANAN OSS</span>
								<span class="desc-text">Lorem ipsum dolor sit amet</span>
							</div>
						</div>
				    </div>
                </div>
                <!-- END card -->
            </div>
            <!-- END col-4 -->
            <!-- BEGIN col-4 -->
            <div class="col-lg-3">
                <!-- BEGIN card -->
                <div class="card shadow border-0 mb-5">
                    <div class="card-body p-4">
                        <div class="work">
							<div class="image">
								<a href="#"><img src="../assets/img/work/work-img-1.jpg" alt="Work 1" /></a>
							</div>
							<div class="desc">
								<span class="desc-title">STANDAR PELAYANAN OSS</span>
								<span class="desc-text">Lorem ipsum dolor sit amet</span>
							</div>
						</div>
				    </div>
                </div>
                <!-- END card -->
            </div>
            <!-- END col-4 -->
            <!-- BEGIN col-4 -->
            <div class="col-lg-3">
                <!-- BEGIN card -->
                <div class="card shadow border-0 mb-5">
                    <div class="card-body p-4">
                        <div class="work">
							<div class="image">
								<a href="#"><img src="../assets/img/work/work-img-1.jpg" alt="Work 1" /></a>
							</div>
							<div class="desc">
								<span class="desc-title">STANDAR PELAYANAN OSS</span>
								<span class="desc-text">Lorem ipsum dolor sit amet</span>
							</div>
						</div>
				    </div>
                </div>
                <!-- END card -->
            </div>
            <!-- END col-4 -->
        </div>
    </div>
    <!-- END container -->
</div>
<section> 
  <div class='air air1'></div>
  <div class='air air2'></div>
  <div class='air air3'></div>
  <div class='air air4'></div>
</section>
<!-- END section -->
@endsection
	
	
	
