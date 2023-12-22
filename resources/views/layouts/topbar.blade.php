<nav class="bg-white dark:bg-gray-900 w-full z-20 top-0 left-0 border-b border-black dark:border-black">
    <div class="flex flex-wrap items-center justify-between mx-auto py-4 px-4 md:px-8">
        <a href="/" class="flex items-center">
            <img src="/images/lisahwan_logo.crdownload" class="mr-3 w-16" alt="Lisahwan Logo" />
        </a>
        <div class="flex md:order-2">

            <!-- Right Side Of Navbar -->
            <ul class="flex flex-row items-center gap-2 md:gap-4 mt-1 md:mt-0">
                <li>
                    <button type="button" data-drawer-target="drawer-right-example"
                        data-drawer-show="drawer-right-example" data-drawer-placement="right"
                        aria-controls="drawer-right-example">
                        <div class="rounded-lg border border-white border-0.5 p-2">
                            <svg class="w-6 h-6 text-white dark:text-white " aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1"
                                    d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1" />
                            </svg>
                        </div>
                    </button>
                </li>
                <!-- drawer component -->
                <div id="drawer-right-example"
                    class="fixed top-0 right-0 z-40 w-full sm:w-7/12 lg:w-5/12 h-screen pt-6 p-5 overflow-y-auto transition-transform translate-x-full bg-gray-800 dark:bg-gray-800"
                    tabindex="-1" aria-labelledby="drawer-right-label">
                    <div class="flex flex-row items-center mb-4 justify-between">
                        <h5 id="drawer-right-label"
                            class="inline-flex justify-center items-center text-xl sm:text-lg font-semibold text-yellow-500 dark:text-yellow-500">
                            <svg class="w-6 h-6 mr-2 text-yellow-500 dark:text-yellow-500" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1"
                                    d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1" />
                            </svg>Keranjang
                        </h5>
                        <button type="button" data-drawer-hide="drawer-right-example"
                            aria-controls="drawer-right-example"
                            class="cursor-pointer text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex items-center justify-center dark:hover:bg-gray-200 dark:hover:text-gray-400">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close menu</span>
                        </button>
                    </div>
                    <div
                        class="flex flex-col-reverse mt-6 @if (empty($carts)) h-full justify-center items-center @endif">
                        @php
                            $countSubtotal = 0;
                        @endphp
                        @if (!empty($carts))
                            @foreach ($carts as $cart)
                                <div class="flex flex-row items-center w-full">
                                    <img class="h-28 w-28 object-bottom object-cover rounded-lg drop-shadow-md"
                                        src="/images/fotoproduk/{{ $cart->product->image }}"
                                        alt="{{ $cart->product->name }}">
                                    <div class="flex flex-col ml-3 justify-center">
                                        <p class="text-lg font-medium text-white">{{ $cart->product->name }}</p>
                                        <p class="text-sm font-normal text-gray-400">{{ $cart->quantity }} buah
                                            ({{ $cart->weight }} gram)
                                        </p>
                                        <p class="mt-2 text-base font-medium text-white">Rp.
                                            {{ number_format($cart->price, 0, ',', '.') }}
                                        </p>
                                        <div
                                            class="flex flex-row items-center gap-x-16 sm:gap-x-6 md:gap-x-24 lg:gap-x-40 mt-1 mb-1">
                                            <form action="/carts/edit/{{ $cart->product_id }}" method="GET">
                                                @csrf
                                                <button type="submit"
                                                    class="cursor-pointer text-white bg-yellow-500 hover:bg-yellow-600 font-medium rounded-md text-sm sm:text-sm md:text-sm lg:text-sm px-2 py-1 inline-flex items-center">
                                                    <svg class="w-4 h-4 sm:mr-1 text-white dark:text-white"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 20 18">
                                                        <path
                                                            d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                                                        <path
                                                            d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                                                    </svg>
                                                    <span class="sm:inline-block">Ubah Pesanan</span>
                                                </button>
                                            </form>
                                            <form action="/carts/delete/{{ $cart->id }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit"
                                                    class="cursor-pointer text-sm font-medium text-yellow-500 hover:text-yellow-600"
                                                    onclick="return confirm('Apakah anda ingin menghapus pesanan ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $countSubtotal += $cart->price;
                                @endphp
                                @if (!$loop->last)
                                    <hr class="h-px my-4 border-0 bg-gray-400">
                                @else
                                @endif
                            @endforeach
                        @else
                            <div class="flex flex-col items-center justify-center">
                                <h1 class="text-center text-xl font-bold text-gray-400 dark:text-gray-400">Keranjang
                                    anda kosong</h1>
                                <a href="/products">
                                    <p class="text-center text-base font-normal text-yellow-500">Belanja sekarang!</p>
                                </a>
                            </div>
                        @endif
                    </div>
                    @if ($countSubtotal)
                        <hr class="h-px my-7 border-2 border-yellow-500">
                        <div class="flex flex-row justify-between items-center">
                            <p class="text-lg font-medium text-white">
                                Subtotal:
                            </p>
                            <p class="text-lg font-medium text-white">
                                Rp. {{ number_format($countSubtotal, 0, ',', '.') }}
                            </p>
                        </div>
                        <p class="text-sm font-normal text-gray-400">
                            Ongkos kirim ditambahkan ketika checkout.
                        </p>
                        <form action="/checkout" method="GET">
                            <button type="submit"
                                class="cursor-pointer mt-7 w-full text-white bg-yellow-500 hover:bg-yellow-600 font-medium rounded-lg text-base px-5 py-2.5 text-center items-center">
                                Checkout
                            </button>
                        </form>
                        <a href="/products" class="mt-3 flex flex-row justify-center items-center w-full">
                            <p class="text-sm font-normal text-gray-400">
                                atau <span class="text-yellow-500">Lanjut Belanja</span>
                            </p>
                            <svg class="ml-1 w-4 h-4 text-yellow-500" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    @endif
                </div>

                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="">
                            <a class="nav-link text-white" href="{{ route('login') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>

            <button data-collapse-toggle="navbar-sticky" type="button"
                class="cursor-pointer ml-4 inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul
                class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-900 md:dark:bg-gray-900 dark:border-gray-900">

                <li>
                    <a href="/"
                        class="block py-2 pl-3 pr-4 {{ $active_1 ?? 'text-gray-800 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-yellow-500 md:p-0 md:dark:hover:text-yellow-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }}">Home</a>
                </li>

                <li>
                    <a href="/products"
                        class="block py-2 pl-3 pr-4 {{ $active_2 ?? 'text-gray-800 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-yellow-500 md:p-0 md:dark:hover:text-yellow-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }}"
                        aria-current="page">Products</a>
                </li>

                <li>
                    <a href="/about_us"
                        class="block py-2 pl-3 pr-4 {{ $active_3 ?? 'text-gray-800 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-yellow-500 md:p-0 md:dark:hover:text-yellow-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }}">About
                        Us</a>
                </li>

                <li>
                    <a href="/gallery"
                        class="block py-2 pl-3 pr-4 {{ $active_4 ?? 'text-gray-800 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-yellow-500 md:p-0 md:dark:hover:text-yellow-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }}">Gallery</a>
                </li>

                <li>
                    <a href="/contact_us"
                        class="block py-2 pl-3 pr-4 {{ $active_5 ?? 'text-gray-800 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-yellow-500 md:p-0 md:dark:hover:text-yellow-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }}">Contact
                        Us</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
