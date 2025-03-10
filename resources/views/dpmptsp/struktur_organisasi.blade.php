@extends('layout.layout.layout')
@section('content')


<section class="hero-section d-flex justify-content-center align-items-center bg-[length:auto_100% bg-cover bg-no-repeat bg-bottom h-[700px] lg:h-[70vh] visible" id="section_1"  style="background: url(../assets/img/layanan.jpg) center 0px / cover no-repeat; background-position: top;
    background-repeat: no-repeat;">
	<div class="container mb-5">
		<h1 class="text-white text-center"><b style="text-shadow: 0px 2px 7px black;">STRUKTUR ORGANISASI DPMPTSP</b></h1>
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
                        <div class="row row-space-30" style="position: relative; bottom: 0px;margin-bottom: 30px;">
                            <img src="{{asset($data['st_organisasi']->image)}}" alt="">
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</section>


@endsection

