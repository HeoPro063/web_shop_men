<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>AdminKit Demo - Bootstrap 5 Admin Template</title>
	<base href="{{asset('')}}">
 
	<link href="admins/css/admin.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script>
        const BASE_URL = "{{ url('/admin') }}";
	</script>
</head>

<body>
	<div id="app">
		<div class="wrapper">
			@include("admin.includes.sidebar")
	
			<div class="main">
				@include("admin.includes.navbar")
	
				@yield('content-admin')
	
				@include("admin.includes.footer")
				
			</div>
		</div>
	</div>

	<script src="admins/js/app-more.js"></script>
	<script src="admins/more/js/main.js"></script>
	<script src="admins/js/admin.min.js"></script>

	<script src="{{ mix('admins/js/app-admin.js') }}"></script>

</body>

</html>