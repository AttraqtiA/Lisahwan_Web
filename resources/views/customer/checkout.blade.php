@extends('layouts.frame_nocarousel')

@section('content_page')
    <div class="flex flex-col items-center">
        @if (session('deleteCart_success'))
            <div class="w-8/12 sm:w-5/12 md:w-4/12 lg:w-3/12 flex justify-center items-center p-4 mt-8 text-sm rounded-lg bg-gray-900 text-green-400"
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
        <div
            class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-2 gap-x-10 gap-y-8 sm:gap-y-8 lg:gap-y-12 p-8 sm:p-12 mx-auto">
            <div class="flex flex-col mx-auto w-full">
                @error('payment_upload')
                    <p class="mb-2 w-full text-center text-base text-red-500"><span class="font-medium">{{ $message }}
                    </p>
                @enderror
                <h1 class="mb-5 text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900">Detail Pengiriman</h1>
                <form action="{{ route('member.checkout.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="address" class="block mb-2 text-sm font-semibold text-gray-900">Alamat</label>
                            <select id="address_id" name="address_id" onchange="toggleInputAddress()"
                                class="{{ $errors->has('address_id') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm mt-3 block w-full p-2.5">
                                <option value="0">Tambah alamat lain</option>
                                @foreach ($addresses as $address)
                                    @if (old('address_id') == $address->id)
                                        <option selected value="{{ $address->id }}">{{ $address->address }}</option>
                                    @else
                                        <option value="{{ $address->id }}">{{ $address->address }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <input type="text" name="address" id="address" value="{{ old('address') }}"
                                class="{{ $errors->has('address') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm mt-3 block w-full p-2.5"
                                placeholder="(Contoh: Jln. Indonesia Raya No. 17, RT 08 RW 08)">
                            @error('address')
                                <p class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label for="city" class="block mb-2 text-sm font-semibold text-gray-900">Kota</label>
                            <input type="text" name="city" id="city" value="{{ old('city') }}"
                                class="{{ $errors->has('city') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm mt-3 block w-full p-2.5"
                                placeholder="(Contoh: Surabaya)">
                            @error('city')
                                <p class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label for="province" class="block mb-2 text-sm font-semibold text-gray-900">Provinsi</label>
                            <input type="text" name="province" id="province" value="{{ old('province') }}"
                                class="{{ $errors->has('province') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm mt-3 block w-full p-2.5"
                                placeholder="(Contoh: Jawa Timur)">
                            @error('province')
                                <p class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label for="postal_code" class="block mb-2 text-sm font-semibold text-gray-900">Kode Pos</label>
                            <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}"
                                class="{{ $errors->has('postal_code') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm mt-3 block w-full p-2.5"
                                placeholder="(Contoh: 60237)">
                            @error('postal_code')
                                <p class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label for="note" class="block mb-2 text-sm font-semibold text-gray-900">Catatan</label>
                            <textarea id="note" name="note" rows="4"
                                class="{{ $errors->has('note') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm mt-3 block w-full p-2.5"
                                placeholder="Tambahkan catatan jika perlu...">{{ old('note') }}</textarea>
                            @error('note')
                                <p class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div id="payment-modal" tabindex="-1"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
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
                                <div class="p-4 md:p-5 text-center">
                                    <span class="block text-base font-semibold text-gray-900">Upload Bukti Pembayaran</span>
                                    <span class="block mb-3 text-xl font-bold text-yellow-500">No Rek. 5120164866 (a.n.
                                        Hendra)</span>
                                    <div id="imagePreview" class="mb-3"></div>
                                    <div class="flex justify-center items-center w-full">
                                        <label for="payment_upload"
                                            class="flex flex-col justify-center items-center w-full h-44 bg-gray-50 rounded-lg border-1 border-gray-300 border-dashed cursor-pointer hover:bg-gray-100">
                                            <input type="file" name="payment_upload" id="payment_upload"
                                                class="hidden" onchange="displayImagePreview(this)">
                                            <div class="flex flex-col justify-center items-center w-full pt-5 pb-6">
                                                <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                </svg>
                                                <p class="mb-2 text-sm text-gray-500">
                                                    <span class="font-semibold">Klik untuk upload</span>
                                                </p>
                                                <p class="text-xs text-gray-500">PNG, JPG atau JPEG (Ukuran File MAX. 5MB)
                                                </p>
                                            </div>
                                        </label>
                                    </div>
                                    <button type="submit"
                                        onclick="return confirm('Apakah anda sudah yakin dengan detail pemesanan anda?')"
                                        class="cursor-pointer mt-3 w-full text-white bg-yellow-500 hover:bg-yellow-600 font-medium rounded-lg text-base px-5 py-2.5 text-center items-center">
                                        Selesaikan Pembayaran
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="flex flex-col col-span-2 mt-12">
                    <div class="flex flex-row justify-between items-center">
                        <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900">Produk Lainnya</h1>
                        <a href="{{ route('products') }}">
                            <p class="text-sm font-medium text-yellow-500 hover:text-yellow-600">Lihat semua</p>
                        </a>
                    </div>
                    <hr class="h-px my-2 border-0 bg-gray-400">
                    <div
                        class = "grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-3 p-4 mx-auto @if (count($products_bestseller) == 0) h-full justify-center items-center @endif">
                        @if (count($products_bestseller) > 0)
                            @foreach ($products_bestseller as $bestseller)
                                <div
                                    class="relative hover:shadow-xl transform transition duration-500 hover:-translate-y-4 hover:z-40">
                                    <a href="{{ route('member.products.show', $bestseller->product->id) }}">
                                        <div
                                            class="relative w-full h-full rounded-lg bg-gray-900 border-gray-800 mx-auto shadow">
                                            <img class="h-3/4 rounded-t-lg w-full object-center object-cover"
                                                src="/images/fotoproduk/{{ $bestseller->product->image }}"
                                                alt="{{ $bestseller->product->name }}" />
                                            <div class="h-1/4 px-8 pb-2 flex flex-col justify-center items-center">
                                                <h5
                                                    class="sm:leading-6 md:leading-normal lg:leading-normal text-xl sm:text-3xl md:text-2xl lg:text-xl font-bold tracking-tight text-yellow-500 text-center">
                                                    {{ $bestseller->product->name }}
                                                </h5>
                                                <div class="flex flex-row w-full justify-center items-center">
                                                    @if ($bestseller->product->discount != 0)
                                                        <p
                                                            class="text-base sm:text-sm md:text-lg lg:text-sm font-normal text-white text-center">
                                                            Rp.
                                                            {{ number_format($bestseller->product->price, 0, ',', '.') }}
                                                        </p>
                                                        <p
                                                            class="ml-2 flex items-center text-base sm:text-sm md:text-lg lg:text-sm font-bold text-red-600 text-center">
                                                            <svg class="w-4 h-4 mr-2 text-red-600" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 14 10">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M1 5h12m0 0L9 1m4 4L9 9" />
                                                            </svg>
                                                            (Rp.
                                                            {{ number_format($bestseller->product->countDiscount(), 0, ',', '.') }})
                                                        </p>
                                                    @else
                                                        <p
                                                            class="text-base sm:text-sm md:text-lg lg:text-base font-normal text-white text-center">
                                                            Rp.
                                                            {{ number_format($bestseller->product->price, 0, ',', '.') }}
                                                        </p>
                                                    @endif
                                                </div>
                                                @if ($bestseller->product->stock == 0)
                                                    <p
                                                        class="text-sm sm:text-base md:text-base lg:text-sm font-normal text-red-600 text-center mt-2">
                                                        Stock Habis!</p>
                                                @else
                                                    <p
                                                        class="text-sm sm:text-base md:text-base lg:text-sm font-normal text-lime-500 text-center mt-2">
                                                        Tersisa {{ $bestseller->product->stock }}
                                                        stock
                                                        lagi!</p>
                                                @endif
                                            </div>

                                            <!-- SVG icon di kanan bawah dari gambar -->
                                            <form action="{{ route('member.wishlist.store', $bestseller->product->id) }}"
                                                method="POST">
                                                @csrf
                                                @if ($bestseller->product->favorite_status == 0)
                                                    <button type="submit">
                                                        <svg class="cursor-pointer absolute w-6 h-6 text-white bottom-4 right-4 hover:text-red-600"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="currentColor" viewBox="0 0 20 18">
                                                            <path
                                                                d="M17.947 2.053a5.209 5.209 0 0 0-3.793-1.53A6.414 6.414 0 0 0 10 2.311 6.482 6.482 0 0 0 5.824.5a5.2 5.2 0 0 0-3.8 1.521c-1.915 1.916-2.315 5.392.625 8.333l7 7a.5.5 0 0 0 .708 0l7-7a6.6 6.6 0 0 0 2.123-4.508 5.179 5.179 0 0 0-1.533-3.793Z" />
                                                        </svg>
                                                    </button>
                                                @else
                                                    <button type="submit">
                                                        <svg class="cursor-pointer absolute w-6 h-6 text-red-600 bottom-4 right-4 hover:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="currentColor" viewBox="0 0 20 18">
                                                            <path
                                                                d="M17.947 2.053a5.209 5.209 0 0 0-3.793-1.53A6.414 6.414 0 0 0 10 2.311 6.482 6.482 0 0 0 5.824.5a5.2 5.2 0 0 0-3.8 1.521c-1.915 1.916-2.315 5.392.625 8.333l7 7a.5.5 0 0 0 .708 0l7-7a6.6 6.6 0 0 0 2.123-4.508 5.179 5.179 0 0 0-1.533-3.793Z" />
                                                        </svg>
                                                    </button>
                                                @endif
                                            </form>

                                            <!-- Diskon di pojok kanan atas -->
                                            @if ($bestseller->product->discount != 0)
                                                <div
                                                    class="absolute top-0 right-0 m-4 text-lg text-red-600 rounded-lg font-bold bg-gray-900 p-2">
                                                    {{ $bestseller->product->discount }}%</div>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <div class="col-span-2 flex flex-col items-center justify-center">
                                <h1 class="text-center text-lg font-bold text-gray-400">Mohon maaf,
                                    belum
                                    ada
                                    produk best seller!</h1>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex flex-col mx-auto w-full">
                <h1 class="mb-5 text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900">Detail Pemesanan</h1>
                <div class="bg-white border border-gray-300 rounded-lg p-5 drop-shadow-md">
                    @php
                        $countSubtotal = 0;
                    @endphp
                    <div class="flex flex-col-reverse">
                        @if (!empty($carts))
                            @foreach ($carts as $cart)
                                <div class="flex items-center">
                                    <img class="h-32 w-44 object-cover object-bottom rounded-lg drop-shadow-md"
                                        src="/images/fotoproduk/{{ $cart->product->image }}"
                                        alt="{{ $cart->product->name }}">
                                    <div class="flex flex-col ml-3 justify-center w-full">
                                        <p class="text-lg font-semibold text-gray-900">{{ $cart->product->name }}</p>
                                        <p class="text-sm font-normal text-gray-400">{{ $cart->quantity }} buah
                                            ({{ $cart->weight }} gram)
                                        </p>
                                        <p class="mt-4 text-base font-medium text-gray-900">Rp.
                                            {{ number_format($cart->price, 0, ',', '.') }}
                                        </p>
                                        <div class="flex flex-row items-center justify-between mt-1 mb-1">
                                            <form action="{{ route('member.carts.edit', $cart->product_id) }}"
                                                method="GET">
                                                @csrf
                                                <button type="submit"
                                                    class="cursor-pointer text-white bg-yellow-500 hover:bg-yellow-600 font-medium rounded-md text-sm sm:text-sm md:text-sm lg:text-sm px-2 py-1 inline-flex items-center">
                                                    <svg class="w-4 h-4 sm:mr-1 text-white" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 20 18">
                                                        <path
                                                            d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                                                        <path
                                                            d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                                                    </svg>
                                                    <span class="sm:inline-block">Ubah Pesanan</span>
                                                </button>
                                            </form>
                                            <form action="{{ route('member.carts.destroy', $cart->id) }}" method="POST">
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
                                @endif
                            @endforeach
                        @else
                            <div class="flex flex-col items-center justify-center">
                                <h1 class="text-center text-xl font-bold text-gray-400">Keranjang
                                    anda kosong</h1>
                                <a href="{{ route('products') }}">
                                    <p class="text-center text-base font-normal text-yellow-500">Belanja sekarang!</p>
                                </a>
                            </div>
                        @endif
                    </div>
                    @if ($countSubtotal && $shipment_price)
                        <hr class="h-px my-7 border-2 border-yellow-500">
                        <div class="flex flex-row justify-between items-center">
                            <p class="text-base font-medium text-gray-900">
                                Subtotal:
                            </p>
                            <p class="text-base font-medium text-gray-900">
                                Rp. {{ number_format($countSubtotal, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="mt-1 flex flex-row justify-between items-center">
                            <p class="text-base font-medium text-gray-900">
                                Biaya Pengiriman:
                            </p>
                            <p class="text-base font-medium text-gray-900">
                                Rp. {{ number_format($shipment_price, 0, ',', '.') }}
                            </p>
                        </div>
                        <p class="mt-1 text-sm font-normal text-gray-900">
                            (Estimasi pengiriman 1-3 hari)
                        </p>
                        <hr class="h-px my-7 border-2 border-yellow-500">
                        <div class="flex flex-row justify-between items-center">
                            <p class="text-xl font-bold text-gray-900">
                                Total:
                            </p>
                            <p class="text-xl font-bold text-gray-900">
                                Rp. {{ number_format($countSubtotal + $shipment_price, 0, ',', '.') }}
                            </p>
                        </div>
                        <hr class="h-px my-7 border-2 border-yellow-500">
                        <button type="button" data-modal-target="payment-modal" data-modal-toggle="payment-modal"
                            class="cursor-pointer w-full text-white bg-gray-900 hover:bg-gray-800 font-medium rounded-lg text-base px-5 py-2.5 text-center items-center">
                            Bayar Sekarang
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script language="javascript">
        function toggleInputAddress() {
            var selectAddress = $('#address_id');
            var inputAddress = $('#address');

            if (selectAddress.value != '0') {
                inputAddress.style.display = 'none';
            } else {
                inputAddress.style.display = 'block';
            }
        }

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
    </script>
@endsection
