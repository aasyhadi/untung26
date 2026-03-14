<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Bootstrap 5 Admin &amp; Dashboard Template">
	<meta name="author" content="Bootlab">

	<title>{{$pagetitle}} | UNTUNG YASRIL</title>

	<link rel="canonical" href="pages-blank.html" />
	<link rel="shortcut icon" href="img/favicon.ico">

	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&amp;display=swap" rel="stylesheet">
	<link class="js-stylesheet" href="{{url('app/css/light.css')}}" rel="stylesheet">
	<link class="stylesheet" href="{{url('app/css/light.css')}}" rel="stylesheet">
	<link class="stylesheet" href="{{url('css/custom.css')}}" rel="stylesheet">
	<link class="stylesheet" href="{{url('css/passtrength.css')}}" rel="stylesheet">
	<link class="stylesheet" href="{{url('vendor/selectize/selectize.css')}}" rel="stylesheet">
	<link class="stylesheet" href="{{url('vendor/selectize/selectize.bootstrap5.css')}}" rel="stylesheet">
	<link class="stylesheet" href="{{url('vendor/jquery-confirm.min.css')}}" rel="stylesheet">
	<link class="stylesheet" href="{{url('vendor/lineawesome/css/line-awesome.min.css')}}" rel="stylesheet">
	<!-- END SETTINGS -->

    <!-- Untuk Datepicker -->
	<link class="stylesheet" href="{{url('css/jquery-ui.css')}}" rel="stylesheet">
    <script src="{{url('js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{url('js/jquery-ui.js')}}"></script>

</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="/dashboard">
                    <span class="align-middle me-3">untungyasril.com</span>
                    <p style="font-size: 9pt;">Web Administrator</p>
                </a>
				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Menu
					</li>
					<li class="sidebar-item">
						<a   href="{{url('/dashboard')}}" class="sidebar-link">
			              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
			            </a>
					</li>
					@include("sidebar")
				</ul>

				<!-- <div class="sidebar-cta">
					<div class="sidebar-cta-content">
						<strong class="d-inline-block mb-2">Monthly Sales Report</strong>
						<div class="mb-3 text-sm">
							Your monthly sales report is ready for download!
						</div>

						<div class="d-grid">
							<a href="https://themes.getbootstrap.com/product/appstack-responsive-admin-template/" class="btn btn-primary" target="_blank">Download</a>
						</div>
					</div>
				</div> -->
			</div>
		</nav>
		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle">
		          <i class="hamburger align-self-center"></i>
		        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						@include("topbar")
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">
						@section('content')
						@show
				</div>
			</main>

			<footer class="footer">
				@include("footer")
			</footer>
		</div>
	</div>
	@section('modal')
	@show
	<script src="{{url('app/js/app.js')}}"></script>
	<script src="{{asset('vendor/jquery.form.min.js')}}"></script>
	<script src="{{asset('vendor/jquery.validate.min.js')}}"></script>
	<script src="{{asset('vendor/sweetalert.min.js')}}"></script>
	<script src="{{asset('vendor/jquery.mask.min.js')}}"></script>
	<script src="{{url('vendor/selectize/selectize.min.js')}}"></script>
	<script src="{{url('vendor/jquery-confirm.min.js')}}"></script>
	<script src="{{url('js/init.js')}}"></script>
	<script src="{{url('js/jquery.passtrength.min.js')}}"></script>

	<script>
		window.adminMediaUrl = function(path){
			if(!path){ return ''; }
			path = String(path).replace(/^\/+/, '');
			if(/^https?:\/\//i.test(path)){ return path; }
			if(path.indexOf('storage/') === 0){
				return "{{ url('/media') }}/" + path.replace(/^storage\//, '');
			}
			if(path.indexOf('uploads/') === 0 || path.indexOf('images/') === 0 || path.indexOf('img/') === 0){
				return "{{ url('/') }}/" + path;
			}
			return "{{ url('/media') }}/" + path;
		};
	</script>
	@section('js')
	@show
</body>


</html>
