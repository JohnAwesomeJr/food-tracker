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
	padding:20px 0px;
	bottom:0px;
	left:0px;
	width:100%;
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
    <p id="production-banner" class="banner-style-loc">This is not the production environment.</p>
@endif

	<div class="container">
		@yield('content')
	</div>
</body>
</html>
