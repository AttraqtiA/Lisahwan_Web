<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $TabTitle ?? 'Lisahwan Surabaya' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    <link rel="icon" href="/images/lisahwan_logo.png">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body class="antialiased" class="flex flex-col" style="font-family: 'Montserrat';">
    <div class="relative flex items-center justify-center min-h-screen bg-gray-900">
        <div data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800" class="max-w-xl mx-auto">
            <div class="flex flex-col justify-center items-center space-y-4">
                <img src="/images/lisahwan_logo.png" alt="Lisahwan™" class="w-1/5">
                <div class="flex flex-row justify-center items-center">
                    <div class="pr-4 text-lg font-light text-gray-500 border-r border-gray-500 tracking-wider">
                        @yield('code')
                    </div>
                    <div class="ml-4 text-lg font-light text-gray-500 uppercase tracking-wider">
                        @yield('message')
                    </div>
                </div>
            </div>
            <p class="mt-2 text-gray-500 text-base font-normal text-center">
                Silahkan menghubungi
                <span class="cursor-pointer underline hover:text-yellow-500"
                    onclick="sendWhatsAppMessage('{{ View::yieldContent('code') }}')">WhatsApp Lisahwan™
                    (082230308030)!</span>
            </p>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();

        function sendWhatsAppMessage(errorCode) {
            // Nomor telepon dan pesan
            var phone = '6282230308030'; // Format internasional tanpa tanda plus
            var message =
                'Halo Lisahwan, saya ingin memberitahu bahwa saya mengalami kendala pada website dengan kode error ' +
                errorCode + '. Tolong dibantu segera yaa, terima kasih.';

            // Encode pesan agar sesuai dengan format URL
            var encodedMessage = encodeURIComponent(message);

            // Buat URL WhatsApp
            var whatsappUrl = 'https://wa.me/' + phone + '?text=' + encodedMessage;

            // Buka URL di jendela atau tab baru
            window.open(whatsappUrl, '_blank');
        }
    </script>
</body>

</html>
