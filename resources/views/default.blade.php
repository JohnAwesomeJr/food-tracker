<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/spacelab/bootstrap.min.css">
</head>
<body>
<style>
#production-banner{
	position:fixed;
	border-radius:5px;
	padding:20px;
	bottom:0px;
	right:0px;
}
.banner-style-pro{
	color:white;
	background:red;
}
.banner-style-loc{
	color:gray;
	background:lightgray;
}

</style>
@if (env('APP_ENV') === 'production')
    <p id="production-banner" class="banner-style-pro">This is the production environment.</p>
@else
<div class=" animated infinite bounce">
    <p id="production-banner" class="banner-style-loc">This is not the production environment.</p>
</div>
@endif

	<div class="container">
		@yield('content')
	</div>
</body>
</html>
