@extends('layouts.admin.frame_admin')

@section('content_page')
    <!-- Start block -->
    <section class="bg-neutral-200 p-2 sm:p-4 antialiased">
        <div class="bg-neutral-200 mx-auto max-w-screen-2xl pt-24 sm:ml-56">
            <div class="bg-white relative shadow-md rounded-md sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="flex-1 flex items-center space-x-2">
                        <h5>
                            <span class="text-gray-500">Semua Order:</span>
                            <span class="text-gray-500">{{ $totalOrders }}</span>
                        </h5>
                    </div>
                    <div class="text-lg font-bold text-gray-800">
                        Daftar Order Hari Ini dan Kemarin
                    </div>
                </div>
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t">
                    <div class="flex flex-col lg:flex-row justify-between w-full">
                        <form class="flex items-center"
                            action="@if (Auth::user()->isOwner()) {{ route('owner.admin') }}                                                 @elseif (Auth::user()->isAdmin())
                                @else {{ route('admin.admin') }} @endif"
                            method="GET">

                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor"
                                        viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
                                    </svg>
                                </div>
                                <input type="search" name="search" id="simple-search" placeholder="Cari order"
                                    required=""
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2">
                            </div>

                            <button type="submit" class="bg-yellow-500 ml-2 p-2 rounded-lg text-sm">
                                <p class="font-semibold text-white px-2">Search</p>
                            </button>
                        </form>

                        <span
                            class="mt-2 lg:mt-0 flex flex-row justify-center items-center bg-green-300 text-green-900 text-sm text-center font-medium px-3 py-2 rounded-full">
                            <span class="w-2 h-2 me-2 bg-green-500 rounded-full"></span>
                            Total Penjualan: Rp.{{ number_format($orders->sum('total_price'), 0, ',', '.') }}
                        </span>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-center text-gray-500">
                        <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="p-4">No.</th>
                                <th scope="col" class="p-4">Customer</th>
                                <th scope="col" class="p-4 text-yellow-500">Cek</th>
                                <th scope="col" class="p-4">Masuk</th>
                                <th scope="col" class="p-4">Dikirim</th>
                                <th scope="col" class="p-4">Sampai</th>
                                <th scope="col" class="p-4">No Telp</th>
                                <th scope="col" class="p-4">Alamat</th>
                                <th scope="col" class="p-4">Pembayaran</th>
                                <th scope="col" class="p-4">Struk</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($orders->count() == 0)
                                <tr>
                                    <td colspan="20" class="p-4 text-center">
                                        <p class="text-gray-400">Belum ada order</p>
                                    </td>
                                </tr>
                            @else
                                @foreach ($orders as $order)
                                    <tr class="border-b hover:bg-gray-100">
                                        <td class="p-4 w-4">
                                            {{ $orderNumber }}
                                        </td>
                                        <td scope="row" class="pe-12 lg:pe-0 font-medium text-gray-900">
                                            <div class="ml-4 flex items-center w-full">
                                                @if ($order->user->profile_picture == null)
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-8 h-8 mr-3 rounded-full text-gray-700">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                @elseif (strlen($order->user->profile_picture) > 25)
                                                    <img src="{{ asset('storage/' . $order->user->profile_picture) }}"
                                                        alt="profile picture"
                                                        class="w-8 h-8 mr-3 object-cover object-center rounded-full">
                                                @else
                                                    <img src="/images/profile_picture/{{ $order->user->profile_picture }}"
                                                        alt="profile picture"
                                                        class="w-8 h-8 mr-3 object-cover object-center rounded-full">
                                                @endif
                                                <div class="text-left">
                                                    {{ $order->user->name }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="font-medium text-gray-900 whitespace-nowrap">
                                            <div class="flex justify-center items-center space-x-2">
                                                <button type="button" data-drawer-target="order-detail{{ $order->id }}"
                                                    data-drawer-show="order-detail{{ $order->id }}"
                                                    aria-controls="order-detail{{ $order->id }}"
                                                    class="py-2 px-3 flex items-center text-sm font-medium text-center text-gray-600 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24"
                                                        fill="currentColor" class="w-4 h-4 mr-2 -ml-0.5">
                                                        <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                                    </svg>
                                                    Detail
                                                </button>

                                                @if ($order->user_id == 1 || $order->user_id == 2)
                                                    <button type="button"
                                                        data-modal-target="update-modal{{ $order->id }}"
                                                        data-modal-toggle="update-modal{{ $order->id }}"
                                                        class="py-2 px-3 flex items-center text-sm font-medium text-center text-white focus:outline-none bg-gray-300 rounded-lg hover:bg-gray-300 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-300"
                                                        disabled>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5"
                                                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path
                                                                d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                            <path fill-rule="evenodd"
                                                                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Edit
                                                    </button>
                                                @else
                                                    <button type="button"
                                                        data-modal-target="update-modal{{ $order->id }}"
                                                        data-modal-toggle="update-modal{{ $order->id }}"
                                                        class="py-2 px-3 flex items-center text-sm font-medium text-center text-gray-600 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-4 w-4 mr-2 -ml-0.5" viewBox="0 0 20 20"
                                                            fill="currentColor" aria-hidden="true">
                                                            <path
                                                                d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                            <path fill-rule="evenodd"
                                                                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Edit
                                                    </button>
                                                @endif
                                            </div>
                                        </td>

                                        @if ($order->acceptbyAdmin_status == 'sudah')
                                            <td class="font-medium text-green-400 whitespace-nowrap">
                                                Sudah</td>
                                        @else
                                            <td class="font-medium text-red-700 whitespace-nowrap">
                                                Pending</td>
                                        @endif

                                        @if ($order->shipment_status == 'sudah')
                                            <td class="font-medium text-green-400 whitespace-nowrap">
                                                Sudah</td>
                                        @else
                                            <td class="font-medium text-red-700 whitespace-nowrap">
                                                Pending</td>
                                        @endif

                                        @if ($order->acceptbyCustomer_status == 'sudah')
                                            <td class="font-medium text-green-400 whitespace-nowrap">
                                                Sudah</td>
                                        @else
                                            <td class="font-medium text-red-700 whitespace-nowrap">
                                                Pending</td>
                                        @endif

                                        <td class="font-medium text-gray-900 whitespace-nowrap">
                                            {{ substr($order->user->phone_number, 0, 4) . '-' . substr($order->user->phone_number, 4, 4) . '-' . substr($order->user->phone_number, 8) }}
                                        </td>

                                        <td class="px-3 lg:px-0">
                                            @if ($order->user_id == 1 || $order->user_id == 2)
                                                <div class="flex justify-center">
                                                    <button type="button" data-modal-target="address-modal"
                                                        data-modal-toggle="address-modal"
                                                        class="py-2 px-3 flex items-center text-sm font-medium text-center text-white focus:outline-none bg-gray-300 rounded-lg hover:bg-gray-300 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-300"
                                                        disabled>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24"
                                                            fill="currentColor" class="w-4 h-4 mr-2 -ml-0.5">
                                                            <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                                        </svg>
                                                        Alamat
                                                    </button>
                                                </div>
                                            @else
                                                <div class="flex justify-center">
                                                    <button type="button" data-modal-target="address-modal"
                                                        data-modal-toggle="address-modal"
                                                        class="py-2 px-3 flex items-center text-sm font-medium text-center text-gray-600 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24"
                                                            fill="currentColor" class="w-4 h-4 mr-2 -ml-0.5">
                                                            <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                                        </svg>
                                                        Alamat
                                                    </button>
                                                </div>
                                            @endif
                                        </td>

                                        <div id="address-modal" tabindex="-1" aria-hidden="true"
                                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                            <div class="relative p-4 w-full max-w-3xl h-full md:h-auto">
                                                <!-- Modal content -->
                                                <div id="update-modal-content"
                                                    class="relative p-4 bg-white rounded-lg shadow sm:p-5">
                                                    <!-- Modal header -->
                                                    <div
                                                        class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                                                        <div class="flex items-center mr-3">
                                                            @if ($order->user->profile_picture == null)
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor"
                                                                    class="w-8 h-8 mr-3 rounded-full text-gray-700">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                </svg>
                                                            @elseif (strlen($order->user->profile_picture) > 25)
                                                                <img src="{{ asset('storage/' . $order->user->profile_picture) }}"
                                                                    alt="profile picture"
                                                                    class="w-8 h-8 mr-3 object-cover object-center rounded-full">
                                                            @else
                                                                <img src="/images/profile_picture/{{ $order->user->profile_picture }}"
                                                                    alt="profile picture"
                                                                    class="w-8 h-8 mr-3 object-cover object-center rounded-full">
                                                            @endif
                                                            @if ($order->user_id == 1 || $order->user_id == 2)
                                                                <h3 class="text-lg font-semibold text-gray-900">
                                                                    Cashier</h3>
                                                            @else
                                                                <h3 class="text-lg font-semibold text-gray-900">
                                                                    Alamat a.n. {{ $order->user->name }}</h3>
                                                            @endif
                                                        </div>
                                                        <button type="button"
                                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                                            data-modal-toggle="address-modal">
                                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd"
                                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    @if ($order->user->address->isNotEmpty())
                                                        {{ $order->user->address->first()->address }},
                                                        {{ $order->user->address->first()->city }},
                                                        {{ $order->user->address->first()->province }},
                                                        {{ $order->user->address->first()->postal_code }}
                                                        </td>
                                                    @else
                                                        Alamat belum diisi
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <td class="px-3 lg:px-0">
                                            <div class="flex justify-center">
                                                <button type="button" data-modal-target="payment{{ $order->id }}"
                                                    data-modal-toggle="payment{{ $order->id }}"
                                                    class="py-2 px-3 flex items-center text-sm font-medium text-center text-gray-600 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24"
                                                        fill="currentColor" class="w-4 h-4 mr-2 -ml-0.5">
                                                        <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                                    </svg>
                                                    Pembayaran
                                                </button>
                                            </div>
                                        </td>
                                        <td class="px-3 lg:px-0">
                                            @if ($order->user_id == 1 || $order->user_id == 2)
                                                <div class="flex justify-center">
                                                    @if (Auth::user()->isAdmin())
                                                        <form action="{{ route('admin.printStrukOrder', $order->id) }}"
                                                            method="GET">
                                                            @csrf
                                                            <button
                                                                class="py-2 px-3 flex items-center text-sm font-medium text-center text-white focus:outline-none bg-green-500 rounded-lg hover:bg-green-600 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-green-600">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    viewbox="0 0 24 24" fill="currentColor"
                                                                    class="w-4 h-4 mr-2 -ml-0.5">
                                                                    <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                                                </svg>
                                                                Cetak
                                                            </button>
                                                        </form>
                                                    @endif
                                                    @if (Auth::user()->isOwner())
                                                        <form action="{{ route('owner.printStrukOrder', $order->id) }}"
                                                            method="GET">
                                                            @csrf
                                                            <button
                                                                class="py-2 px-3 flex items-center text-sm font-medium text-center text-white focus:outline-none bg-green-500 rounded-lg hover:bg-green-600 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-green-600">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    viewbox="0 0 24 24" fill="currentColor"
                                                                    class="w-4 h-4 mr-2 -ml-0.5">
                                                                    <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                                                </svg>
                                                                Cetak
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            @else
                                                <div class="flex justify-center">
                                                    @if (Auth::user()->isAdmin())
                                                        <form action="{{ route('admin.printStrukOrder', $order->id) }}"
                                                            method="GET">
                                                            @csrf
                                                            <button
                                                                class="py-2 px-3 flex items-center text-sm font-medium text-center text-white focus:outline-none bg-gray-300 rounded-lg hover:bg-gray-300 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-300"
                                                                disabled>
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    viewbox="0 0 24 24" fill="currentColor"
                                                                    class="w-4 h-4 mr-2 -ml-0.5">
                                                                    <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                                                </svg>
                                                                Cetak
                                                            </button>
                                                        </form>
                                                    @endif
                                                    @if (Auth::user()->isOwner())
                                                        <form action="{{ route('owner.printStrukOrder', $order->id) }}"
                                                            method="GET">
                                                            @csrf
                                                            <button
                                                                class="py-2 px-3 flex items-center text-sm font-medium text-center text-white focus:outline-none bg-gray-300 rounded-lg hover:bg-gray-300 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-300"
                                                                disabled>
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    viewbox="0 0 24 24" fill="currentColor"
                                                                    class="w-4 h-4 mr-2 -ml-0.5">
                                                                    <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                                                </svg>
                                                                Cetak
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            @endif
                                        </td>
                                    </tr>


                                    <!-- drawer component -->

                                    @include('admin.order_preview')


                                    <div id="update-modal{{ $order->id }}" tabindex="-1" aria-hidden="true"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                        <div class="relative p-4 w-full max-w-3xl h-full md:h-auto">
                                            <!-- Modal content -->
                                            <div id="update-modal-content"
                                                class="relative p-4 bg-white rounded-lg shadow sm:p-5">
                                                <!-- Modal header -->

                                                <div
                                                    class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                                                    <div class="flex items-center mr-3">
                                                        @if ($order->user->profile_picture == null)
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor"
                                                                class="w-8 h-8 mr-3 rounded-full text-gray-700">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            </svg>
                                                        @elseif (strlen($order->user->profile_picture) > 25)
                                                            <img src="{{ asset('storage/' . $order->user->profile_picture) }}"
                                                                alt="profile picture"
                                                                class="w-8 h-8 mr-3 object-cover object-center rounded-full">
                                                        @else
                                                            <img src="/images/profile_picture/{{ $order->user->profile_picture }}"
                                                                alt="profile picture"
                                                                class="w-8 h-8 mr-3 object-cover object-center rounded-full">
                                                        @endif
                                                        @if ($order->user_id == 1 || $order->user_id == 2)
                                                            <h3 class="text-lg font-semibold text-gray-900">
                                                                Cashier</h3>
                                                        @else
                                                            <h3 class="text-lg font-semibold text-gray-900">
                                                                Order a.n. {{ $order->user->name }}</h3>
                                                        @endif
                                                    </div>
                                                    <button type="button"
                                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                                        data-modal-toggle="update-modal{{ $order->id }}">
                                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                            viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->

                                                @if (Auth::user()->isOwner())
                                                    <form id="update-form"
                                                        action="{{ route('owner.admin.update', $order) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @method('put')
                                                        @csrf
                                                    @elseif (Auth::user()->isAdmin())
                                                        <form id="update-form"
                                                            action="{{ route('admin.admin.update', $order) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @method('put')
                                                            @csrf
                                                @endif

                                                <div class="flex flex-col mb-8">
                                                    <p class="text-center font-semibold col-span-3 mb-2">Order Status
                                                    </p>

                                                    <div class="flex flex-row justify-center w-full space-x-4 mb-6">
                                                        <div>
                                                            <label for="acceptbyAdmin_status"
                                                                class="block mb-2 text-sm font-medium text-gray-900">Order
                                                                Masuk</label>
                                                            <select name="acceptbyAdmin_status" id="acceptbyAdmin_status"
                                                                class="{{ $errors->has('acceptbyAdmin_status') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400 focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm mt-3 block w-full p-2.5"
                                                                required>
                                                                <option class="text-red-700" value="pending"
                                                                    {{ $order->acceptbyAdmin_status === 'pending' ? 'selected' : '' }}>
                                                                    Pending
                                                                </option>
                                                                <option class="text-green-400" value="sudah"
                                                                    {{ $order->acceptbyAdmin_status === 'sudah' ? 'selected' : '' }}>
                                                                    Sudah
                                                                </option>
                                                            </select>
                                                            @error('acceptbyAdmin_status')
                                                                <p class="mt-2 text-sm text-red-500"><span
                                                                        class="font-medium">{{ $message }}
                                                                </p>
                                                            @enderror
                                                        </div>

                                                        <div>
                                                            <label for="shipment_status"
                                                                class="block mb-2 text-sm font-medium text-gray-900">Dikirim
                                                                Kurir</label>
                                                            <select name="shipment_status" id="shipment_status"
                                                                class="{{ $errors->has('shipment_status') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm mt-3 block w-full p-2.5"
                                                                required>
                                                                <option class="text-red-700" value="pending"
                                                                    {{ $order->shipment_status === 'pending' ? 'selected' : '' }}>
                                                                    Pending</option>
                                                                <option class="text-green-400" value="sudah"
                                                                    {{ $order->shipment_status === 'sudah' ? 'selected' : '' }}>
                                                                    Sudah</option>
                                                            </select>
                                                            @error('shipment_status')
                                                                <p class="mt-2 text-sm text-red-500"><span
                                                                        class="font-medium">{{ $message }}
                                                                </p>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <p class="mb-2 text-center font-semibold col-span-3">Tanggal</p>

                                                    <div
                                                        class="flex flex-row justify-center items-center w-full space-x-4">
                                                        <div>
                                                            <label
                                                                for="order_date"class="block mb-2 text-sm font-medium text-gray-900">Order
                                                                Masuk</label>
                                                            <p
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                                                {{ $order->order_date }}</p>
                                                        </div>

                                                        <div>
                                                            <label for="shipment_date"
                                                                class="block mb-2 text-sm font-medium text-gray-900">Order
                                                                Dikirim</label>
                                                            <input type="datetime-local" name="shipment_date"
                                                                id="shipment_date"
                                                                class="{{ $errors->has('shipment_date') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm block w-full p-2.5"
                                                                value="{{ $order->shipment_date ? \Carbon\Carbon::parse($order->shipment_date)->format('Y-m-d\TH:i') : '' }}">
                                                            @error('shipment_date')
                                                                <p class="mt-2 text-sm text-red-500"><span
                                                                        class="font-medium">{{ $message }}
                                                                </p>
                                                            @enderror
                                                        </div>

                                                        <div>
                                                            <label for="arrived_date"
                                                                class="block mb-2 text-sm font-medium text-gray-900">Order
                                                                Sampai</label>
                                                            <input type="datetime-local" name="arrived_date"
                                                                id="arrived_date"
                                                                class="{{ $errors->has('arrived_date') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm block w-full p-2.5"
                                                                value="{{ $order->arrived_date ? \Carbon\Carbon::parse($order->arrived_date)->format('Y-m-d\TH:i') : '' }}">
                                                            @error('arrived_date')
                                                                <p class="mt-2 text-sm text-red-500"><span
                                                                        class="font-medium">{{ $message }}
                                                                </p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="items-center space-y-4 sm:flex sm:space-y-0 sm:space-x-2">
                                                    <button type="submit"
                                                        class="w-full sm:w-auto justify-center text-white inline-flex bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update
                                                        Order</button>

                                                    <button data-modal-toggle="update-modal{{ $order->id }}"
                                                        type="button"
                                                        class="w-full justify-center sm:w-auto text-white inline-flex items-center bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 focus:z-10">
                                                        <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor"
                                                            viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Batal
                                                    </button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="payment{{ $order->id }}" tabindex="-1" aria-hidden="true"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                        <div class="relative p-4 w-full max-w-3xl h-full md:h-auto">
                                            <!-- Modal content -->
                                            <div id="update-modal-content"
                                                class="relative p-4 bg-white rounded-lg shadow sm:p-5">
                                                <!-- Modal header -->

                                                <div
                                                    class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                                                    <div class="flex items-center mr-3">
                                                        @if ($order->user->profile_picture == null)
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor"
                                                                class="w-8 h-8 mr-3 rounded-full text-gray-700">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            </svg>
                                                        @elseif (strlen($order->user->profile_picture) > 25)
                                                            <img src="{{ asset('storage/' . $order->user->profile_picture) }}"
                                                                alt="profile picture"
                                                                class="w-8 h-8 mr-3 object-cover object-center rounded-full">
                                                        @else
                                                            <img src="/images/profile_picture/{{ $order->user->profile_picture }}"
                                                                alt="profile picture"
                                                                class="w-8 h-8 mr-3 object-cover object-center rounded-full">
                                                        @endif
                                                        @if ($order->user_id == 1 || $order->user_id == 2)
                                                            <h3 class="text-lg font-semibold text-gray-900">
                                                                Cashier</h3>
                                                        @else
                                                            <h3 class="text-lg font-semibold text-gray-900">
                                                                Pembayaran a.n. {{ $order->user->name }}</h3>
                                                        @endif
                                                    </div>
                                                    <button type="button"
                                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                                        data-modal-toggle="payment{{ $order->id }}">
                                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                            viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->

                                                @if ($order->payment != null || $order->payment != '')
                                                    @if ($order->payment == 'paidcash')
                                                        <img src="/images/paidcash_indicator.png" alt="Cash Payment"
                                                            class="mt-3 w-96 mx-auto rounded-lg object-cover">
                                                    @else
                                                        <img src="{{ asset('storage/' . $order->payment) }}"
                                                            alt="{{ asset('storage/' . $order->payment) }}"
                                                            class="mt-3 w-96 mx-auto rounded-lg object-cover">
                                                    @endif
                                                @else
                                                    <p class="mt-3 text-red-700 text-center font-semibold text-gray-900">
                                                        Belum ada bukti pembayaran</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $orderNumber++;
                                    @endphp
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <nav class="flex flex-col md:flex-row justify-end items-center space-y-3 md:space-y-0 p-4"
                    aria-label="Table navigation">

                    {{ $orders->links('vendor.pagination.tailwind') }}

                </nav>
            </div>
        </div>
    </section>
    <!-- End block -->
@endsection
