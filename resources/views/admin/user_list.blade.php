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
                            <span class="text-gray-500">Semua User:</span>
                            <span class="text-gray-500">{{ $users->count() }}</span>
                        </h5>
                        <h5 class="text-gray-500 ml-1">(1-{{ (int) ceil($users->count() / 10) }})</h5>
                    </div>
                    <div class="text-lg font-bold text-gray-800">
                        Daftar User
                    </div>
                </div>
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t">
                    <div class="w-full md:w-1/3">
                        <form class="flex items-center" action="{{ route('owner.admin_users') }}" method="GET">

                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor"
                                        viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
                                    </svg>
                                </div>
                                <input type="search" name="search" id="simple-search" placeholder="Cari user"
                                    required=""
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

                            {{-- <p class="text-gray-500">+ Add user</p> --}}

                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-center text-gray-500">
                        <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="p-4">No.</th>
                                <th scope="col" class="p-4">Nama</th>
                                <th scope="col" class="p-4">Role</th>
                                <th scope="col" class="p-4">Status</th>
                                <th scope="col" class="p-4">Email</th>
                                <th scope="col" class="p-4">No Telp/WA</th>
                                <th scope="col" class="p-4">Alamat</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if ($users->count() == 0)
                                <tr>
                                    <td colspan="6" class="p-4 text-center">
                                        <p class="text-gray-400">Belum ada user yang terdaftar</p>
                                    </td>
                                </tr>
                            @else
                                @foreach ($users as $user)
                                    <tr class="border-b hover:bg-gray-100">
                                        <td class="p-4 w-4">
                                            {{ $loop->index + ($users->currentPage() - 1) * $users->perPage() + 1 }}
                                        </td>
                                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                            <div class="flex items-center mr-3">
                                                @if ($user->profile_picture == null)
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-8 h-8 mr-3 rounded-full text-gray-700">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                @elseif (strlen($user->profile_picture) > 25)
                                                    <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                                        alt="profile picture"
                                                        class="w-8 h-8 mr-3 object-cover object-center rounded-full">
                                                @else
                                                    <img src="/images/profile_picture/{{ $user->profile_picture }}"
                                                        alt="profile picture"
                                                        class="w-8 h-8 mr-3 object-cover object-center rounded-full">
                                                @endif

                                                <p>{{ $user->name }}</p>
                                            </div>
                                        </th>
                                        @if ($user->role_id == 1)
                                            <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                                Owner</td>
                                        @elseif ($user->role_id == 2)
                                            <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                                Admin</td>
                                        @elseif ($user->role_id == 3)
                                            <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                                Member</td>
                                        @endif

                                        @if ($user->is_login == 1)
                                            <td>
                                                <div class="flex items-center">
                                                    <div class="h-4 w-4 rounded-full inline-block mr-2 bg-green-400"></div>
                                                    Online
                                                </div>
                                            </td>
                                        @else
                                            <td>
                                                <div class="flex items-center">
                                                    <div class="h-4 w-4 rounded-full inline-block mr-2 bg-red-700"></div>
                                                    Offline
                                                </div>
                                            </td>
                                        @endif

                                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $user->email }}</td>
                                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                            {{ substr($user->phone_number, 0, 4) . '-' . substr($user->phone_number, 4, 4) . '-' . substr($user->phone_number, 8) }}
                                        </td>

                                        @if ($user->address->isNotEmpty())
                                            <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $user->address->first()->address }},
                                                {{ $user->address->first()->city }},
                                                {{ $user->address->first()->province }},
                                                {{ $user->address->first()->postal_code }}
                                            </td>
                                        @else
                                            <td class="px-4 py-3 font-medium text-red-700 whitespace-nowrap">
                                                Alamat belum diisi
                                            </td>
                                        @endif


                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
                <nav class="flex flex-col md:flex-row justify-end items-center space-y-3 md:space-y-0 p-4"
                    aria-label="Table navigation">

                    {{ $users->links('vendor.pagination.tailwind') }}

                </nav>
            </div>
        </div>
    </section>
    <!-- End block -->

@endsection
