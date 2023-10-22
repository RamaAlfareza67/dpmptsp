
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>DPMPTSP</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="../assets/css/blog/vendor.min.css" rel="stylesheet" />
	<link href="../assets/css/blog/app.min.css" rel="stylesheet" />
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
	<!-- begin theme-panel -->
	<div class="theme-panel">
		<a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
		<div class="theme-panel-content">
			<ul class="theme-list clearfix">
				<li><a href="javascript:;" class="bg-red" data-theme="theme-red" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Red" data-original-title="" title="">&nbsp;</a></li>
				<li><a href="javascript:;" class="bg-pink" data-theme="theme-pink" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Pink" data-original-title="" title="">&nbsp;</a></li>
				<li><a href="javascript:;" class="bg-orange" data-theme="theme-orange" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Orange" data-original-title="" title="">&nbsp;</a></li>
				<li><a href="javascript:;" class="bg-yellow" data-theme="theme-yellow" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Yellow" data-original-title="" title="">&nbsp;</a></li>
				<li><a href="javascript:;" class="bg-lime" data-theme="theme-lime" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Lime" data-original-title="" title="">&nbsp;</a></li>
				<li><a href="javascript:;" class="bg-green" data-theme="theme-green" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Green" data-original-title="" title="">&nbsp;</a></li>
				<li class="active"><a href="javascript:;" class="bg-teal" data-theme="" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Default" data-original-title="" title="">&nbsp;</a></li>
				<li><a href="javascript:;" class="bg-cyan" data-theme="theme-cyan" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Aqua" data-original-title="" title="">&nbsp;</a></li>
				<li><a href="javascript:;" class="bg-blue" data-theme="theme-blue" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Blue" data-original-title="" title="">&nbsp;</a></li>
				<li><a href="javascript:;" class="bg-purple" data-theme="theme-purple" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Purple" data-original-title="" title="">&nbsp;</a></li>
				<li><a href="javascript:;" class="bg-indigo" data-theme="theme-indigo" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Indigo" data-original-title="" title="">&nbsp;</a></li>
				<li><a href="javascript:;" class="bg-black" data-theme="theme-black" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Black" data-original-title="" title="">&nbsp;</a></li>
			</ul>
			<hr class="mb-0" />
			<div class="row mt-10px pt-3px">
				<div class="col-9 control-label text-dark fw-bold">
					<div>Dark Mode <span class="badge bg-primary ms-1 position-relative py-4px px-6px" style="top: -1px">NEW</span></div>
					<div class="lh-14 fs-13px">
						<small class="text-dark opacity-50">
							Adjust the appearance to reduce glare and give your eyes a break.
						</small>
					</div>
				</div>
				<div class="col-3 d-flex">
					<div class="form-check form-switch ms-auto mb-0 mt-2px">
						<input type="checkbox" class="form-check-input" name="app-theme-dark-mode" id="appThemeDarkMode" value="1" />
						<label class="form-check-label" for="appThemeDarkMode">&nbsp;</label>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end theme-panel -->
	
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