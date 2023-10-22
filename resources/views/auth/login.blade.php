<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>DPMPTSP INDRAMAYU</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- ================== BEGIN core-css ================== -->
	<link href="{{ asset('assets_admin/css/vendor.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_admin/css/facebook/app.min.css') }}" rel="stylesheet" />
	<!-- ================== END core-css ================== -->
</head>
<body class='pace-top'>
	<!-- BEGIN #loader -->
	<div id="loader" class="app-loader">
		<span class="spinner"></span>
	</div>
	<!-- END #loader -->

	<!-- BEGIN #app -->
	<div id="app" class="app">
		<!-- BEGIN login -->
		<div class="login login-with-news-feed">
			<!-- BEGIN news-feed -->
			<div class="news-feed">
				<div class="news-image" style="background-image: url(../assets/img/tes.jpg)"></div>
				<div class="news-caption">
					<h4 class="caption-title"><b>DPMPTSP</b> KAB INDRAMAYU</h4>
					<p>
					Content Management System Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Kab.Indramayu
					</p>
				</div>
			</div>
			<!-- END news-feed -->
			
			<!-- BEGIN login-container -->
			<div class="login-container">
				<!-- BEGIN login-header -->
				<div class="login-header mb-30px">
					<div class="brand">
						<div class="d-flex align-items-center">
							<span class="logo"><img src="http://localhost:8000/uploads/logo/169669327791_logo1.png" class="img-fluid"></span>
							
						</div>
					</div>
					
				</div>
				<!-- END login-header -->
				
				<!-- BEGIN login-content -->
				<div class="login-content">
					 @if (Session::get('error'))
						<div class="alert alert-danger alert-dismissible">
							{{Session::get('error')}}
						</div>
					@endif
					 <form method="POST" action="{{ route('login.custom') }}">
						@csrf
						@if ($errors->has('email'))
							<span class="text-danger">{{ $errors->first('email') }}</span>
						@endif
						<div class="form-floating mb-15px">
							<input type="email" class="form-control h-45px fs-13px" name="email" placeholder="Email Address" id="emailAddress" />
							<label for="emailAddress" class="d-flex align-items-center fs-13px text-gray-600">Email Address</label>
						</div>
						@if ($errors->has('password'))
							<span class="text-danger">{{ $errors->first('password') }}</span>
						@endif
						<div class="form-floating mb-15px">
							<input type="password" name="password" class="form-control h-45px fs-13px" placeholder="Password" id="password" />
							<label for="password" class="d-flex align-items-center fs-13px text-gray-600">Password</label>
						</div>
						<div class="mb-15px">
							<button type="submit" class="btn btn-success d-block h-45px w-100 btn-lg fs-14px">Sign me in</button>
						</div>
	
						<hr class="bg-gray-600 opacity-2" />
						<div class="text-gray-600 text-center  mb-0">
							&copy; DPMPTSP All Right Reserved 2024
						</div>
					</form>
				</div>
				<!-- END login-content -->
			</div>
			<!-- END login-container -->
		</div>
		<!-- END login -->
		
		<!-- BEGIN scroll-top-btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
		<!-- END scroll-top-btn -->
	</div>
	<!-- END #app -->
	
	<!-- ================== BEGIN core-js ================== -->
	<script src="{{ asset('assets_admin/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/app.min.js') }}"></script>
	<!-- ================== END core-js ================== -->
</body>
</html>