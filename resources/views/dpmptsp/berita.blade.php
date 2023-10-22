@extends('layout.layout.layout')

@section('content')

<!-- begin #page-title -->
<div id="page-title" class="page-title has-bg">
		<div class="bg-cover" data-paroller="true" data-paroller-factor="0.5" data-paroller-factor-xs="0.2" style="background: url(../assets/img/cover/cover-8.jpg) center 0px / cover no-repeat"></div>
		<div class="container">
			<h1 style="color:black;">Berita <a style="color:red;">Terkini</a></h1>
			<p>Kabeh Berita Seputar DPMPTSP ana ning kene lurd!</p>
		</div>
	</div>
	<!-- end #page-title -->
	
	<div id="content" class="content">
		<!-- begin container -->
		<div class="container">
			<!-- begin row -->
			<div class="row row-space-30">
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
								<div class="post-likes">
									<i class="fa fa-heart text-theme"></i>
									<span class="number">520</span>
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
                                    <div class="news-label"><span class="bg-primary-200 text-theme-800">Facebook</span></div>
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
                                    <div class="news-label"><span class="bg-primary-200 text-theme-800">Facebook</span></div>
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
			<!-- end row -->
		</div>
		<!-- end container -->
	</div>
	<!-- end #content -->

@endsection