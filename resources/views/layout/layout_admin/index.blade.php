<!DOCTYPE html>
<html lang="en">
<head>
	@include('layout.layout_admin.header')
</head>
<body>
	<!-- BEGIN #loader -->
	<div id="loader" class="app-loader">
		<span class="spinner"></span>
	</div>
	<!-- END #loader -->

	<!-- BEGIN #app -->
	<div id="app" class="app app-header-fixed app-sidebar-fixed">
		<!-- BEGIN #header -->
		<div id="header" class="app-header app-header-inverse">
			@include('layout.layout_admin.navbar')
		</div>
		<!-- END #header -->
		<!-- BEGIN #sidebar -->
		@include('layout.layout_admin.sidebar')
		<!-- END #sidebar -->
		
		<!-- BEGIN #content -->
		@yield('content')
		<!-- END #content -->
		
		<!-- BEGIN scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
		<!-- END scroll to top btn -->
	</div>
	<!-- END #app -->
	@include('layout.layout_admin.footer')
	
	
</body>
</html>