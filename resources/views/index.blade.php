@extends('layouts.frame')

@section('content_page')
    <section class="bg-white py-4 md:py-0">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-4xl xl:text-6xl">
                    Waktu Nyemil jadi Hangat dan Renyah
                </h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl">Dengan komitmen kami
                    akan kualitas, kami menyediakan rangkaian cemilan yang diolah dengan teliti dan
                    penuh dedikasi.</p>
                <a href="{{ route('register') }}"
                    class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-yellow-500 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300">
                    Jadi Member
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
                <a href="/products"
                    class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100">
                    Lihat Produk
                </a>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img src="/images/fotoproduk/HomeProduct.jpg" alt="preview">
            </div>
        </div>
    </section>

    <section class="bg-gray-900 py-4 md:py-0">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="max-w-screen-lg mb-8 lg:mb-16 w-full">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-white">Apa saja yang spesial dari Lisahwan?</h2>
                <p class="sm:text-xl text-gray-400">
                    Dalam inspirasi kekayaan hasil laut dan keanekaragaman bumbu rempah Jawa Timur, kami memahami bahwa
                    dengan menggabungkan kedua elemen tersebut, kami mampu menciptakan cemilan berkualitas tinggi dan lezat
                    di Lisahwan.
                </p>
            </div>
            <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                <div>
                    <div
                        class="flex justify-center items-center mb-4 w-10 h-10 rounded-full lg:h-12 lg:w-12 bg-primary-900">
                        <svg class="w-6 h-6 text-yellow-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                            <path d="M17.947 2.053a5.209 5.209 0 0 0-3.793-1.53A6.414 6.414 0 0 0 10 2.311 6.482 6.482 0 0 0 5.824.5a5.2 5.2 0 0 0-3.8 1.521c-1.915 1.916-2.315 5.392.625 8.333l7 7a.5.5 0 0 0 .708 0l7-7a6.6 6.6 0 0 0 2.123-4.508 5.179 5.179 0 0 0-1.533-3.793Z"/>
                          </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-yellow-500">Taste</h3>
                    <p class="text-gray-400">Setiap gigitan menghadirkan cita rasa
                        istimewa yang sulit untuk dilupakan.</p>
                </div>
                <div class="flex flex-col items-end md:items-start">
                    <div
                        class="flex justify-center items-center mb-4 w-10 h-10 rounded-full lg:h-12 lg:w-12 bg-primary-900">
                        <svg class="w-6 h-6 text-yellow-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                          </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-yellow-500">Premium</h3>
                    <p class="text-end md:text-start text-gray-400">Mulai dari kualitas produk, bahan, bumbu, hingga packaging, semuanya memiliki
                        standar premium untuk pengalaman terbaik bagi pelanggan kami.</p>

                </div>

                <div>
                    <div
                        class="flex justify-center items-center mb-4 w-10 h-10 rounded-full lg:h-12 lg:w-12 bg-primary-900">
                        <svg class="w-6 h-6 text-yellow-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                          </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-yellow-500">Homemade</h3>
                    <p class="text-gray-400">Tiada yang dapat menyaingi cita rasa autentik, hangat, dan memikat ala
                        homemade. </p>
                </div>

                <div class="flex flex-col items-end md:items-start">
                    <div
                        class="flex justify-center items-center mb-4 w-10 h-10 rounded-full lg:h-12 lg:w-12 bg-primary-900">
                        <svg class="w-6 h-6 text-yellow-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M7.824 5.937a1 1 0 0 0 .726-.312 2.042 2.042 0 0 1 2.835-.065 1 1 0 0 0 1.388-1.441 3.994 3.994 0 0 0-5.674.13 1 1 0 0 0 .725 1.688Z"/>
                            <path d="M17 7A7 7 0 1 0 3 7a3 3 0 0 0-3 3v2a3 3 0 0 0 3 3h1a1 1 0 0 0 1-1V7a5 5 0 1 1 10 0v7.083A2.92 2.92 0 0 1 12.083 17H12a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h1a1.993 1.993 0 0 0 1.722-1h.361a4.92 4.92 0 0 0 4.824-4H17a3 3 0 0 0 3-3v-2a3 3 0 0 0-3-3Z"/>
                          </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-yellow-500">Fast Respond</h3>
                    <p class="text-end md:text-start text-gray-400">Kami siap memberikan respon cepat untuk memastikan kebutuhan dan pertanyaan
                        Anda terpenuhi dengan segera.</p>
                </div>

                <div>
                    <div
                        class="flex justify-center items-center mb-4 w-10 h-10 rounded-full lg:h-12 lg:w-12 bg-primary-900">
                        <svg class="w-7 h-7 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-yellow-500">Terlaris</h3>
                    <p class="text-gray-400">Sejak 2007, Lisahwan telah menjadi brand camilan yang terpercaya dan terlaris,
                        yang terus berinovasi dalam varian produk.</p>
                </div>
            </div>
        </div>
    </section>

@endsection
