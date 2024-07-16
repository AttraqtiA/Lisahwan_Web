<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $TabTitle ?? 'Admin Lisahwan' }}
    </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="icon" href="/images/lisahwan_logo.png">

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <!-- CSRF Token, gaperlu ini udah nongol sih tombol log-outnya -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src='resources/js/script.js' defer></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body class="flex flex-col h-full bg-neutral-200">
    <div class="flex flex-col h-full bg-neutral-200" style="font-family: 'Montserrat';">
        <div>
            @include('layouts.admin.topbar')
        </div>

        <div class="bg-neutral-200 h-screen">
            @yield('content_page')
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
