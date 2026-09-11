<link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

<div class="relative w-full h-[85vh] min-h-[500px] flex items-center justify-center overflow-hidden">
    <!-- Background Image -->
    <img class="absolute inset-0 w-full h-full object-cover object-center"
        src="{{ asset('images/fotoproduk/GalleryCarousel_8.jpg') }}" alt="Lisahwan Hero Banner">

    <!-- Dark Overlay (Supaya teks putih terbaca jelas) -->
    <div class="absolute inset-0 bg-black/60"></div>

    <!-- Content Container -->
    <div class="relative z-10 text-center px-4 max-w-4xl mx-auto flex flex-col items-center">
        <!-- Headline -->
        <h1 class="flex flex-col gap-1 sm:gap-2 mb-6" style="font-family: 'Playfair Display', serif;">
            <!-- 1. Lisahwan -->
            <span data-aos="fade-down" data-aos-anchor-placement="top-bottom" data-aos-duration="1000"
                data-aos-delay="200"
                class="text-4xl sm:text-5xl lg:text-6xl font-bold uppercase text-white tracking-[0.05em] drop-shadow-lg leading-none">
                LISAHWAN
            </span>
            <!-- 2 & 3. Sajian Praktis & Cita Rasa Nusantara -->
            <span data-aos="fade-down" data-aos-anchor-placement="top-bottom" data-aos-duration="1000"
                data-aos-delay="200"
                class="text-2xl sm:text-3xl lg:text-4xl font-normal text-yellow-500 drop-shadow-md">
                Sajian Praktis, <br class="block sm:hidden">
                <span>Cita Rasa Nusantara</span>
            </span>
        </h1>

        <!-- 4. Dari Surabaya sejak 2007 (Eyebrow/Accent style) -->
        <div data-aos="zoom-in" data-aos-anchor-placement="top-bottom" data-aos-duration="1000" data-aos-delay="200"
            class="flex items-center justify-center gap-3 w-full mb-8">
            <div class="h-[1px] bg-yellow-500/60 w-10 sm:w-16"></div>
            <span class="text-xs sm:text-sm tracking-[0.25em] text-gray-200 uppercase font-medium">
                Dari Surabaya sejak 2007
            </span>
            <div class="h-[1px] bg-yellow-500/60 w-10 sm:w-16"></div>
        </div>

        <!-- CTA Buttons -->
        <div data-aos="zoom-in" data-aos-anchor-placement="top-bottom" data-aos-duration="1000" data-aos-delay="200"
            class="flex flex-col sm:flex-row gap-3 sm:gap-4 w-full justify-center">
            @if (!Auth::check())
                <a href="{{ route('register') }}"
                    class="cursor-pointer text-gray-900 bg-yellow-500 hover:bg-yellow-600 font-semibold rounded-full text-sm sm:text-base px-6 py-3 text-center inline-flex items-center justify-center transition-all duration-300 transform hover:scale-105 shadow-lg">
                    Order Sekarang
                    <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
            @endif
            <a href="{{ route('products') }}"
                class="cursor-pointer text-white bg-transparent border-[1.5px] border-yellow-500 hover:bg-yellow-500 hover:text-gray-900 font-semibold rounded-full text-sm sm:text-base px-6 py-3 text-center inline-flex items-center justify-center transition-all duration-300 transform hover:scale-105 shadow-lg">
                Lihat Produk
                <svg class="w-4 h-4 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M14 7h-4v3a1 1 0 0 1-2 0V7H6a1 1 0 0 0-.997.923l-.917 11.924A2 2 0 0 0 6.08 22h11.84a2 2 0 0 0 1.994-2.153l-.917-11.924A1 1 0 0 0 18 7h-2v3a1 1 0 1 1-2 0V7Zm-2-3a2 2 0 0 0-2 2v1H8V6a4 4 0 0 1 8 0v1h-2V6a2 2 0 0 0-2-2Z"
                        clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>
</div>
