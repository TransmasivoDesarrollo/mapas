<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>404</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{url('/assets')}}/img/favicon.ico" type="image/x-icon"/>
	
	<!-- Fonts and icons -->
	<script src="{{url('/assets')}}/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Montserrat:100,200,300,400,500,600,700,800,900"]},
			custom: {"families":["Flaticon", "LineAwesome"], urls: ['{{url('/assets')}}/css/fonts.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{url('/assets')}}/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{url('/assets')}}/css/ready.min.css">
</head>
<body class="page-not-found" style="background-color:#fff;">
	<div class="wrapper not-found" style="background-color:#fff;">
		<h1 class="animated fadeIn"></h1>
		<img src="{{url('/')}}/assets/img/transmasivo.png" style="width: 350px;">
		<div class="desc animated fadeIn" style="color:#000;"><span style="color:#000;">¡La sesión ha caducado!</span><br/>Por favor, inicia sesión nuevamente. </div>

		<a href="{{url('/login')}}" class="btn btn-primary btn-back-home mt-4 animated fadeInUp">
			<span class="btn-label mr-2">
				<i class="flaticon-home"></i>
			</span>
			Ir al login
		</a>
	</div>
	<script src="{{url('/assets')}}/js/core/jquery.3.2.1.min.js"></script>
	<script src="{{url('/assets')}}/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="{{url('/assets')}}/js/core/popper.min.js"></script>
	<script src="{{url('/assets')}}/js/core/bootstrap.min.js"></script>
</body>
</html>