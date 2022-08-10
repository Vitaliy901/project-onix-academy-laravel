<!DOCTYPE html>
<html lang="{{ __('post.new_lang') }}">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ $title }}</title>
	@vite(['resources/js/app.js'])
</head>

<body>
	<x-post-header />

	{{ $slot }}
</body>

</html>