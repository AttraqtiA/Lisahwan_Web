@extends('layouts.admin.frame_admin')

@section('content_page')

    <!-- Start block -->
    <section class="bg-neutral-200 p-2 sm:p-4 antialiased h-full">
        <div class="mx-auto max-w-screen-2xl pt-24 sm:ml-56">
            <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="flex-1 flex items-center space-x-2">
                        <h5>
                            <span class="text-gray-500">All Orders:</span>
                            <span class="text-gray-500">{{ $orders->count() }}</span>
                        </h5>
                        <h5 class="text-gray-500 ml-1">(1-{{ (int) ceil($orders->count() / 10) }})</h5>
                        <button type="button" class="group" data-tooltip-target="results-tooltip">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 text-gray-400 group-hover:text-gray-900" viewbox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">More info</span>
                        </button>
                        <div id="results-tooltip" role="tooltip"
                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                            Showing 1-20 of 50 results
                            <div class="tooltip-arrow" data-popper-arrow=""></div>
                        </div>
                    </div>
                    <div
                        class="flex-shrink-0 flex flex-col items-start md:flex-row md:items-center lg:justify-end space-y-3 md:space-y-0 md:space-x-3">
                        <button type="button"
                            class="flex-shrink-0 inline-flex items-center justify-center py-2 px-3 text-xs font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor"
                                class="mr-2 w-4 h-4" aria-hidden="true">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.828 2.25c-.916 0-1.699.663-1.85 1.567l-.091.549a.798.798 0 01-.517.608 7.45 7.45 0 00-.478.198.798.798 0 01-.796-.064l-.453-.324a1.875 1.875 0 00-2.416.2l-.243.243a1.875 1.875 0 00-.2 2.416l.324.453a.798.798 0 01.064.796 7.448 7.448 0 00-.198.478.798.798 0 01-.608.517l-.55.092a1.875 1.875 0 00-1.566 1.849v.344c0 .916.663 1.699 1.567 1.85l.549.091c.281.047.508.25.608.517.06.162.127.321.198.478a.798.798 0 01-.064.796l-.324.453a1.875 1.875 0 00.2 2.416l.243.243c.648.648 1.67.733 2.416.2l.453-.324a.798.798 0 01.796-.064c.157.071.316.137.478.198.267.1.47.327.517.608l.092.55c.15.903.932 1.566 1.849 1.566h.344c.916 0 1.699-.663 1.85-1.567l.091-.549a.798.798 0 01.517-.608 7.52 7.52 0 00.478-.198.798.798 0 01.796.064l.453.324a1.875 1.875 0 002.416-.2l.243-.243c.648-.648.733-1.67.2-2.416l-.324-.453a.798.798 0 01-.064-.796c.071-.157.137-.316.198-.478.1-.267.327-.47.608-.517l.55-.091a1.875 1.875 0 001.566-1.85v-.344c0-.916-.663-1.699-1.567-1.85l-.549-.091a.798.798 0 01-.608-.517 7.507 7.507 0 00-.198-.478.798.798 0 01.064-.796l.324-.453a1.875 1.875 0 00-.2-2.416l-.243-.243a1.875 1.875 0 00-2.416-.2l-.453.324a.798.798 0 01-.796.064 7.462 7.462 0 00-.478-.198.798.798 0 01-.517-.608l-.091-.55a1.875 1.875 0 00-1.85-1.566h-.344zM12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z" />
                            </svg>
                            Table settings
                        </button>
                    </div>
                </div>
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t">
                    <div class="w-full md:w-1/3">
                        @if (Auth::user()->isOwner())
                            <form class="flex items-center" action="{{ route('owner.order_history') }}" method="GET">
                            @elseif (Auth::user()->isAdmin())
                                <form class="flex items-center" action="{{ route('admin.order_history') }}" method="GET">
                        @endif
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor"
                                    viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
                                </svg>
                            </div>
                            <input type="search" name="search" id="simple-search" placeholder="Cari order" required=""
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2">
                        </div>

                        <button type="submit" class="bg-yellow-500 ml-2 p-2 rounded-lg text-sm">
                            <p class="font-semibold text-white px-2">Search</p>
                        </button>

                        </form>
                    </div>
                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <button type="button" id="createProductButton" data-modal-toggle="createProductModal"
                            class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none">
                            <svg class="h-3.5 w-3.5 mr-1.5 -ml-1" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>

                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-all" type="checkbox"
                                            class="w-4 h-4 text-primary-600 bg-gray-100 rounded border-gray-300 focus:ring-primary-500 focus:ring-2">
                                        <label for="checkbox-all" class="sr-only">checkbox</label>
                                    </div>
                                </th>
                                <th scope="col" class="p-4">Customer</th>

                                <th scope="col" class="p-4"></th>

                                <th scope="col" class="p-4">Masuk</th>
                                <th scope="col" class="p-4">Tanggal</th>
                                <th scope="col" class="p-4">Dikirim</th>
                                <th scope="col" class="p-4">Tanggal</th>
                                <th scope="col" class="p-4">Sampai</th>
                                <th scope="col" class="p-4">Tanggal</th>
                                <th scope="col" class="p-4">Total harga</th>
                                <th scope="col" class="p-4">Payment</th>
                                <th scope="col" class="p-4">Print</th>
                                <th scope="col" class="p-4">No Telp</th>
                                <th scope="col" class="p-4 max-w-20">Alamat</th>
                                <th scope="col" class="p-4">Note</th>

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
                                            <div class="flex items-center">
                                                <input id="checkbox-table-search-1" type="checkbox"
                                                    onclick="event.stopPropagation()"
                                                    class="w-4 h-4 text-primary-600 bg-gray-100 rounded border-gray-300 focus:ring-primary-500 focus:ring-2">
                                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                            </div>
                                        </td>
                                        <td scope="row"
                                            class="mr-4 px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                            <div class="flex items-center mr-3">
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

                                                <p>{{ $order->user->name }}</p>
                                            </div>
                                        </td>


                                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                            <div class="flex items-center space-x-4">

                                                <button type="button"
                                                    data-drawer-target="order-detail{{ $order->id }}"
                                                    data-drawer-show="order-detail{{ $order->id }}"
                                                    aria-controls="order-detail{{ $order->id }}"
                                                    class="ml-4 py-2 px-3 flex items-center text-sm font-medium text-center text-gray-600 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24"
                                                        fill="currentColor" class="w-4 h-4 mr-2 -ml-0.5">
                                                        <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                                    </svg>
                                                    Detail
                                                </button>

                                                <button type="button"
                                                    data-modal-target="update-modal{{ $order->id }}"
                                                    data-modal-toggle="update-modal{{ $order->id }}"
                                                    class="py-2 px-3 flex items-center text-sm font-medium text-center text-gray-700 bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300">
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


                                            </div>
                                        </td>

                                        @if ($order->acceptbyAdmin_status == 'sudah')
                                            <td class="px-4 py-3 font-medium text-green-400 whitespace-nowrap">
                                                Sudah</td>
                                        @else
                                            <td class="px-4 py-3 font-medium text-red-700 whitespace-nowrap">
                                                Pending</td>
                                        @endif

                                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $order->order_date }}</td>

                                        @if ($order->shipment_status == 'sudah')
                                            <td class="px-4 py-3 font-medium text-green-400 whitespace-nowrap">
                                                Sudah</td>
                                        @else
                                            <td class="px-4 py-3 font-medium text-red-700 whitespace-nowrap">
                                                Pending</td>
                                        @endif

                                        @if ($order->shipment_date != null)
                                            <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $order->shipment_date }}</td>
                                        @else
                                            <td class="px-4 py-3 font-medium text-red-700 whitespace-nowrap">
                                                ----</td>
                                        @endif

                                        @if ($order->acceptbyCustomer_status == 'sudah')
                                            <td class="px-4 py-3 font-medium text-green-400 whitespace-nowrap">
                                                Sudah</td>
                                        @else
                                            <td class="px-4 py-3 font-medium text-red-700 whitespace-nowrap">
                                                Pending</td>
                                        @endif

                                        @if ($order->arrived_date != null)
                                            <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $order->arrived_date }}</td>
                                        @else
                                            <td class="px-4 py-3 font-medium text-red-700 whitespace-nowrap">
                                                ----</td>
                                        @endif

                                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                            Rp. {{ number_format($order->total_price, 0, ',', '.') }}</td>

                                        <td>
                                            <button type="button" data-modal-target="payment{{ $order->id }}"
                                                data-modal-toggle="payment{{ $order->id }}"
                                                class="ml-4 py-2 px-3 flex items-center text-sm font-medium text-center text-gray-600 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24"
                                                    fill="currentColor" class="w-4 h-4 mr-2 -ml-0.5">
                                                    <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                                </svg>
                                                Payment
                                            </button>
                                        </td>


                                        @if ($order->is_print == 'sudah')
                                            <td class="px-4 py-3 font-medium text-green-400 whitespace-nowrap">
                                                Sudah</td>
                                        @else
                                            <td class="px-4 py-3 font-medium text-red-700 whitespace-nowrap">
                                                Pending</td>
                                        @endif

                                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                            {{ substr($order->user->phone_number, 0, 4) . '-' . substr($order->user->phone_number, 4, 4) . '-' . substr($order->user->phone_number, 8) }}
                                        </td>

                                        @if ($order->user->address->isNotEmpty())
                                            <td
                                                class="max-w-24 overflow-hidden hover:max-w-full overflow-ellipsis px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $order->user->address->first()->address }},
                                                {{ $order->user->address->first()->city }},
                                                {{ $order->user->address->first()->province }},
                                                {{ $order->user->address->first()->postal_code }}
                                            </td>
                                        @else
                                            <td class="max-w-20 px-4 py-3 font-medium text-red-700 whitespace-nowrap">
                                                Alamat belum diisi
                                            </td>
                                        @endif


                                        <td
                                            class="max-w-24 overflow-hidden hover:max-w-full overflow-ellipsis px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $order->note }}</td>

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
                                                        <h3 class="text-lg font-semibold text-gray-900">
                                                            Order untuk customer: {{ $order->user->name }}</h3>
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

                                                <form id="update-form"
                                                    action="{{ route('owner.order_history.update', $order) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @method('put')
                                                    @csrf

                                                    <div class="grid gap-4 mb-4 grid-cols-3">
                                                        <p class="text-center font-semibold col-span-3">Order Status</p>

                                                        <div>
                                                            <label for="acceptbyAdmin_status"
                                                                class="block mb-2 text-sm font-medium text-gray-900">Order
                                                                Masuk</label>
                                                            <select name="acceptbyAdmin_status" id="acceptbyAdmin_status"
                                                                class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                                required>
                                                                <option class="text-red-700" value="pending"
                                                                    {{ $order->acceptbyAdmin_status === 'pending' ? 'selected' : '' }}>
                                                                    Pending</option>
                                                                <option class="text-green-400" value="sudah"
                                                                    {{ $order->acceptbyAdmin_status === 'sudah' ? 'selected' : '' }}>
                                                                    Sudah</option>
                                                            </select>
                                                        </div>

                                                        <div>
                                                            <label for="shipment_status"
                                                                class="block mb-2 text-sm font-medium text-gray-900">Dikirim
                                                                Kurir</label>
                                                            <select name="shipment_status" id="shipment_status"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                                required>
                                                                <option class="text-red-700" value="pending"
                                                                    {{ $order->shipment_status === 'pending' ? 'selected' : '' }}>
                                                                    Pending</option>
                                                                <option class="text-green-400" value="sudah"
                                                                    {{ $order->shipment_status === 'sudah' ? 'selected' : '' }}>
                                                                    Sudah</option>
                                                            </select>
                                                        </div>

                                                        <div>
                                                            <label for="acceptbyCustomer_status"
                                                                class="block mb-2 text-sm font-medium text-gray-900">Sampai
                                                                Tujuan</label>
                                                            <select name="acceptbyCustomer_status"
                                                                id="acceptbyCustomer_status"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                                required>
                                                                <option class="text-red-700" value="pending"
                                                                    {{ $order->acceptbyCustomer_status === 'pending' ? 'selected' : '' }}>
                                                                    Pending</option>
                                                                <option class="text-green-400" value="sudah"
                                                                    {{ $order->acceptbyCustomer_status === 'sudah' ? 'selected' : '' }}>
                                                                    Sudah</option>
                                                            </select>
                                                        </div>

                                                        <p class="mt-4 text-center font-semibold col-span-3">Tanggal</p>

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
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                                value="{{ $order->shipment_date ? \Carbon\Carbon::parse($order->shipment_date)->format('Y-m-d\TH:i') : '' }}">
                                                        </div>

                                                        <div>
                                                            <label for="arrived_date"
                                                                class="block mb-2 text-sm font-medium text-gray-900">Order
                                                                Sampai</label>
                                                            <input type="datetime-local" name="arrived_date"
                                                                id="arrived_date"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                                value="{{ $order->arrived_date ? \Carbon\Carbon::parse($order->arrived_date)->format('Y-m-d\TH:i') : '' }}">
                                                        </div>

                                                        <div class="col-span-2">
                                                            <label for="note"
                                                                class="block mb-2 text-sm font-medium text-gray-900">Note</label>
                                                            <textarea name="note" id="note" rows="4"
                                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500">{{ $order->note }}
                                                                </textarea>
                                                        </div>

                                                        <div>
                                                            <label for="is_print"
                                                                class="block mb-2 text-sm font-medium text-gray-900">Print
                                                                Status</label>
                                                            <select name="is_print" id="is_print"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                                required>
                                                                <option class="text-red-700" value="pending"
                                                                    {{ $order->is_print === 'pending' ? 'selected' : '' }}>
                                                                    Pending</option>
                                                                <option class="text-green-400" value="sudah"
                                                                    {{ $order->is_print === 'sudah' ? 'selected' : '' }}>
                                                                    Sudah</option>
                                                            </select>
                                                        </div>

                                                    </div>


                                                    <div class="items-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                                                        <button type="submit"
                                                            class="w-full sm:w-auto justify-center text-white inline-flex bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update
                                                            Order</button>

                                                        <button data-modal-toggle="update-modal{{ $order->id }}"
                                                            type="button"
                                                            class="w-full justify-center sm:w-auto text-white inline-flex items-center bg-red-500 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
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
                                                        <h3 class="text-lg font-semibold text-gray-900">
                                                            Payment oleh customer: {{ $order->user->name }}</h3>
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
                                                    <img src="{{ asset('storage/' . $order->payment) }}"
                                                        alt="{{ asset('storage/' . $order->payment) }}"
                                                        class="mt-3 w-96 mx-auto rounded-lg object-cover">
                                                @else
                                                    <p class="mt-3 text-red-700 text-center font-semibold text-gray-900">
                                                        Belum ada bukti pembayaran</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
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
