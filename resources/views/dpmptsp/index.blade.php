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
</div>
<section> 
  <div class='air air1'></div>
  <div class='air air2'></div>
  <div class='air air3'></div>
  <div class='air air4'></div>
</section>
<!-- END section -->
<!-- BEGIN section -->
<div class="section bg-light">
			<!-- BEGIN container -->
			<div class="container position-relative">
				<!-- BEGIN row -->
				<div class="row gx-5 align-items-center">
					<!-- BEGIN col-6 -->
					<div class="col-lg-6">
						<h1 style="color: aliceblue;">Informasi Layanan Pengaduan</h1>
						<br>
                        <div class="header-btn">
					        <a href="#" class="btn bg-black  fw-bold rounded-pill" style="color:aliceblue;">LAYANAN PENGADUAN</a>
				        </div>
					</div>
					<!-- END col-6 -->
					<!-- BEGIN col-6 -->
					<div class="col-lg-6" >
                    <h1 style="color: aliceblue;">Sudahkah Anda Mengurus Izin?</h1>
						<br>
                        <div class="header-btn">
					        <a href="#" class="btn bg-red fw-bold rounded-pill" style="color:aliceblue;">INFORMASI LAYANAN</a>
				        </div>
					</div>
					<!-- END col-6 -->
				</div>
				<!-- END row -->
			</div>
			<!-- END container -->
		</div>

		<!-- END section -->
	<div class="section">
        <div class="text-center">
            <div class="display-6 fw-bolder mb-3 d-flex align-items-center justify-content-center">
            Mengurus izin kini jauh lebih nyaman, cepat, mudah
            </div>
            <p class="fs-18px mb-5">5 Alasan pentingnya kita memiliki izin usaha,berikut penjelasannya :</p> 
		  <div class="container">
		    <div class="p-6 position-relative border-start border-5 border-danger mb-2" style="background-color: #ffc0cb;">
		      <div class="fs-16px mb-3 fw-bolder line-h-11"> Usaha Yang Memiliki Izin Mendapat Jaminan Hukum dan Perlindungan dari Pemerintah Apabila Terjadi Hal Yang Tidak Diinginkan</div>
		    </div>
		    <div class="p-6 position-relative border-end border-5 border-danger mb-2">
		      <div class="fs-16px mb-3 fw-bolder line-h-11">Usaha Yang Memiliki Izin Lengkap & Sah Akan Mendapat Kemudahan Dalam Hal Pembiayaan Untuk Perkembangan Usaha </div>
		    </div>
		    <div class="p-6 position-relative border-start border-5 border-danger mb-2" style="background-color: #ffc0cb;">
		      <div class="fs-16px mb-3 fw-bolder line-h-11">Usaha Yang Memiliki Izin Akan Lebih Mudah Ikut Serta Dalam Tender</div>
		    </div>
		    <div class="p-6 position-relative border-end border-5 border-danger mb-2">
		      <div class="fs-16px mb-3 fw-bolder line-h-11">Usaha Lokal Yang Memilki Izin, Memiliki Kesempatan Untuk Memperluas Usahanya Ke Tingkat Internasional</div>
		    </div>
		    <div class="p-6 position-relative border-start border-5 border-danger mb-2" style="background-color: #ffc0cb;">
		      <div class="fs-16px mb-3 fw-bolder line-h-11">Dengan Memiliki Izin Usaha, Maka Kredibilitas Usaha Anda Baik dan Semakin Mudah Untuk Mengikuti Promosi Melalui Pameran Yang Diselenggarakan Pemerintah</div>
		    </div>
		  </div>
		</div>
	</div>

@endsection
	
	
	
