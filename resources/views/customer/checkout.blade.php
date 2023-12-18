@extends('layouts.frame_nocarousel')

@section('content_page')
    <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-2 gap-x-8 gap-y-8 sm:gap-y-8 lg:gap-y-12 p-12 mx-auto">
        <div class="flex flex-col bg-gray-900 rounded-xl">
            <h1 class="mb-4 text-3xl font-bold text-white">Detail Pengiriman</h1>
            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                <form action="#">
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="address" class="block mb-2 text-sm font-medium text-yellow-500">Alamat</label>
                            <select id="address_id" name="address_id"
                                class="bg-white border-2 border-yellow-500 text-gray-900 placeholder-gray-400 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5">
                                @foreach ($addresses as $address)
                                    @if (old('address_id') == $address->id)
                                        <option selected value="{{ $address->id }}">{{ $address->address }}</option>
                                    @else
                                        <option value="{{ $address->id }}">{{ $address->address }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <input type="text" name="name" id="name"
                                class="bg-white border-2 border-yellow-500 text-gray-900 placeholder-gray-400 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5"
                                placeholder="(Contoh: Jalan Pegangsaan Timur No. 56, RT 08 RW 08)" required>
                        </div>
                        <div class="w-full">
                            <label for="brand"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kota</label>
                            <input type="text" name="brand" id="brand"
                                class="bg-white border-2 border-yellow-500 text-gray-900 placeholder-gray-400 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5"
                                placeholder="(Contoh: Surabaya)" required>
                        </div>
                        <div class="w-full">
                            <label for="price"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi</label>
                            <input type="text" name="price" id="price"
                                class="bg-white border-2 border-yellow-500 text-gray-900 placeholder-gray-400 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5"
                                placeholder="(Contoh: Jawa Timur)" required>
                        </div>
                        <div>
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode
                                Pos</label>
                            <input type="text" name="price" id="price"
                                class="bg-white border-2 border-yellow-500 text-gray-900 placeholder-gray-400 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5"
                                placeholder="(Contoh: 60237)" required>
                        </div>
                    </div>
                    <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Add product
                    </button>
                </form>
            </div>
        </div>
        <div class="flex flex-col">
            <h1 class="text-3xl font-bold dark:text-gray-900">Detail Pemesanan</h1>
        </div>
    </div>
@endsection
