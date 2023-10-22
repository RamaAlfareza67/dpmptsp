@extends('layout.layout.layout')

@section('content')

    <div id="content" class="content">
		<!-- begin container -->
		<div class="container">
            <!-- begin row -->
			<div class="row row-space-30">
				<!-- begin col-9 -->
				<div class="col-lg-9">
					<!-- begin post-detail -->
					<div class="post-detail section-container">
						
						<h4 class="post-title">
							<a href="post_detail.html">{{$data['berita']->judul}}</a>
						</h4>
						<div class="post-by">
							Posted By <a href="#">{{$data['berita']->penulis}}</a> <span class="divider">|</span> {{$data['berita']->created_date}} <span class="divider">
						</div>
						<!-- begin post-image -->
						<div class="post-image">
							<div class="post-image-cover" style="background-image: url({{asset($data['berita']->image)}})"></div>
						</div>
						<!-- end post-image -->
						<!-- begin post-desc -->
						<div class="post-desc">
							{!!$data['berita']->isi!!}
						</div>
						<!-- end post-desc -->
						
					</div>
					<!-- end post-detail -->
				</div>
				<!-- end col-9 -->
				<!-- begin col-3 -->
				<div class="col-lg-3">
					<!-- begin section-container -->
					<div class="section-container">
						<div class="input-group sidebar-search">
							
						</div>
					</div>
					<!-- begin section-container -->
					<div class="section-container">
						<h4 class="section-title"><span></span></h4>
						 <!-- BEGIN news -->
						 	<?php
								if(count($data['berita_rand']) > 0){
									foreach ($data['berita_rand'] as $val) {
							?>
							<div class="news">
								<div class="news-media">
									<div class="news-media-img news-media-img-lg" style="background-image: url({{asset($val->image)}});"></div>
								</div>
								<div class="news-content">
									<div class="news-title">{{$val->judul}}</div>
									<div class="news-date">{{$val->created_date}}</div>
								</div>
								<a href="/berita/detail/{{Crypt::encrypt($val->id)}}" class="stretched-link"></a>
							</div>
                         	<?php 
									} 
								} else { 
							?>
								<p class="fs-18px mb-5">Kosong</p>
							<?php } ?>
					</div>	
                    <div class="text-center">
                    <a href="/berita" class="btn bg-red  fw-bold rounded-pill" style="color:aliceblue;">Berita Lainnya</a>
                </div>
				</div>
				<!-- end col-3 -->
			</div>
			<!-- end row -->
		</div>
		<!-- end container -->
	</div>
	<!-- end #content -->
    @endsection