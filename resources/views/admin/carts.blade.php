@extends('layouts.admin.frame_admin')

@section('content_page')
    <div class="flex flex-col items-center sm:ml-56 mt-36 sm:mt-36 pb-12">
        @if (session('updateCart_success'))
            <div class="w-10/12 md:w-9/12 lg:w-6/12 flex justify-center items-center p-4 mb-12 text-sm rounded-lg bg-gray-900 text-green-400"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ session('updateCart_success') }}
                </div>
            </div>
        @endif
        @if (session('over_quantity'))
            <div class="w-10/12 md:w-9/12 lg:w-6/12 flex justify-center items-center p-4 mb-12 text-sm rounded-lg bg-gray-900 text-red-400"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ session('over_quantity') }}
                </div>
            </div>
        @endif
        @if (session('deleteCart_success'))
            <div class="w-10/12 md:w-9/12 lg:w-6/12 flex justify-center items-center p-4 mb-12 text-sm rounded-lg bg-gray-900 text-green-400"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ session('deleteCart_success') }}
                </div>
            </div>
        @endif
        @error('quantity')
            <div class="w-10/12 md:w-9/12 lg:w-6/12 flex justify-center items-center p-4 mb-12 text-sm rounded-lg bg-gray-900 text-red-400"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ $message }}
                </div>
            </div>
        @enderror
        @error('payment_upload')
            <div class="w-10/12 md:w-9/12 lg:w-6/12 flex justify-center items-center p-4 mb-12 text-sm rounded-lg bg-gray-900 text-red-400"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ $message }}
                </div>
            </div>
        @enderror
        @error('payment_upload.required')
            <div class="w-10/12 md:w-9/12 lg:w-6/12 flex justify-center items-center p-4 mb-12 text-sm rounded-lg bg-gray-900 text-red-400"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ $message }}
                </div>
            </div>
        @enderror
        <div class="mx-auto w-11/12 sm:max-w-screen-xl text-center sm:col-span-2 md:col-span-2 lg:col-span-4 mb-12">
            <h1 class="mb-8 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
                {!! $pageTitle !!}</h1>
            <p class="text-lg font-normal text-gray-900 lg:text-xl sm:px-16 lg:px-48">{!! $pageDescription !!}</p>
        </div>
        <div class = "flex flex-col w-11/12 justify-center items-center">
            @php
                $countSubtotal = 0;
            @endphp
            @if (!empty($carts))
                <div class="relative overflow-x-auto shadow-md rounded-lg w-full">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-900 border-0 ">
                        <thead class="text-xs text-gray-900 uppercase bg-yellow-500">
                            <tr>
                                <th scope="col" class="px-16 py-3 text-center">
                                    <span class="sr-only">Gambar</span>
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Produk
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Jumlah
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Harga
                                </th>
                                <th scope="col" colspan="2" class="px-6 py-3 text-center">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                                <tr class="bg-white border-b hover:bg-slate-100 text-center">
                                    <td class="p-4">
                                        <div class="flex justify-center items-center">
                                            @if (strlen($cart->product->image) > 30)
                                                <img src="{{ asset('storage/' . $cart->product->image) }}"
                                                    class="w-16 md:w-32 max-w-full max-h-full rounded-lg"
                                                    alt="{{ $cart->product->name }}">
                                            @else
                                                <img src="/images/fotoproduk/{{ $cart->product->image }}"
                                                    class="w-16 md:w-32 max-w-full max-h-full rounded-lg"
                                                    alt="{{ $cart->product->name }}">
                                            @endif
                                        </div>
                                    </td>
                                    <td class="font-semibold text-gray-900">
                                        {{ $cart->product->name }}
                                    </td>
                                    @if (Auth::user()->isAdmin())
                                        <form action="{{ route('admin.products.edit', $cart->id) }}" method="POST">
                                            @csrf
                                            @method('put')
                                            <td class="">
                                                <div class="flex justify-center items-center">
                                                    <div>
                                                        <input type="number" name="quantity"
                                                            class="bg-gray-200 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block px-2.5 py-1"
                                                            value="{{ $cart->quantity }}" required min="0" />
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="font-semibold text-gray-900">
                                                {{ number_format($cart->price, 0, ',', '.') }}
                                            </td>
                                            <td class="">
                                                <button type="submit"
                                                    class="cursor-pointer text-gray-900 bg-yellow-500 hover:bg-yellow-600 font-medium rounded-md text-xs sm:text-sm p-2.5 py-2 inline-flex items-center">
                                                    <svg class="w-4 h-4 sm:mr-1 text-gray-900" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 20 18">
                                                        <path
                                                            d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                                                        <path
                                                            d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                                                    </svg>
                                                    <span class="sm:inline-block">Perbarui</span>
                                                </button>
                                            </td>
                                        </form>
                                    @endif
                                    @if (Auth::user()->isOwner())
                                        <form action="{{ route('owner.products.edit', $cart->id) }}" method="POST">
                                            @csrf
                                            @method('put')
                                            <td class="">
                                                <div class="flex justify-center items-center">
                                                    <div>
                                                        <input type="number" name="quantity"
                                                            class="bg-gray-200 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block px-2.5 py-1"
                                                            value="{{ $cart->quantity }}" required min="0" />
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="font-semibold text-gray-900">
                                                {{ number_format($cart->price, 0, ',', '.') }}
                                            </td>
                                            <td class="">
                                                <button type="submit"
                                                    class="cursor-pointer text-gray-900 bg-yellow-500 hover:bg-yellow-600 font-medium rounded-md text-xs sm:text-sm p-2.5 py-2 inline-flex items-center">
                                                    <svg class="w-4 h-4 sm:mr-1 text-gray-900" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 20 18">
                                                        <path
                                                            d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                                                        <path
                                                            d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                                                    </svg>
                                                    <span class="sm:inline-block">Perbarui</span>
                                                </button>
                                            </td>
                                        </form>
                                    @endif
                                    <td class="pl-6 lg:pl-0 pr-6">
                                        @if (Auth::user()->isAdmin())
                                            <form action="{{ route('admin.products.delete', $cart->id) }}"
                                                method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit"
                                                    class="cursor-pointer text-xs sm:text-sm font-medium text-red-500 hover:underline"
                                                    onclick="return confirm('Apakah anda ingin menghapus pesanan ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endif
                                        @if (Auth::user()->isOwner())
                                            <form action="{{ route('owner.products.delete', $cart->id) }}"
                                                method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit"
                                                    class="cursor-pointer text-xs sm:text-sm font-medium text-red-500 hover:underline"
                                                    onclick="return confirm('Apakah anda ingin menghapus pesanan ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @php
                                    $countSubtotal += $cart->price;
                                @endphp
                            @endforeach
                            <tr class="bg-white hover:bg-slate-100">
                                <td class="px-6 py-4 bg-yellow-500 text-center text-sm md:text-base font-semibold"
                                    colspan="4">
                                    Total belanja:
                                </td>
                                <td class="bg-gray-900 px-6 py-4 text-center text-sm md:text-base font-bold text-green-500"
                                    colspan="2">
                                    Rp. {{ number_format($countSubtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @if (Auth::user()->isAdmin())
                    <form action="{{ route('admin.printStrukCart', ['user_id' => Auth::user()->id]) }}" method="GET"
                        class="w-full">
                        <button type="submit"
                            class="cursor-pointer mt-7 w-full text-white bg-green-500 hover:bg-green-600 font-medium rounded-lg text-sm md:text-base px-5 py-2.5 text-center items-center">
                            Cetak Struk
                        </button>
                    </form>
                @endif
                @if (Auth::user()->isOwner())
                    <form action="{{ route('owner.printStrukCart', ['user_id' => Auth::user()->id]) }}" method="GET"
                        class="w-full">
                        <button type="submit"
                            class="cursor-pointer mt-7 w-full text-white bg-green-500 hover:bg-green-600 font-medium rounded-lg text-sm md:text-base px-5 py-2.5 text-center items-center">
                            Cetak Struk
                        </button>
                    </form>
                @endif
                <div class="flex flex-col md:flex-row md:space-x-2 w-full">
                    @if (Auth::user()->isAdmin())
                        <form action="{{ route('admin.checkout') }}" method="POST" class="w-full">
                            @csrf
                            <input type="hidden" value="paidcash" name="cash_payment">
                            <button type="submit"
                                onclick="return confirm('Apakah anda sudah yakin dengan detail pemesanan anda?')"
                                class="cursor-pointer mt-2 w-full text-yellow-500 bg-gray-900 hover:bg-gray-950 font-medium rounded-lg text-sm md:text-base px-5 py-2.5 text-center items-center">
                                Pembayaran Tunai
                            </button>
                        </form>
                    @endif
                    @if (Auth::user()->isOwner())
                        <form action="{{ route('owner.checkout') }}" method="POST" class="w-full">
                            @csrf
                            <input type="hidden" value="paidcash" name="cash_payment">
                            <button type="submit"
                                onclick="return confirm('Apakah anda sudah yakin dengan detail pemesanan anda?')"
                                class="cursor-pointer mt-2 w-full text-yellow-500 bg-gray-900 hover:bg-gray-950 font-medium rounded-lg text-sm md:text-base px-5 py-2.5 text-center items-center">
                                Pembayaran Tunai
                            </button>
                        </form>
                    @endif
                    <button type="button" data-modal-target="payment-modal" data-modal-toggle="payment-modal"
                        class="cursor-pointer mt-2 w-full text-yellow-500 bg-gray-900 hover:bg-gray-950 font-medium rounded-lg text-sm md:text-base px-5 py-2.5 text-center items-center">
                        Pembayaran QRIS BCA
                    </button>
                    <div id="payment-modal" tabindex="-1"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-lg max-h-full">
                            <div class="relative rounded-lg shadow bg-white">
                                <button type="button"
                                    class="cursor-pointer absolute top-3 end-2.5 text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                                    data-modal-hide="payment-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-4 md:p-5 text-center flex flex-col justify-center items-center">
                                    <span class="block text-base font-semibold text-gray-900">Upload Bukti
                                        Pembayaran</span>
                                    <img src="/images/qrisbca_lisahwan.jpeg" alt="QRIS BCA" class="w-3/4 h-3/4">
                                    <span class="block mb-3 text-xl font-bold text-yellow-500">No Rek BCA 5120164866
                                        (a.n.
                                        Hendra)</span>
                                    <div id="imagePreview" class="mb-3"></div>
                                    @if (Auth::user()->isAdmin())
                                        <form action="{{ route('admin.checkout') }}" method="POST" class="w-full"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="flex justify-center items-center w-full">
                                                <label for="payment_upload"
                                                    class="flex flex-col justify-center items-center w-full h-44 bg-gray-50 rounded-lg border-1 border-gray-300 border-dashed cursor-pointer hover:bg-gray-100">
                                                    <input type="file" name="payment_upload" id="payment_upload"
                                                        class="hidden" onchange="displayImagePreview(this)">
                                                    <div
                                                        class="flex flex-col justify-center items-center w-full pt-5 pb-6">
                                                        <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                        </svg>
                                                        <p class="mb-2 text-sm text-gray-500">
                                                            <span class="font-semibold">Klik untuk upload</span>
                                                        </p>
                                                        <p class="text-xs text-gray-500">PNG, JPG atau JPEG (Ukuran File
                                                            MAX.
                                                            5MB)
                                                        </p>
                                                    </div>
                                                </label>
                                            </div>
                                            <button type="submit"
                                                onclick="return confirm('Apakah anda sudah yakin dengan detail pemesanan anda?')"
                                                class="cursor-pointer mt-3 w-full text-white bg-yellow-500 hover:bg-yellow-600 font-medium rounded-lg text-base px-5 py-2.5 text-center items-center">
                                                Selesaikan Pembayaran
                                            </button>
                                        </form>
                                    @endif
                                    @if (Auth::user()->isOwner())
                                        <form action="{{ route('owner.checkout') }}" method="POST" class="w-full"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="flex justify-center items-center w-full">
                                                <label for="payment_upload"
                                                    class="flex flex-col justify-center items-center w-full h-44 bg-gray-50 rounded-lg border-1 border-gray-300 border-dashed cursor-pointer hover:bg-gray-100">
                                                    <input type="file" name="payment_upload" id="payment_upload"
                                                        class="hidden" onchange="displayImagePreview(this)">
                                                    <div
                                                        class="flex flex-col justify-center items-center w-full pt-5 pb-6">
                                                        <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                        </svg>
                                                        <p class="mb-2 text-sm text-gray-500">
                                                            <span class="font-semibold">Klik untuk upload</span>
                                                        </p>
                                                        <p class="text-xs text-gray-500">PNG, JPG atau JPEG (Ukuran File
                                                            MAX.
                                                            5MB)
                                                        </p>
                                                    </div>
                                                </label>
                                            </div>
                                            <button type="submit"
                                                onclick="return confirm('Apakah anda sudah yakin dengan detail pemesanan anda?')"
                                                class="cursor-pointer mt-3 w-full text-white bg-yellow-500 hover:bg-yellow-600 font-medium rounded-lg text-base px-5 py-2.5 text-center items-center">
                                                Selesaikan Pembayaran
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="flex flex-col items-center justify-center mt-64 h-full">
                    <h1 class="text-center text-xl font-bold text-gray-400">Keranjang masih kosong</h1>
                    @if (Auth::user()->isAdmin())
                        <a href="{{ route('admin.products') }}">
                            <p class="text-center text-base font-normal text-yellow-500">Belanja sekarang!</p>
                        </a>
                    @endif
                    @if (Auth::user()->isOwner())
                        <a href="{{ route('owner.products') }}">
                            <p class="text-center text-base font-normal text-yellow-500">Belanja sekarang!</p>
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
    <script language="javascript">
        // buat display input file image preview
        function displayImagePreview(input) {
            var preview = $('#imagePreview');

            // Remove existing image
            preview.empty();

            // Display newly uploaded image
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = $('<img>').attr('src', e.target.result).addClass(
                        'w-6/12 mx-auto rounded-lg object-cover');
                    preview.append(img);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        // function openReceipt(url) {
        //     window.open(url, '_blank');
        // }
    </script>
@endsection
