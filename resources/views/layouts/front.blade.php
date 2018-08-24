<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<title></title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript-->
    <script src="jquery/jquery.min.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

	<main class="py-4">
        @yield('content')
    </main>

</body>
</html>