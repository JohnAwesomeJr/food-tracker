<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/spacelab/bootstrap.min.css">
</head>
<body>
<style>
#production-banner{
	color:white;
	background:red;
	position:fixed;
	bottom:0px;
	left:0px;
	width:100%;
}
</style>
@if (env('APP_ENV') === 'production')
    <p id="production-banner">This is the production environment.</p>
@else
    <p>This is not the production environment.</p>
@endif

	<div class="container">
		@yield('content')
	</div>
</body>
</html>
