
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - Bahana Mega Prestasi</title>
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">

    @vite(['resources/css/app.css'])
    @livewireStyles
    @fluxAppearance
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
</head>
<body>
    <div class="flex justify-center items-center min-h-screen bg-gradient-to-b from-sky-700 to-sky-900">
        {{ $slot }}       
    </div>
    <x-toaster-hub />
    @vite(['resources/js/app.js'])
    @fluxScripts
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>

