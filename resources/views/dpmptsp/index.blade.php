@extends('layout.layout.layout')

@section('content')

<!-- begin #page-title -->
<!-- ***** Main Banner Area Start ***** -->
<div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="../assets/video/dpmptsp.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
                <h6>Selamat Datang di Website</h6>
                <h2>DPM<em>PTSP</em></h2>
                <h6>KABUPATEN INDRAMAYU</h6>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->
<!-- BEGIN section -->

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
                    <a href="/berita" class="btn bg-red  fw-bold rounded-pill" style="color:aliceblue;">Berita Lainnya</a>
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

<section class="section-padding section-bg">
    <div class="container">
        <div class="row">


            <div class="col-lg-6 col-md-6 col-12 mt-3 mb-4 mb-lg-0">
                <div class="custom-block bg-white shadow-lg">
                    <a href="topics-detail.html">
                        <div class="custom-block-overlay-text d-flex">
                            <div>
                                <h1>Informasi Layanan Pengaduan</h1>
                                    <br>
                                    <div class="header-btn">
                                    <a href="topics-detail.html" class="btn custom-btn mt-2 mt-lg-3">LAYANAN PENGADUAN</a>
                                    </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-12 mt-lg-3">
                <div class="custom-block custom-block-overlay">
                <a href="topics-detail.html">
                    <div class="d-flex flex-column h-100">
                        <img src="../assets/img/tes.jpg" class="custom-block-image img-fluid" alt="">

                        <div class="custom-block-overlay-text d-flex">
                            <div>
                            <h1>Sudahkah Anda Mengurus Izin?</h1>
                            <br>
                    <div class="header-btn">
                    <a href="topics-detail.html" class="btn custom-btn mt-2 mt-lg-3">INFORMASI LAYANAN</a>
                    </div>
                            </div>

                           
                        </div>
                        <div class="section-overlay"></div>
                    </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>


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
            <?php
                if(count($data['informasi_publik']) > 0){
                    foreach ($data['informasi_publik'] as $val) {
            ?>
            <div class="col-lg-3">
                <!-- BEGIN card -->
                <div class="card shadow border-0 mb-5">
                    <div class="card-body p-4">
                        <div class="work">
							<div class="image">
								<a href="{{asset($val->file)}}" target="_blank"><img src="{{asset($val->cover)}}" alt="Work 1" /></a>
							</div>
							<div class="desc">
								<span class="desc-title">{{$val->nama}}</span>
								<span class="desc-text">{{$val->deskripsi}}</span>
							</div>
						</div>
				    </div>
                </div>
                <!-- END card -->
            </div>
            <?php 
                    } 
                } else { 
            ?>
                <p class="fs-18px mb-5">Kosong</p>
            <?php } ?>
            <!-- END col-4 -->
            
        </div>
    </div>
    <!-- END container -->
    <section> 
  <div class='air air1'></div>
  <div class='air air2'></div>
  <div class='air air3'></div>
  <div class='air air4'></div>
</section>
</div>
    
    <div class="section" style="background: url(../assets/img/tes.jpg)center 0px / cover no-repeat">
    <div class="section-overlay"></div>
        <section class="timeline-section section-padding" id="section_3" >
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="text-white mb-4"> Mengurus izin kini jauh lebih nyaman, cepat, mudah</h1>
                        <p style="color:white;">5 Alasan pentingnya kita memiliki izin usaha,berikut penjelasannya :</p> <br>
                    </div>
                    <div class="col-lg-10 col-12 mx-auto">
                        <div class="timeline-container">
                            <ul class="vertical-scrollable-timeline" id="vertical-scrollable-timeline">
                                <div class="list-progress">
                                    <div class="inner"></div>
                                </div>
                                <li>
                                    <h4 class="text-white mb-3">Taat Hukum</h4>
                                    <p class="text-white">Usaha Yang Memiliki Izin Mendapat Jaminan Hukum dan Perlindungan dari Pemerintah Apabila Terjadi Hal Yang Tidak Diinginkan</p>
                                    <div class="icon-holder">
                                        <i>1</i>
                                    </div>
                                </li>     
                                <li>
                                    <h4 class="text-white mb-3">Usaha Berkembang</h4>
                                    <p class="text-white">Usaha Yang Memiliki Izin Lengkap & Sah Akan Mendapat Kemudahan Dalam Hal Pembiayaan Untuk Perkembangan Usaha</p>
                                    <div class="icon-holder">
                                        <i>2</i>
                                    </div>
                                </li>
                                <li>
                                    <h4 class="text-white mb-3">Ikut Serta Dalam Tender</h4>
                                    <p class="text-white">Usaha Yang Memiliki Izin Akan Lebih Mudah Ikut Serta Dalam Tender</p>
                                    <div class="icon-holder">
                                        <i>3</i>
                                    </div>
                                </li>
                                <li>
                                    <h4 class="text-white mb-3">Memperluas Usaha</h4>
                                    <p class="text-white">Usaha Lokal Yang Memilki Izin, Memiliki Kesempatan Untuk Memperluas Usahanya Ke Tingkat Internasional</p>
                                    <div class="icon-holder">
                                        <i>4</i>
                                    </div>
                                </li>
                                <li>
                                    <h4 class="text-white mb-3">Promosi Usaha</h4>
                                    <p class="text-white">Dengan Memiliki Izin Usaha, Maka Kredibilitas Usaha Anda Baik dan Semakin Mudah Untuk Mengikuti Promosi Melalui Pameran Yang Diselenggarakan Pemerintah</p>
                                    <div class="icon-holder">
                                        <i>5</i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<!-- END section -->
<!-- BEGIN section -->
   
		
    

@endsection
	
	
	
