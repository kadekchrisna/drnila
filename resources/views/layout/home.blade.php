<!DOCTYPE html>
<html>
<head>
	<title>Dronila</title>
	<link rel="stylesheet" href="{{ mix('/css/app.css') }}">
	<link rel="stylesheet" href="/css/navbar.css">
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
	<div class="container">
		
	@include('inc.header')
	@include('inc.navbar')

	<div class="mt-2">
		@yield('content')	
	</div>
	

	</div>


	<script src="{{mix('/js/app.js')}}" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>