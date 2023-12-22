<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $TabTitle ?? 'Lisahwan Snacks' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="icon" href="/images/lisahwan_logo.crdownload">

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <!-- CSRF Token, gaperlu ini udah nongol sih tomnol log-outnya -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src='resources/js/script.js' defer></script>
</head>

<body>
    <div class="flex flex-col" style="font-family: 'Montserrat';">
        <div>
            @include('layouts.topbar')
        </div>

        <div class="bg-neutral-200 flex flex-col items-center">
            @if (session('deleteCart_success'))
                <div class="w-8/12 sm:w-5/12 md:w-4/12 lg:w-3/12 flex justify-center items-center p-4 mt-8 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-900 dark:text-green-400"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">{{ session('deleteCart_success') }}
                    </div>
                </div>
            @endif
            @yield('content_page')
        </div>

        <div>
            @include('layouts.bottombar')
        </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
</body>

</html>
