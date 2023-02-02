<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>@yield('fronttitle',"Home")</title>
	    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    @yield('frontendcss')
    

</head>
<body>
	<div id="app">
		@include('frontend.layouts.navbar')
		<main class="container mt-4">
			@yield('content')
		</main>
	</div>
<!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
@yield('frontendjs')
</body>
</html>