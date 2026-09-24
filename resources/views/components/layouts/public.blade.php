<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="description"
          content="নির্ভয় বাংলাদেশ - নিরাপদ অভিযোগ ও যাচাইকৃত তথ্য প্ল্যাটফর্ম">

    <meta name="theme-color" content="#020617">

    <title>{{ $title ?? 'নির্ভয় বাংলাদেশ' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Arial, "Noto Sans Bengali", sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">

    {{ $slot }}

    @livewireScripts

</body>

</html>