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

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

	<title>Admin Login</title>
    <base href="{{asset('')}}">
	<link href="admins/css/app.css" rel="stylesheet">
	<link href="admins/more/css/style.css" rel="stylesheet">
	<script>
        const BASE_URL = "{{ url('/admin') }}";
	</script>
</head>
<body>
	<div id="app">
		<login></login>
	</div>
	<script src="{{ mix('admins/js/app-admin.js') }}"></script>

</body>

</html>