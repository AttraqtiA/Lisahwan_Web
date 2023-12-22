@extends('layouts.admin.frame_admin')

@section('content_page')

    <!-- Start block -->
    <section class="dark:bg-neutral-200 p-2 sm:p-4 antialiased h-full">
        <div class="mx-auto max-w-screen-2xl pt-24 sm:ml-56">
            <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="flex-1 flex items-center space-x-2">
                        <h5>
                            <span class="text-gray-500">All User:</span>
                            <span class="text-gray-500">{{ $users->count() }}</span>
                        </h5>
                        <h5 class="text-gray-500 ml-1">(1-{{ (int) ceil($users->count() / 10) }})</h5>
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
                                            <div class="flex items-center">
                                                <input id="checkbox-table-search-1" type="checkbox"
                                                    onclick="event.stopPropagation()"
                                                    class="w-4 h-4 text-primary-600 bg-gray-100 rounded border-gray-300 focus:ring-primary-500 focus:ring-2">
                                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                            </div>
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
                                                {{ $user->address->first()->address }}, {{ $user->address->first()->city }},
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
