@extends('layouts.frame_nocarousel')

@section('content_page')
    <div class="flex flex-col items-center">
        @if (session('deleteCart_success'))
            <div data-aos="zoom-in-down" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                class="w-10/12 md:w-9/12 lg:w-6/12 flex justify-center items-center p-4 mt-8 text-sm rounded-lg bg-gray-900 text-green-400"
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
        @if (session('correctCoupon_success'))
            <div data-aos="zoom-in-down" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                class="w-10/12 md:w-9/12 lg:w-6/12 flex justify-center items-center p-4 mt-8 text-sm rounded-lg bg-gray-900 text-green-400"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ session('correctCoupon_success') }}
                </div>
            </div>
        @endif
        @if (session('useCoupon_success'))
            <div data-aos="zoom-in-down" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                class="w-10/12 md:w-9/12 lg:w-6/12 flex justify-center items-center p-4 mt-8 text-sm rounded-lg bg-gray-900 text-green-400"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ session('useCoupon_success') }}
                </div>
            </div>
        @endif
        @if (session('activatePoint_success'))
            <div data-aos="zoom-in-down" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                class="w-10/12 md:w-9/12 lg:w-6/12 flex justify-center items-center p-4 mt-8 text-sm rounded-lg bg-gray-900 text-green-400"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ session('activatePoint_success') }}
                </div>
            </div>
        @endif
        @error('incorrectCoupon_error')
            <div data-aos="zoom-in-down" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                class="w-10/12 md:w-9/12 lg:w-6/12 flex justify-center items-center p-4 {{ $errors->has('incorrectCoupon_error') ? 'mt-8' : '' }} text-sm rounded-lg bg-gray-900 text-red-400"
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
        @error('alreadyAddCoupon_error')
            <div data-aos="zoom-in-down" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                class="w-10/12 md:w-9/12 lg:w-6/12 flex justify-center items-center p-4 {{ $errors->has('alreadyAddCoupon_error') ? 'mt-8' : '' }} text-sm rounded-lg bg-gray-900 text-red-400"
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
        @error('couponExpired_error')
            <div data-aos="zoom-in-down" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                class="w-10/12 md:w-9/12 lg:w-6/12 flex justify-center items-center p-4 {{ $errors->has('couponExpired_error') ? 'mt-8' : '' }} text-sm rounded-lg bg-gray-900 text-red-400"
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
        <div class="flex flex-col gap-y-8 lg:gap-y-8 p-8 sm:p-12 mx-auto w-full">
            <div class="flex flex-col lg:flex-row w-full col-span-2 lg:gap-x-6">
                <div class="flex flex-col mx-auto w-full mb-8 lg:mb-0">
                    @error('payment_upload')
                        <p data-aos="zoom-in-down" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                            class="mb-2 w-full text-center text-base text-red-500"><span
                                class="font-medium">{{ $message }}
                        </p>
                    @enderror
                    <h1 data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                        class="mb-5 text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900">Detail Pengiriman</h1>
                    <form action="{{ route('member.checkout.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $total_poin }}" name="total_poin">
                        <input type="hidden" value="{{ $reward_now }}" name="reward_now">
                        <div data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                            class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="sm:col-span-2">
                                <label for="address"
                                    class="block mb-2 text-sm font-semibold text-gray-900">Alamat</label>
                                <select id="address_id" name="address_id"
                                    class="{{ $errors->has('address_id') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700 focus:ring-red-500 focus:border-red-500' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm block w-full p-2.5 mt-3">
                                    <option value="0" data-city="" data-province="" data-postal_code="">Tambah
                                        alamat
                                        lain</option>
                                    @foreach ($addresses as $address)
                                        <option value="{{ $address->id }}" data-city="{{ $address->city }}"
                                            data-province="{{ $address->province }}"
                                            data-postal_code="{{ $address->postal_code }}"
                                            {{ old('address_id') == $address->id ? 'selected' : '' }}>
                                            {{ $address->address }}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="new_address_container" style="display: none;">
                                    <input type="text" name="address" id="address"
                                        value="{{ old('address', session('checkout.address')) }}"
                                        class="{{ $errors->has('address') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700 focus:ring-red-500 focus:border-red-500' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm block w-full p-2.5 mt-3"
                                        placeholder="(Contoh: Jln. Indonesia Raya No. 17, RT 08 RW 08)">
                                    @error('address')
                                        <p data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                            class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="w-full">
                                <label data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                    for="city" class="block mb-2 text-sm font-semibold text-gray-900">Kota</label>
                                <input data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                    type="text" name="city" id="city"
                                    value="{{ old('city', session('checkout.city')) }}"
                                    class="{{ $errors->has('city') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700 focus:ring-red-500 focus:border-red-500' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm block w-full p-2.5 mt-3"
                                    placeholder="(Contoh: Surabaya)">
                                @error('city')
                                    <p data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                        class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                    for="province" class="block mb-2 text-sm font-semibold text-gray-900">Provinsi</label>
                                <input data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                    type="text" name="province" id="province"
                                    value="{{ old('province', session('checkout.province')) }}"
                                    class="{{ $errors->has('province') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700 focus:ring-red-500 focus:border-red-500' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm block w-full p-2.5 mt-3"
                                    placeholder="(Contoh: Jawa Timur)">
                                @error('province')
                                    <p data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                        class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                    for="postal_code" class="block mb-2 text-sm font-semibold text-gray-900">Kode
                                    Pos</label>
                                <input data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                    type="text" name="postal_code" id="postal_code"
                                    value="{{ old('postal_code', session('checkout.postal_code')) }}"
                                    class="{{ $errors->has('postal_code') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700 focus:ring-red-500 focus:border-red-500' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm block w-full p-2.5 mt-3"
                                    placeholder="(Contoh: 60237)">
                                @error('postal_code')
                                    <p data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                        class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                    for="note" class="block mb-2 text-sm font-semibold text-gray-900">Catatan</label>
                                <textarea data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800" id="note"
                                    name="note" rows="4"
                                    class="{{ $errors->has('note') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700 focus:ring-red-500 focus:border-red-500' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm block w-full p-2.5 mt-3"
                                    placeholder="Tambahkan catatan jika perlu...">{{ old('note', session('checkout.note')) }}</textarea>
                                @error('note')
                                    <p data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                        class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
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
                                    <div class="p-4 md:p-5 text-center">
                                        <span class="block text-base font-semibold text-gray-900">Upload Bukti
                                            Pembayaran</span>
                                        <span class="block mb-3 text-xl font-bold text-yellow-500">No Rek BCA 5120164866
                                            (a.n. Hendra)</span>
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
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                    </svg>
                                                    <p class="mb-2 text-sm text-gray-500">
                                                        <span class="font-semibold">Klik untuk upload</span>
                                                    </p>
                                                    <p class="text-xs text-gray-500">PNG, JPG atau JPEG (Ukuran File MAX.
                                                        5MB)</p>
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
                    @if (count($coupons) > 0)
                        <form action="{{ route('member.cekKupon') }}" method="POST" enctype="multipart/form-data"
                            class="flex flex-row mb-4 mt-4 lg:mt-0">
                            @csrf
                            <input type="hidden" id="addressHidden" name="address"
                                value="{{ old('address', session('checkout.address')) }}">
                            <input type="hidden" id="cityHidden" name="city"
                                value="{{ old('city', session('checkout.city')) }}">
                            <input type="hidden" id="provinceHidden" name="province"
                                value="{{ old('province', session('checkout.province')) }}">
                            <input type="hidden" id="postalCodeHidden" name="postal_code"
                                value="{{ old('postal_code', session('checkout.postal_code')) }}">
                            <input type="hidden" id="noteHidden" name="note"
                                value="{{ old('note', session('checkout.note')) }}">
                            <div class="w-full">
                                <label data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                    for="coupon" class="block mb-3 text-sm font-semibold text-gray-900">Cek
                                    Kupon</label>
                                <div class="flex flex-row space-x-2 w-full">
                                    <input data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                                        data-aos-duration="800" type="text" name="coupon" id="coupon"
                                        value="{{ old('coupon') }}"
                                        class="{{ $errors->has('coupon') || $errors->has('alreadyAddCoupon_error') || $errors->has('incorrectCoupon_error') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700 focus:ring-red-500 focus:border-red-500' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm block p-2.5"
                                        placeholder="(Contoh: JULYCERIA)">
                                    <button data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                                        data-aos-duration="800" type="submit" data-modal-target="add_coupon_modal"
                                        data-modal-toggle="add_coupon_modal"
                                        class="flex flex-row items-center justify-center w-full lg:w-36 cursor-pointer text-yellow-500 bg-gray-900 hover:bg-gray-950 font-medium rounded-lg text-sm px-3 py-2.5 text-center">
                                        <svg class="w-4 h-4 mr-2 text-yellow-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M12 2c-.791 0-1.55.314-2.11.874l-.893.893a.985.985 0 0 1-.696.288H7.04A2.984 2.984 0 0 0 4.055 7.04v1.262a.986.986 0 0 1-.288.696l-.893.893a2.984 2.984 0 0 0 0 4.22l.893.893a.985.985 0 0 1 .288.696v1.262a2.984 2.984 0 0 0 2.984 2.984h1.262c.261 0 .512.104.696.288l.893.893a2.984 2.984 0 0 0 4.22 0l.893-.893a.985.985 0 0 1 .696-.288h1.262a2.984 2.984 0 0 0 2.984-2.984V15.7c0-.261.104-.512.288-.696l.893-.893a2.984 2.984 0 0 0 0-4.22l-.893-.893a.985.985 0 0 1-.288-.696V7.04a2.984 2.984 0 0 0-2.984-2.984h-1.262a.985.985 0 0 1-.696-.288l-.893-.893A2.984 2.984 0 0 0 12 2Zm3.683 7.73a1 1 0 1 0-1.414-1.413l-4.253 4.253-1.277-1.277a1 1 0 0 0-1.415 1.414l1.985 1.984a1 1 0 0 0 1.414 0l4.96-4.96Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Cek kupon
                                    </button>
                                </div>
                                @error('coupon')
                                    <p data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                        class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </form>
                        <div class="relative inline-block w-full z-10">
                            <button data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                id="dropdownToggleButton" data-dropdown-toggle="dropdownToggle"
                                data-dropdown-placement="bottom"
                                class="flex flex-row justify-center w-full text-yellow-500 bg-gray-900 hover:bg-gray-950 focus:ring-2 focus:outline-none focus:ring-yellow-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center items-center"
                                type="button">
                                Lihat kupon mu
                                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="dropdownToggle"
                                class="hidden absolute left-0 top-0 bottom-0 right-0 mt-3 w-full bg-gray-900 divide-y divide-gray-100 rounded-lg shadow">
                                @if (count($user_coupons) > 0)
                                    <ul class="p-2 space-y-1 text-sm text-yellow-500"
                                        aria-labelledby="dropdownToggleButton">
                                        @foreach ($user_coupons as $coupon)
                                            @php
                                                $couponStatus = Session::get('couponStatus_' . $coupon->coupon->id);
                                                // ini untuk hgapus session nya kalau kelupaan hapus pas migrate ulang buat debugging
                                                // Session::forget('couponStatus_' .  $coupon->coupon->id);

                                                // Session::forget([
                                                //     'checkout.address',
                                                //     'checkout.city',
                                                //     'checkout.province',
                                                //     'checkout.postal_code',
                                                //     'checkout.note',
                                                // ]);
                                            @endphp

                                            <form id="checkboxForm_{{ $coupon->coupon->id }}"
                                                action="{{ route('member.pilihKupon', $coupon->coupon->id) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" id="addressHidden_{{ $coupon->coupon->id }}"
                                                    name="address"
                                                    value="{{ old('address', session('checkout.address')) }}">
                                                <input type="hidden" id="cityHidden_{{ $coupon->coupon->id }}"
                                                    name="city" value="{{ old('city', session('checkout.city')) }}">
                                                <input type="hidden" id="provinceHidden_{{ $coupon->coupon->id }}"
                                                    name="province"
                                                    value="{{ old('province', session('checkout.province')) }}">
                                                <input type="hidden" id="postalCodeHidden_{{ $coupon->coupon->id }}"
                                                    name="postal_code"
                                                    value="{{ old('postal_code', session('checkout.postal_code')) }}">
                                                <input type="hidden" id="noteHidden_{{ $coupon->coupon->id }}"
                                                    name="note" value="{{ old('note', session('checkout.note')) }}">
                                                <li>
                                                    <div
                                                        class="flex flex-col space-y-2 lg:flex-row justify-between items-center p-2 rounded hover:bg-gray-800 w-full">
                                                        <label class="inline-flex items-center w-full cursor-pointer">
                                                            <input type="checkbox"
                                                                id="autoSubmitCheckbox_{{ $coupon->coupon->id }}"
                                                                value="" {{ isset($couponStatus) ? 'checked' : '' }}
                                                                class="sr-only peer">
                                                            <div
                                                                class="relative w-9 h-5 bg-gray-600 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-yellow-500 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:translate-x-[-100%] peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-yellow-500">
                                                            </div>
                                                            <span
                                                                class="ms-3 text-sm font-medium text-yellow-500">{{ $coupon->coupon->title }}</span>
                                                        </label>
                                                        <div
                                                            class="w-full flex flex-row space-x-2 items-center lg:justify-center">
                                                            <span
                                                                class="text-yellow-500 text-sm font-semibold">{{ $coupon->quantity }}
                                                                kupon</span>
                                                            <span class="w-2 h-2 bg-gray-700 rounded-full"></span>
                                                            <span class="text-yellow-500 text-sm font-semibold">(Berlaku
                                                                sampai
                                                                {{ date('d F Y', strtotime($coupon->coupon->ending_time)) }})</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </form>
                                        @endforeach
                                    </ul>
                                @else
                                    <ul class="p-4 space-y-1 text-sm text-yellow-500 text-center"
                                        aria-labelledby="dropdownToggleButton">
                                        <li>
                                            <span class="ms-3 text-sm font-medium text-yellow-500 text-center">Oops, kupon
                                                belum
                                                ditambahkan!</span>
                                        </li>
                                    </ul>
                                @endif
                            </div>
                        </div>
                    @else
                    @endif
                </div>

                <div class="flex flex-col mx-auto w-full">
                    <h1 data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                        class="mb-5 text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900">Detail Pemesanan</h1>
                    <div data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                        class="bg-white border border-gray-300 rounded-lg p-5 drop-shadow-md">
                        @php
                            $countSubtotal = 0;
                        @endphp
                        <div class="flex flex-col-reverse">
                            @if (!empty($carts))
                                @foreach ($carts as $cart)
                                    <div data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                                        data-aos-duration="800" class="flex flex-row items-center w-full">
                                        @if (strlen($cart->product->image) > 30)
                                            <img class="h-40 w-44 object-cover object-bottom rounded-lg drop-shadow-md"
                                                src="{{ asset('storage/' . $cart->product->image) }}"
                                                alt="{{ $cart->product->image }}" />
                                        @else
                                            <img class="h-40 w-44 object-cover object-bottom rounded-lg drop-shadow-md"
                                                src="/images/fotoproduk/{{ $cart->product->image }}"
                                                alt="{{ $cart->product->name }}">
                                        @endif
                                        <div class="flex flex-col ml-4 justify-center w-full space-y-8">
                                            <div>
                                                <p class="text-base sm:text-lg font-semibold text-gray-900">
                                                    {{ $cart->product->name }}</p>
                                                <p class="text-xs sm:text-sm font-normal text-gray-400">
                                                    {{ $cart->quantity }} buah
                                                    ({{ $cart->weight }} gram)
                                                </p>
                                                @php
                                                    $originalPriceKey = 'originalPrice_' . $cart->id;
                                                    $originalPrice = session($originalPriceKey);
                                                    $activeCoupons = session('activeCoupons', []);
                                                @endphp

                                                <div class="flex flex-col sm:flex-row justify-between">
                                                    <p class="text-sm sm:text-base font-medium text-gray-900">
                                                        Rp. {{ number_format($cart->price, 0, ',', '.') }}
                                                    </p>
                                                    @if ($originalPrice && count($activeCoupons))
                                                        <p
                                                            class="text-sm sm:text-base font-medium text-red-600 line-through">
                                                            Rp. {{ number_format($originalPrice, 0, ',', '.') }}
                                                        </p>
                                                    @endif
                                                </div>

                                            </div>
                                            <div>
                                                <div
                                                    class="flex flex-col sm:flex-row items-start sm:items-center sm:justify-between">
                                                    <form action="{{ route('member.carts.edit', $cart->product_id) }}"
                                                        method="GET">
                                                        @csrf
                                                        <button type="submit"
                                                            class="cursor-pointer text-white bg-yellow-500 hover:bg-yellow-600 font-medium rounded-md text-xs sm:text-sm px-2 py-1 inline-flex items-center">
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
                                                    <form action="{{ route('member.carts.destroy', $cart->id) }}"
                                                        method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit"
                                                            class="cursor-pointer text-xs sm:text-sm font-medium text-yellow-500 hover:text-yellow-600"
                                                            onclick="return confirm('Apakah anda ingin menghapus pesanan ini?')">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $countSubtotal += $cart->price;
                                    @endphp
                                    @if (!$loop->last)
                                        <hr data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                                            data-aos-duration="800" class="h-px my-4 border-0 bg-gray-400">
                                    @endif
                                @endforeach
                            @else
                                <div class="flex flex-col items-center justify-center">
                                    <h1 data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                        class="text-center text-xl font-bold text-gray-400">Keranjang
                                        anda kosong</h1>
                                    <a data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                        href="{{ route('products') }}">
                                        <p class="text-center text-base font-normal text-yellow-500">Belanja sekarang!</p>
                                    </a>
                                </div>
                            @endif
                        </div>
                        @if ($countSubtotal && $shipment_price)
                            <hr data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                class="h-px my-7 border-2 border-yellow-500">
                            <div data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                class="flex flex-row justify-between items-center">
                                <p class="text-base font-medium text-gray-900">
                                    Subtotal:
                                </p>
                                <p class="text-base font-medium text-gray-900">
                                    Rp. {{ number_format($countSubtotal, 0, ',', '.') }}
                                </p>
                            </div>
                            <div data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                class="mt-1 flex flex-row justify-between items-center">
                                <p class="text-base font-medium text-gray-900">
                                    Biaya Pengiriman:
                                </p>
                                <p class="text-base font-medium text-gray-900">
                                    Rp. {{ number_format($shipment_price, 0, ',', '.') }}
                                </p>
                            </div>
                            <p data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                class="mt-1 text-sm font-normal text-gray-900">
                                (Estimasi pengiriman 1-3 hari)
                            </p>
                            <p data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                class="mt-1 text-sm font-medium text-green-500">
                                *Dapatkan <span class="font-bold">{{ number_format($total_poin, 0, ',', '.') }}
                                    poin (Rp. {{ number_format($total_money, 0, ',', '.') }})</span>!
                            </p>
                            <hr data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                class="h-px my-7 border-2 border-yellow-500">
                            @php
                                $pointStatus = Session::get('pointStatus');
                                // Session::forget('pointStatus');
                            @endphp
                            <div data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                class="flex flex-row justify-between items-center">
                                <p class="text-xl font-bold text-gray-900">
                                    Total:
                                </p>
                                <div class="flex flex-col space-y-0 justify-center items-end">
                                    <span
                                        class="font-bold {{ isset($pointStatus) ? 'text-red-600 line-through text-lg' : ' text-xl text-gray-900 ' }}">
                                        Rp. {{ number_format($countSubtotal + $shipment_price, 0, ',', '.') }}
                                    </span>
                                    @if (isset($pointStatus))
                                        @if ($reward_now >= $countSubtotal + $shipment_price)
                                            <span class="text-xl font-bold text-gray-900">
                                                Rp.
                                                {{ number_format(0, 0, ',', '.') }}
                                            </span>
                                        @else
                                            <span class="text-xl font-bold text-gray-900">
                                                Rp.
                                                {{ number_format($countSubtotal + $shipment_price - $reward_now, 0, ',', '.') }}
                                            </span>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            @if (Auth::user()->reward > 0)
                                <hr data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                    class="h-px my-7 border-2 border-yellow-500">
                                <div data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                    class="flex flex-col space-y-2">
                                    <form id="togglePointForm" action="{{ route('member.aktifPoin') }}" method="POST">
                                        @csrf
                                        <input type="hidden" id="addressHide" name="address"
                                            value="{{ old('address', session('checkout.address')) }}">
                                        <input type="hidden" id="cityHide" name="city"
                                            value="{{ old('city', session('checkout.city')) }}">
                                        <input type="hidden" id="provinceHide" name="province"
                                            value="{{ old('province', session('checkout.province')) }}">
                                        <input type="hidden" id="postalCodeHide" name="postal_code"
                                            value="{{ old('postal_code', session('checkout.postal_code')) }}">
                                        <input type="hidden" id="noteHide" name="note"
                                            value="{{ old('note', session('checkout.note')) }}">
                                        <label
                                            class="inline-flex items-center cursor-pointer bg-gray-900 rounded-full px-3 py-2">
                                            <input type="checkbox" id="togglePoint" value=""
                                                {{ isset($pointStatus) ? 'checked' : '' }} class="sr-only peer">
                                            <div
                                                class="relative w-9 h-5 bg-gray-600 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-yellow-500 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:translate-x-[-100%] peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-yellow-500">
                                            </div>
                                            <span class="ms-2.5 text-base font-semibold text-yellow-500">Pakai Poin</span>
                                        </label>
                                    </form>
                                    @if (Session::has('pointStatus'))
                                        <span class="flex flex-row  items-center text-gray-900 text-sm">*Poin mu sekarang:
                                            {{ abs(number_format(($countSubtotal + $shipment_price - $reward_now) / $point->money_per_poin, 0, ',', '.')) }}<img
                                                src="/images/coin_icon.png" alt="Poin" class="w-4 h-4 ms-1"></span>
                                    @else
                                        <span class="flex flex-row  items-center text-gray-900 text-sm">*Poin mu sekarang:
                                            {{ number_format(Auth::user()->reward, 0, ',', '.') }}<img
                                                src="/images/coin_icon.png" alt="Poin" class="w-4 h-4 ms-1"></span>
                                    @endif
                                </div>
                            @else
                            @endif
                            <hr data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                class="h-px my-7 border-2 border-yellow-500">
                            <button data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                type="button" data-modal-target="payment-modal" data-modal-toggle="payment-modal"
                                class="cursor-pointer w-full text-yellow-500 bg-gray-900 hover:bg-gray-800 font-medium rounded-lg text-base px-5 py-2.5 text-center items-center">
                                Bayar Sekarang
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex flex-col col-span-2">
                <div class="flex flex-row justify-between items-center">
                    <h1 data-aos="fade-right" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                        class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900">Produk Bestseller</h1>
                    <a data-aos="fade-left" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                        href="{{ route('products') }}">
                        <p class="text-base font-medium text-yellow-500 hover:text-yellow-600">Lihat semua</p>
                    </a>
                </div>
                <hr class="h-px my-2 border-0 bg-gray-400">
                <div
                    class = "pt-2 grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 mx-auto @if (count($products_bestseller) == 0) h-full justify-center items-center @endif">
                    @if (count($products_bestseller) > 0)
                        @foreach ($products_bestseller as $bestseller)
                            <div
                                class="relative hover:shadow-xl transform transition duration-500 hover:-translate-y-4 hover:z-5">
                                <a href="{{ route('member.products.show', $bestseller->product->id) }}">
                                    <div data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                                        data-aos-duration="800"
                                        class="relative w-full h-full rounded-lg bg-gray-900 border-gray-800 mx-auto shadow">
                                        @if (strlen($bestseller->product->image) > 30)
                                            <img class="h-3/4 rounded-t-lg w-full object-center object-cover"
                                                src="{{ asset('storage/' . $bestseller->product->image) }}"
                                                alt="{{ $bestseller->product->image }}" />
                                        @else
                                            <img class="h-3/4 rounded-t-lg w-full object-center object-cover"
                                                src="/images/fotoproduk/{{ $bestseller->product->image }}"
                                                alt="{{ $bestseller->product->name }}" />
                                        @endif
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
                                            @if (
                                                $bestseller->product->wishlist->where('user_id', Auth::user()->id)->first() &&
                                                    $bestseller->product->wishlist->where('user_id', Auth::user()->id)->first()->favorite_status == '1')
                                                <button type="submit">
                                                    <svg class="cursor-pointer absolute w-6 h-6 text-red-600 bottom-4 right-4 hover:text-white"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 20 18">
                                                        <path
                                                            d="M17.947 2.053a5.209 5.209 0 0 0-3.793-1.53A6.414 6.414 0 0 0 10 2.311 6.482 6.482 0 0 0 5.824.5a5.2 5.2 0 0 0-3.8 1.521c-1.915 1.916-2.315 5.392.625 8.333l7 7a.5.5 0 0 0 .708 0l7-7a6.6 6.6 0 0 0 2.123-4.508 5.179 5.179 0 0 0-1.533-3.793Z" />
                                                    </svg>
                                                </button>
                                            @else
                                                <button type="submit">
                                                    <svg class="cursor-pointer absolute w-6 h-6 text-white bottom-4 right-4 hover:text-red-600"
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
                        <div class="col-span-4 flex flex-col items-center justify-center">
                            <h1 data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                class="text-center text-lg font-bold text-gray-400">Mohon maaf,
                                belum
                                ada
                                produk best seller!</h1>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script language="javascript">
        $(document).ready(function() {
            $('#address_id').change(function() {
                var selectedOption = $(this).find('option:selected');
                var city = selectedOption.data('city');
                var province = selectedOption.data('province');
                var postal_code = selectedOption.data('postal_code');

                if ($(this).val() == '0') {
                    $('#new_address_container').show();
                    // // Kosongkan nilai input jika tidak ada old atau session
                    // $('#city').val('{{ old('city', session('checkout.city')) }}' != '' ?
                    //     '{{ old('city', session('checkout.city')) }}' : '');
                    // $('#province').val('{{ old('province', session('checkout.province')) }}' != '' ?
                    //     '{{ old('province', session('checkout.province')) }}' : '');
                    // $('#postal_code').val('{{ old('postal_code', session('checkout.postal_code')) }}' !=
                    //     '' ? '{{ old('postal_code', session('checkout.postal_code')) }}' : '');
                } else {
                    $('#new_address_container').hide();
                    $('#city').val(city);
                    $('#province').val(province);
                    $('#postal_code').val(postal_code);
                }
            });

            // Trigger change event on page load to set the initial state
            $('#address_id').trigger('change');
        });

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

        $(document).ready(function() {
            // Mendengarkan perubahan pada semua checkbox dengan id yang dimulai dengan 'autoSubmitCheckbox_'
            $('[id^=autoSubmitCheckbox_]').change(function() {
                // Mengambil id form dari checkbox yang berubah
                var formId = $(this).attr('id').replace('autoSubmitCheckbox_', 'checkboxForm_');

                // Melakukan submit form yang sesuai dengan id
                $('#' + formId).submit();
            });
        });

        $(document).ready(function() {
            // Fungsi untuk memperbarui nilai input tersembunyi
            function updateHiddenInput(inputId, hiddenInputId) {
                $(inputId).on('input', function() {
                    $(hiddenInputId).val($(this).val());
                });
            }

            // Panggil fungsi untuk setiap input
            updateHiddenInput('#address', '#addressHidden');
            updateHiddenInput('#city', '#cityHidden');
            updateHiddenInput('#province', '#provinceHidden');
            updateHiddenInput('#postal_code', '#postalCodeHidden');
            updateHiddenInput('#note', '#noteHidden');
        });


        $(document).ready(function() {
            // Fungsi untuk memperbarui nilai input tersembunyi
            function updateHideInput(inputId, hiddenInputId) {
                $(inputId).on('input', function() {
                    $(hiddenInputId).val($(this).val());
                });
            }

            // Panggil fungsi untuk setiap input
            updateHideInput('#address', '#addressHide');
            updateHideInput('#city', '#cityHide');
            updateHideInput('#province', '#provinceHide');
            updateHideInput('#postal_code', '#postalCodeHide');
            updateHideInput('#note', '#noteHide');
        });

        $(document).ready(function() {
            // Fungsi untuk memperbarui nilai input tersembunyi
            function updateHiddenInput(inputId, hiddenInputId) {
                $(inputId).on('input', function() {
                    $(hiddenInputId).val($(this).val());
                });
            }

            // Daftar form ID yang digunakan
            var formIds = [
                @foreach ($coupons as $coupon)
                    '{{ $coupon->id }}',
                @endforeach
            ];

            // Panggil fungsi untuk setiap input dalam setiap form
            formIds.forEach(function(formId) {
                updateHiddenInput('#address', '#addressHidden_' + formId);
                updateHiddenInput('#city', '#cityHidden_' + formId);
                updateHiddenInput('#province', '#provinceHidden_' + formId);
                updateHiddenInput('#postal_code', '#postalCodeHidden_' + formId);
                updateHiddenInput('#note', '#noteHidden_' + formId);
            });
        });

        $(document).ready(function() {
            $('#togglePoint').on('change', function() {
                $('#togglePointForm').submit();
            });
        });
    </script>
@endsection
