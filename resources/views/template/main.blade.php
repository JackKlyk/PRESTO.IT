<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? '' }}</title>

    <link rel="icon" type="image/x-icon" href="\img\presto.it_favicon.ico">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles
</head>

<body class="container-fluid min-vh-100 p-0">
    <x-navbar />

    <main class="container min-vh-84 pt-5 px-5">
        {{ $slot }}
    </main>

    <x-footer />
@livewireScripts
</body>

</html>