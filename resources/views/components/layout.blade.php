@props([
    'title' => 'Unknown'
])


    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <title> {{ $title }} | {{ config('app.name') }}</title>


</head>
<body class="bg-amber-100">

<h1> {{ $title }} </h1>

@include('partials.nav')

<main>
    {{ $slot }}
</main>

</body>
</html>
