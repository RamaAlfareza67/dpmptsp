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
							<a href="post_detail.html">Bootstrap Carousel Blog Post</a>
						</h4>
						<div class="post-by">
							Posted By <a href="#">admin</a> <span class="divider">|</span> 10 June 2021 <span class="divider">
						</div>
						<!-- begin post-image -->
						<div class="post-image">
							<div class="post-image-cover" style="background-image: url(../assets/img/post/post-1.jpg)"></div>
						</div>
						<!-- end post-image -->
						<!-- begin post-desc -->
						<div class="post-desc">
							<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed commodo eget quam sed tempor. 
								Morbi vel libero eget urna interdum accumsan nec non nibh. Nam aliquam id ligula convallis egestas. 
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum lacinia lectus nibh, nec 
								pellentesque lorem iaculis ut. Cras finibus arcu eget feugiat hendrerit. Suspendisse quis 
								molestie velit. In hendrerit justo ac magna tristique viverra. Pellentesque rhoncus metus 
								eget ex sagittis lacinia. In at dapibus erat. Phasellus imperdiet dui risus, eget efficitur 
								tortor egestas nec. Integer fermentum sit amet mauris sollicitudin pulvinar.
								Quisque et viverra leo. Suspendisse neque nisi, lacinia facilisis sem ac, tincidunt lacinia augue. 
								Etiam in dapibus nisl, non blandit urna. Proin scelerisque venenatis vestibulum. 
								Proin iaculis finibus turpis, eget rhoncus tortor tempor a.
							</p>
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