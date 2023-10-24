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
						<div class="row row-space-30" style="position: relative; bottom: 0px;margin-bottom: 0px;">
							<!-- begin col-9 -->
							<div class="col-lg-9">
								<!-- begin post-list -->
								<ul class="post-list">
									<li>
										<!-- begin post-left-info -->
										<div class="post-left-info">
											<div class="post-date">
												<span class="day">03</span>
												<span class="month">SEPT</span>
											</div>
										</div>
										<!-- end post-left-info -->
										<!-- begin post-content -->
										<div class="post-content">
										<div class="post-image">
												<a href="post_detail.html">
													<div class="post-image-cover" style="background-image: url(../assets/img/berita/berita1.jpg);"></div>
												</a>
											</div>
											<!-- begin post-info -->
											<div class="post-info">
												<h4 class="post-title">
													<a href="post_detail.html">Kunjungan Kementrian Pan-RB</a>
												</h4>
												<div class="post-by">
													Posted By <a href="#">admin</a> <span class="divider">|</span> <a href="#">Sports</a>, <a href="#">Mountain</a>, <a href="#">Bike</a> <span class="divider">|</span> 2 Comments
												</div>
												<div class="post-desc">
													Kunjungan Kementrian PAN-RB dalam rangka memantau kesiapan fasilitas Mal Pelayanan Publik Kabupaten Indramayu. [...]
												</div>
											</div>
											<!-- end post-info -->
											<!-- begin read-btn-container -->
											<div class="read-btn-container">
												<a href="berita_detail">Read More <i class="fa fa-angle-double-right"></i></a>
											</div>
											<!-- end read-btn-container -->
										</div>
										<!-- end post-content -->
									</li>
									
								<!-- end pagination -->
							</div>
							<!-- end col-9 -->
							<!-- begin col-3 -->
							<div class="col-lg-3">
									<!-- BEGIN news -->
									<div class="news">
										<div class="news-media">
											<div class="news-media-img news-media-img-lg" style="background-image: url(../assets/img/berita/berita4.jpeg);"></div>
										</div>
										<div class="news-content">
											<div class="news-title">Pemberian penghargaan sebagai Pembina Olahraga kepada Bupati Indramayu Nina Agustina</div>
											<div class="news-date">September 16, 2020</div>
										</div>
										<a href="#" class="stretched-link"></a>
									</div>
									<!-- END news -->
									<!-- BEGIN news -->
									<div class="news">
										<div class="news-media">
											<div class="news-media-img news-media-img-lg" style="background-image: url(../assets/img/berita/berita3.jpg);"></div>
										</div>
										<div class="news-content">
											<div class="news-title">Pencegahan Pungli</div>
											<div class="news-date">September 16, 2020</div>
										</div>
										<a href="#" class="stretched-link"></a>
									</div>
									<!-- END news -->
								</div>
							<!-- end section-container -->
							</div>
							<!-- end col-3 -->
						</div>    
					</div>
				</div>
			</div>
			
		</div>
	</div>
</section>

@endsection