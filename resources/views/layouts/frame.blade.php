<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $TabTitle ?? "Lisahwan Snacks" }}</title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="icon" href="/images/lisahwan_logo.crdownload">

    @vite(['resources/css/app.css','resources/js/app.js'])
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

        <div id="indicators-carousel" class="relative w-full" data-carousel="slide">
            <div class="relative h-56 overflow-hidden md:h-96">
                <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                    <img src="images/Galeri/{{ $carousel_1 }}"
                        class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-cover object-top"
                        alt="{{ $carousel_1 }}">
                </div>
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="images/Galeri/{{ $carousel_2 }}"
                        class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-cover object-top"
                        alt="{{ $carousel_2 }}">
                </div>
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="images/Galeri/{{ $carousel_3 }}"
                        class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 object-cover object-top"
                        alt="{{ $carousel_3 }}">
                </div>
            </div>
            <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                    data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                    data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3"
                    data-carousel-slide-to="2"></button>
            </div>
            <button type="button"
                class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-prev>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 1 1 5l4 4" />
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button"
                class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-next>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>

        <div class="bg-neutral-200">
            @yield('content_page')

        </div>

        @include('layouts.contact_src')
        <div>
            @include('layouts.bottombar')
        </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
</body>

</html>
