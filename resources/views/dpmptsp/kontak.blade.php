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
                                              <!-- begin row -->
			<div class="row row-space-30" style="position: relative; bottom: 0px;margin-bottom: 0px;">
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
						Jl. RA Kartini No.1, Margadadi, Kec. Indramayu, Kabupaten Indramayu, Jawa Barat 45211, Indonesia
						</p>

					</div>
					<!-- end section-container --
				</div>
				<!-- end col-3 -->
			</div>
			<!-- end row -->   
                                    </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>
	<!-- end #page-title -->


@endsection