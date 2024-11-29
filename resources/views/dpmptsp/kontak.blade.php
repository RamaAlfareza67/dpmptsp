@extends('layout.layout.layout')

@section('content')
<?php 
	$profil = getProfilDinas();
?>
<!-- begin #page-title -->
<section class="hero-section d-flex justify-content-center align-items-center bg-[length:auto_100% bg-cover bg-no-repeat bg-bottom h-[700px] lg:h-[70vh] visible" id="section_1"  style="background: url(../assets/img/kontak.jpg) center 0px / cover no-repeat; background-position: top;
    background-repeat: no-repeat;">
	<div class="container mb-5">
		<h1 class="text-white text-center"><b style="text-shadow: 0px 2px 7px black;">KONTAK KAMI</b></h1>
		<h6 class="text-white text-center"><b style="text-shadow: 0px 2px 7px black;">Mari Bersama-sama Menciptakan Pemerintahan Yang Jujur dan Bersih, Laporkan Setiap Pelanggaran Yang Terjadi Di Lingkungan Kerja</b></h6>
	</div>
</section>


<section class="featured-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-12 mb-lg-0">
				
			</div>
			<div class="col-lg-12 mb-lg-2">
				<div class="custom-block bg-white shadow-lg">      
					<div class="d-flek"> 
						<div class="row row-space-30" style="position: relative; bottom: 0px;margin-bottom: 0px;">
							<!-- begin col-9 -->
							<div class="col-lg-6">
								<!-- begin section-container -->
								<div class="section-container">
									<div class="ratio ratio-16x9">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63445.18254076497!2d108.24963314863285!3d-6.352095400000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6eb9fb02f14699%3A0x781fea9bad873574!2sMal%20Pelayanan%20Publik%20(MPP)%20Kabupaten%20Indramayu!5e0!3m2!1sen!2sid!4v1728357205999!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
									</div>
								</div>
								<!-- end section-container -->
							</div>
							<!-- end col-9 -->
							<!-- begin col-3 -->
							<div class="col-lg-6">
								<!-- begin section-container -->
								<div class="section-container">
									<h4 class="section-title m-b-20"><span>CONTACT US</span></h4>
									<p class="m-b-30">
									{{$profil->alamat}}
									</p>
									<p class="m-b-30">
										No Hp :
									{{$profil->no_hp}}
									</p>
									<p class="m-b-30">
										No FAX :
									{{$profil->fax}}
									</p>
									<h4 class="section-title"><span>Follow Us</span></h4>
						<ul class="sidebar-social-list">
							<li><a href="{{$profil->facebook}}"><i class="fab fa-facebook"></i></a></li>
							<li><a href="{{$profil->twitter}}"><i class="fab fa-twitter"></i></a></li>
							<li><a href="{{$profil->email}}"><i class="fab fa-google-plus"></i></a></li>
							<li><a href="{{$profil->ig}}"><i class="fab fa-instagram"></i></a></li>
						</ul>
								</div>
							</div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</section>


@endsection