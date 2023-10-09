@extends('layout.layout.layout')

@section('content')
<?php 
	$profil = getProfilDinas();
?>
<!-- begin #page-title -->
<div id="page-title" class="page-title has-bg">
		<div class="bg-cover" data-paroller="true" data-paroller-factor="0.5" data-paroller-factor-xs="0.2" style="background: url(../assets/img/cover/cover-8.jpg) center 0px / cover no-repeat"></div>
		<div class="container">
			<h1 style="color:black;">Kontak <a style="color:red;">Kami</a></h1>
			<p>Kabeh Berita Seputar DPMPTSP ana ning kene lurd!</p>
		</div>
	</div>
	<!-- end #page-title -->
    <!-- begin #content -->
	<div id="content" class="content">
		<!-- begin container -->
		<div class="container">
			<!-- begin row -->
			<div class="row row-space-30">
				<!-- begin col-9 -->
				<div class="col-lg-6">
					<!-- begin section-container -->
					<div class="section-container">
						<div class="ratio ratio-16x9">
							<iframe src="https://www.google.com/maps?q={{$profil->lat}},{{$profil->long}}&hl=es;17z%3D14&amp&output=embed" allowfullscreen></iframe>
						</div>
					</div>
					<!-- end section-container -->>
				</div>
				<!-- end col-9 -->
				<!-- begin col-3 -->
				<div class="col-lg-6">
					<!-- begin section-container -->
					<div class="section-container">
						<h4 class="section-title m-b-20"><span>CONTACT US</span></h4>
						<p class="m-b-30">
							If you have a project you would like to discuss, get in touch with us.
							Morbi interdum mollis sapien. Sed ac risus. Phasellus lacinia, magna a ullamcorper laoreet, 
							lectus arcu pulvinar risus, vitae facilisis libero dolor a purus.
						</p>
						<!-- begin row -->
						<div class="row row-space-30">
							<!-- begin col-8 -->
							<div class="col-md-8">
								<form class="form-horizontal">
									<div class="mb-3 row">
										<label class="col-form-label col-md-3 text-md-right">Name <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-3 text-md-right">Email <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<input type="text" class="form-control">
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-3 text-md-right">Message <span class="text-danger">*</span></label>
										<div class="col-md-9">
											<textarea class="form-control" rows="3"></textarea>
										</div>
									</div>
									<div class="mb-3 row">
										<label class="col-form-label col-md-3 text-md-right"></label>
										<div class="col-md-9 text-left">
											<button type="submit" class="btn btn-dark btn-lg btn-block">Send Message</button>
										</div>
									</div>
								</form>
							</div>
							<!-- end col-8 -->
							<!-- begin col-4 -->
							<div class="col-md-4">
								<p>
									<strong>SeanTheme Studio, Inc</strong><br>
									795 Folsom Ave, Suite 600<br>
									San Francisco, CA 94107<br>
									P: (123) 456-7890<br>
								</p>
								<p>
									<span class="phone">+11 (0) 123 456 78</span><br>
									<a href="mailto:hello@emailaddress.com">seanthemes@support.com</a>
								</p>
							</div>
							<!-- end col-4 -->
						</div>
						<!-- end row -->
					</div>
					<!-- end section-container --
				</div>
				<!-- end col-3 -->
			</div>
			<!-- end row -->
		</div>
		<!-- end container -->
	</div>
	<!-- end #content -->

@endsection