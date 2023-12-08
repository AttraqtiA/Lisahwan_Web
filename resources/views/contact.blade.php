@extends('layouts.frame')

@section('content_page')
    <section style="background-image: url('images/crop_brown_desk.jpg')"
        class="bg-center bg-cover bg-no-repeat bg-gray-700 bg-blend-multiply">
        <div class="px-4 mx-auto max-w-screen-xl text-center text-white py-16 lg:py-24 flex flex-col gap-16">
            <div>
            <h2 class="text-center mb-4 text-4xl font-bold">Dapatkan <mark class="px-2 text-sky-400 bg-gray-800 rounded dark:bg-gray-800">Solusi
                    Terbaik</mark>
                untuk Bisnis Anda!</h2>
            <h2 class="text-center text-4xl font-bold">Segera Hubungi Kami melalui</h2>
            </div>

            <div class="flex flex-col md:flex-row justify-center gap-8">
                <a href="https://api.whatsapp.com/send?phone=62811273823" class="m-auto">
                    <button type="button" data-te-ripple-init data-te-ripple-color="light"
                        class="flex items-center mb-2 inline-block rounded-xl px-6 py-2.5 text-xs font-medium leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg"
                        style="background-color: #128c7e">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-10 md:w-10" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                        </svg>
                        <p class="ml-5 text-xl md:text-2xl">WhatsApp</p>
                    </button>
                </a>

                <a href="mailto:gosyenpolinator@gmail.com" class="m-auto">
                    <button type="button" data-te-ripple-init data-te-ripple-color="light"
                        class="bg-white border-2 border-sky-500 flex items-center mb-2 inline-block rounded-xl px-12 py-2.5 text-xs font-medium leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg">
                        <svg class="h-6 w-6 md:h-10 md:w-10 text-sky-500" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                            <polyline points="22,6 12,13 2,6" />
                        </svg>
                        <p class="ml-5 text-xl md:text-2xl text-sky-500">Email</p>
                    </button>
                </a>
            </div>

            <iframe class="mx-auto px-8 w-full md:w-3/4 shadow-lg" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.2250966349916!2d112.73165477476101!3d-7.328596692679712!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb41eea3ee81%3A0x83d2a1606a6f6179!2sJl.%20Jemur%20Andayani%20XIII%20No.6%2C%20Jemur%20Wonosari%2C%20Kec.%20Wonocolo%2C%20Surabaya%2C%20Jawa%20Timur%2060237!5e0!3m2!1sen!2sid!4v1701947226871!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

        </div>
    </section>

@endsection
