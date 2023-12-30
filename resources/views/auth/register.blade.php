@extends('layouts.frame_auth')

@section('content_page')
    <div class="">
        <div class="row justify-center">
            <section style="background-image: url('/images/fotoproduk/GalleryCarousel_13.jpeg')"
                class="bg-cover bg-center bg-no-repeat bg-gray-700 bg-blend-multiply">
                <div class="flex flex-col items-center justify-center p-8 mx-auto md:h-full lg:py-0">
                    <div class="m-4 md:m-16 w-full rounded-lg shadow sm:max-w-md xl:p-0 bg-gray-900">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <h1 class="text-xl font-bold leading-tight tracking-tight md:text-2xl text-white">
                                Membuat akun baru
                            </h1>

                            <form method="POST" action="{{ route('register') }}" class="space-y-4 md:space-y-6"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="flex flex-row gap-4">
                                    <div>
                                        <label for="name" class="block mb-2 text-sm font-medium text-white">Nama</label>
                                        <input type="text" name="name" id="name"
                                            class="{{ $errors->has('name') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm mt-3 block w-full p-2.5"
                                            placeholder="" value="{{ old('name') }}" required autocomplete="name"
                                            autofocus>
                                        @error('name')
                                            <p class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="phone_number" class="block mb-2 text-sm font-medium text-white">No
                                            Telp/WA</label>
                                        <input type="text" name="phone_number" id="phone_number"
                                            class="{{ $errors->has('phone_number') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm mt-3 block w-full p-2.5"
                                            placeholder="" value="{{ old('phone_number') }}" required
                                            autocomplete="phone_number" autofocus>
                                        @error('phone_number')
                                            <p class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <label for="email" class="block mb-2 text-sm font-medium text-white">Email</label>
                                    <input type="email" name="email" id="email"
                                        class="{{ $errors->has('email') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm mt-3 block w-full p-2.5"
                                        placeholder="" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <p class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="flex flex-row gap-4">

                                    <div>
                                        <label for="password"
                                            class="block mb-2 text-sm font-medium text-white">Password</label>
                                        <input type="password" name="password" id="password" placeholder="••••••••"
                                            class="{{ $errors->has('password') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm mt-3 block w-full p-2.5"
                                            required autocomplete="new-password">
                                        @error('password')
                                            <p class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="confirm-password"
                                            class="block mb-2 text-sm font-medium text-white">Confirm
                                            password</label>
                                        <input type="password" name="password_confirmation" id="confirm-password"
                                            placeholder="••••••••"
                                            class="{{ $errors->has('address') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm mt-3 block w-full p-2.5"
                                            required>
                                        @error('confirm-password')
                                            <p class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                </div>

                                <div class="mb-4">
                                    <span class="block mb-2 text-sm font-medium text-gray-900">Foto Profil</span>
                                    <div id="existingImagePreviewId" class="mb-3"></div>
                                    <label for="profile_picture"
                                        class="flex flex-col justify-center items-center w-full h-44 bg-gray-50 rounded-lg border-1 border-gray-300 border-dashed cursor-pointer hover:bg-gray-100">
                                        <input type="file" name="profile_picture" id="profile_picture" class="hidden"
                                            onchange="displayImagePreview_Add(this)">
                                        <div class="flex flex-col justify-center items-center w-full pt-5 pb-6">
                                            <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500">
                                                <span class="font-semibold">Klik untuk upload</span>
                                            </p>
                                            <p class="text-xs text-gray-500">PNG, JPG atau JPEG (Ukuran File MAX.
                                                5MB)
                                            </p>
                                        </div>
                                    </label>
                                    @error('profile_picture')
                                        <p class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <button type="submit"
                                    class="w-full text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Daftar</button>

                                <p class="text-center text-sm font-light text-gray-400">
                                    Sudah memiliki akun? <a href="{{ route('login') }}"
                                        class="font-medium text-yellow-500 hover:underline">Masuk</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>

    <script>
        // buat display input file image preview
        function displayImagePreview_Add(input) {
            var preview = $('#existingImagePreviewId');

            // Remove existing image
            preview.empty();

            // Display newly uploaded image
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = $('<img>').attr('src', e.target.result).addClass(
                        'w-1/2 mx-auto rounded-lg object-cover');
                    preview.append(img);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
