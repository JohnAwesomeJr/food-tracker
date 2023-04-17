<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/spacelab/bootstrap.min.css">
</head>
<body>
@if (env('APP_ENV') === 'production')
    <p style="color:red;">This is the production environment.</p>
@else
    <p>This is not the production environment.</p>
@endif

	<div class="container">
		@yield('content')
	</div>
</body>
</html>
