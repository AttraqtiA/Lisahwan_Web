<nav class="fixed top-0 z-50 w-full border-b bg-gray-900 border-gray-700">
    <div class="px-4 md:px-8 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a href="/" class="flex items-center">
                    <img src="/images/lisahwan_logo.crdownload" class="ml-3 md:ml-0 w-16" alt="Lisahwan Logo" />
                </a>
            </div>

            <h1 class="text-base md:text-2xl ml-4 md:ml-0 font-semibold text-yellow-500">Apa kabar,
                {{ Auth::user()->name }}!</h1>

            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    @guest
                        <div>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring focus:ring-gray-500"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-10 h-10 rounded-full text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow"
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900" role="none">
                                    Segera daftarkan diri anda!
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="{{ route('register') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">Daftar</a>
                                </li>
                                <li>
                                    <a href="{{ route('login') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">Masuk</a>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring focus:ring-gray-500"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                @if (Auth::user()->profile_picture == null)
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-10 h-10 rounded-full text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                @elseif (Auth::user()->isAdmin() || Auth::user()->isOwner())
                                    <img class="w-10 h-10 rounded-full object-cover"
                                        src="{{ asset('images/' . Auth::user()->profile_picture) }}" alt="user photo">
                                @else
                                    <img class="w-10 h-10 rounded-full object-cover"
                                        src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="user photo">
                                @endif
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow"
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                @if (Auth::user()->isOwner())
                                    <p class="text-sm text-gray-900" role="none">
                                        Selamat datang kembali, Owner!
                                    </p>
                                @elseif (Auth::user()->isAdmin())
                                    <p class="text-sm text-gray-900" role="none">
                                        Selamat datang kembali, Admin!
                                    </p>
                                @else
                                    <p class="text-sm text-gray-900" role="none">
                                        Sudahkah nyemil Lisahwan hari ini?
                                    </p>
                                @endif
                                <br>
                                <p class="text-sm text-gray-900" role="none">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate" role="none">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                        Keluar
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</nav>

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-56 h-screen pt-24 transition-transform -translate-x-full border-r sm:translate-x-0 bg-gray-900 border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-900">
        <ul class="space-y-2 font-medium">
            @auth
                @if (Auth::user()->isOwner())
                    <li>
                        <a href="{{ route('owner.admin') }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-700 group">
                            <svg class="{{ $active_1 ?? 'text-gray-500' }} flex-shrink-0 w-5 h-5 transition duration-75 group-hover:{{ $active_1 ?? 'text-gray-100' }}"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm14-7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-5-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-5-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4Z" />
                            </svg>
                            <span class="text-gray-100 flex-1 ms-3 whitespace-nowrap {{ $active_1 ?? '' }}">Order
                                Today</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('owner.order_history') }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-700 group">
                            <svg class="{{ $active_2 ?? 'text-gray-500' }} flex-shrink-0 w-5 h-5 transition duration-75 group-hover:{{ $active_2 ?? 'text-gray-100' }}"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 18 18">
                                <path
                                    d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                            </svg>
                            <span class="text-gray-100 flex-1 ms-3 whitespace-nowrap {{ $active_2 ?? '' }}">Order
                                History</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('owner.admin_products') }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-700 group">
                            <svg class="{{ $active_3 ?? 'text-gray-500' }} flex-shrink-0 w-5 h-5 transition duration-75 group-hover:{{ $active_3 ?? 'text-gray-100' }}"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 18 20">
                                <path
                                    d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                            </svg>
                            <span
                                class="text-gray-100 flex-1 ms-3 whitespace-nowrap {{ $active_3 ?? '' }}">Products</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('owner.admin_users') }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-700 group">
                            <svg class="{{ $active_4 ?? 'text-gray-500' }} flex-shrink-0 w-5 h-5 transition duration-75 group-hover:{{ $active_4 ?? 'text-gray-100' }}"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 18">
                                <path
                                    d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                            </svg>
                            <span class="text-gray-100 flex-1 ms-3 whitespace-nowrap {{ $active_4 ?? '' }}">Users</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->isAdmin())
                    <li>
                        <a href="{{ route('admin.admin') }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-700 group">
                            <svg class="{{ $active_1 ?? 'text-gray-500' }} flex-shrink-0 w-5 h-5 transition duration-75 group-hover:{{ $active_1 ?? 'text-gray-100' }}"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 18 18">
                                <path
                                    d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                            </svg>
                            <span class="text-gray-100 flex-1 ms-3 whitespace-nowrap {{ $active_1 ?? '' }}">Order
                                Today</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.order_history') }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-700 group">
                            <svg class="{{ $active_2 ?? 'text-gray-500' }} flex-shrink-0 w-5 h-5 transition duration-75 group-hover:{{ $active_2 ?? 'text-gray-100' }}"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 18 18">
                                <path
                                    d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                            </svg>
                            <span class="text-gray-100 flex-1 ms-3 whitespace-nowrap {{ $active_2 ?? '' }}">Order
                                History</span>
                        </a>
                    </li>
                @endif
            @endauth
            <li>
                <a href="/" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-700 group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-100">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
                    </svg>
                    <span class="text-gray-100 flex-1 ms-3 whitespace-nowrap">Website</span>
                </a>
            </li>

        </ul>
    </div>
</aside>
