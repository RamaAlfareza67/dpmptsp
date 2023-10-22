
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>DPMPTSP</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" type="image/x-icon" href="../assets/img/logo.png"/>
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="{{ asset('assets/css/blog/vendor.min.css')}}" rel="stylesheet" />
	<link href="{{ asset('assets/css/blog/app.min.css')}}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/plugins/sweetalert/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
	<!-- <link href="../assets/css/corporate/app.min.css" rel="stylesheet" /> -->
	<!-- ================== END core-css ================== -->
	
</head>
<body>
	<?php 
		$profil = getProfilDinas();
	?>
	
            @include('layout.layout.navbar')
            
            @yield('content')
    

	
	
	<!-- begin #footer-copyright -->
	<div id="footer-copyright" class="footer-copyright">
		<!-- begin container -->
		<div class="container d-sm-flex">
			<span class="copyright d-block">&copy; 2023 Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Kab.Indramayu</span>
			<ul class="social-media-list mt-2 mt-sm-0 flex-1">
				<li><a href="{{$profil->facebook}}"><i class="fab fa-facebook"></i></a></li>
				<li><a href="{{$profil->ig}}"><i class="fab fa-instagram"></i></a></li>
				<li><a href="{{$profil->twitter}}"><i class="fab fa-twitter"></i></a></li>
				<li><a href="{{$profil->yt}}"><i class="fa fa-youtube"></i></a></li>
			</ul>
		</div>
        <a href="https://api.whatsapp.com/send?phone=628112228300&amp;text=Selamat%20Datang%20Dilayanan%20Pengaduan%20DPMPTSP" class="floating" target="_blank">
<i class="fab fa-whatsapp fab-icon"></i>
</a>
		<!-- end container -->
	</div>
	<!-- end #footer-copyright -->
	
	
<!-- ================== BEGIN core-js ================== -->
	<script src="{{ asset('assets/js/blog/vendor.min.js')}}"></script>
	<script src="{{ asset('assets/js/blog/app.min.js')}}"></script>
	<!-- <script src="{{ asset('assets/js/blog/bootstrap.bundle.min.js')}}"></script> -->
	<script src="{{ asset('assets/js/blog/jquery.sticky.js')}}"></script>
	<script src="{{ asset('assets/js/blog/click-scroll.js')}}"></script>
	<script src="{{ asset('assets/js/blog/custom.js')}}"></script>
	<script src="{{ asset('assets_admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/sweetalert/sweetalert2.min.js') }}"></script>
	<!-- ================== END core-js ================== -->
	@yield('js')
</body>
</html>