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
    {{-- <script src='resources/js/script.js' defer></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        /* Style for loading page */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            z-index: 9999;
            display: none;
            /* Hidden by default */
        }

        .spinner-square {
            display: flex;
            flex-direction: row;
            width: 90px;
            height: 120px;
        }

        .spinner-square .square {
            width: 17px;
            height: 80px;
            margin: auto;
            border-radius: 4px;
        }

        .square-1 {
            animation: square-anim 1200ms cubic-bezier(0.445, 0.05, 0.55, 0.95) 0s infinite;
        }

        .square-2 {
            animation: square-anim 1200ms cubic-bezier(0.445, 0.05, 0.55, 0.95) 200ms infinite;
        }

        .square-3 {
            animation: square-anim 1200ms cubic-bezier(0.445, 0.05, 0.55, 0.95) 400ms infinite;
        }

        @keyframes square-anim {
            0% {
                height: 60px;
                background-color: #eab308;
                /* Warna dasar kuning */
            }

            20% {
                height: 60px;
                background-color: #eac918;
                /* Warna kuning lebih terang */
            }

            40% {
                height: 90px;
                background-color: #111827;
                /* Warna kuning lebih cerah */
            }

            80% {
                height: 60px;
                background-color: #eac918;
                /* Kembali ke warna kuning lebih terang */
            }

            100% {
                height: 60px;
                background-color: #eab308;
                /* Kembali ke warna dasar kuning */
            }
        }

        /* Style for the tagline */
        .loading-tagline {
            margin-top: 0px;
            font-size: 20px;
            color: #111827;
            font-weight: 800;
            text-align: center;
        }

        .brand-tagline {
            font-size: 18px;
            color: #111827;
            font-weight: 400;
            text-align: center;
            font-style: italic;
        }
    </style>
</head>

<body class="flex flex-col h-full bg-neutral-200">
    <!-- Loading Page -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner-square">
            <div class="square-1 square"></div>
            <div class="square-2 square"></div>
            <div class="square-3 square"></div>
        </div>
        <div class="loading-tagline">
            Loading...
        </div>
        <div class="brand-tagline">
            ~ A taste you'll remember ~
        </div>
    </div>
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

        $(document).ready(function() {
            // console.log('AWAL SAAT DOM SIAP', sessionStorage.getItem('loadingDisplayed'));

            // Periksa loading status segera setelah DOM siap
            if (sessionStorage.getItem('loadingDisplayed') === 'true') {
                $('#loadingOverlay').css('display', 'flex');
            } else {
                $('#loadingOverlay').css('display', 'none');
            }

            // Show loading page on form submit
            $('form').on('submit', function() {
                $('#loadingOverlay').css('display', 'flex');

                // Disable semua tombol submit dalam form
                $(this).find('button[type=submit]').prop('disabled', true);

                // Set status loading di sessionStorage
                sessionStorage.setItem('loadingDisplayed', true);
            });

            // Hide loading page once the page is fully loaded
            // console.log('RELOAD', sessionStorage.getItem('loadingDisplayed'));
            $('#loadingOverlay').css('display', 'none');
            // Enable all submit buttons
            $('button[type=submit]').prop('disabled', false);
            // Set status loading di sessionStorage
            sessionStorage.setItem('loadingDisplayed', false);
            // console.log('RELOAD BERUBAH', sessionStorage.getItem('loadingDisplayed'));

            // Handle browser back/forward navigation using pageshow event
            $(window).on('pageshow', function(event) {
                // console.log('PAGESHOW', sessionStorage.getItem('loadingDisplayed'));

                // Enable all submit buttons
                $('button[type=submit]').prop('disabled', false);

                // event.originalEvent.persisted adalah properti yang mengindikasikan apakah halaman dipulihkan dari cache atau tidak.
                // Ini adalah cara yang lebih handal untuk menangani skenario di mana pengguna kembali ke halaman sebelumnya dengan tombol back di browser.
                if (event.originalEvent.persisted) {
                    // console.log('BACK', sessionStorage.getItem('loadingDisplayed'));
                    $('#loadingOverlay').css('display', 'none');
                } else if (sessionStorage.getItem('loadingDisplayed') === 'false') {
                    $('#loadingOverlay').css('display', 'none');
                }
            });
        });
    </script>
</body>

</html>
