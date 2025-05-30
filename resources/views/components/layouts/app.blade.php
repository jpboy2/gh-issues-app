<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $title ?? 'GitHub Issues' }}</title>
    @livewireStyles
</head>
<body class="bg-[#0d1117] text-white font-sans antialiased">

    
        {{ $slot }}
    

    @livewireScripts
</body>
</html>
