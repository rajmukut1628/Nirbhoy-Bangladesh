<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ $title ?? 'নির্ভয় বাংলাদেশ' }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="min-h-screen bg-gray-100">

    <main>
        {{ $slot }}
    </main>

    @livewireScripts

</body>

</html>