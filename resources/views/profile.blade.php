<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'>
	<meta name="description" content="Form for registration">
	<meta name="keywords" content="create, account, email">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="preload" href="https://fonts.googleapis.com/css2?family=League+Spartan&family=Lora&family=Roboto&display=swap" as="style">
	<link href="https://fonts.googleapis.com/css2?family=League+Spartan&family=Lora&family=Roboto&display=swap" rel="stylesheet">
	<title>Profile</title>
	<link rel="shortcut icon" href="img/favicon/favicon.ico">
</head>

<body>
	<p>{{ $user }}</p>
	<a href="{{ route('user.loguot') }}">Loguot</a>
</body>

</html>