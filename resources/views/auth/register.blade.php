@extends('layouts.frame_auth')

@section('content_page')
    <div class="">
        <div class="row justify-center">
            <section style="background-image: url('/images/fotoproduk/GalleryCarousel_13.jpeg')"
                class="bg-cover bg-center bg-no-repeat bg-gray-700 bg-blend-multiply">
                <div class="flex flex-col items-center justify-center p-8 mx-auto md:h-full lg:py-0">
                    <div class="m-4 md:m-16 w-full rounded-lg shadow sm:max-w-md xl:p-0 bg-gray-900">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <h1 class="text-xl font-bold leading-tight tracking-tight md:text-2xl text-yellow-500">
                                Sign Up
                            </h1>
                            <form method="POST" action="{{ route('register') }}" class="space-y-4 md:space-y-6"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="flex flex-row gap-4">
                                    <div>
                                        <label for="name" class="block mb-2 text-sm font-medium text-white">Nama</label>
                                        <input type="text" name="name" id="name"
                                            class="{{ $errors->has('name') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700 focus:ring-red-500 focus:border-red-500' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-2 text-sm mt-3 block w-full p-2.5"
                                            placeholder="Lisahwan" value="{{ old('name') }}" required autocomplete="name"
                                            autofocus>
                                        @error('name')
                                            <p class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="phone_number" class="block mb-2 text-sm font-medium text-white">No.
                                            Telp/WA</label>
                                        <input type="text" name="phone_number" id="phone_number"
                                            class="{{ $errors->has('phone_number') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700 focus:ring-red-500 focus:border-red-500' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-2 text-sm mt-3 block w-full p-2.5"
                                            placeholder="(082230308030)" value="{{ old('phone_number') }}" required
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
                                        class="{{ $errors->has('email') || $errors->has('email_error') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700 focus:ring-red-500 focus:border-red-500 focus:ring-red-500 focus:border-red-500' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-2 text-sm mt-3 block w-full p-2.5"
                                        placeholder="Masukkan email mu" value="{{ old('email', session('last_email')) }}"
                                        required autocomplete="email" autofocus>
                                    @error('email')
                                        <p class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="password" class="block mb-2 text-sm font-medium text-white">Password</label>
                                    <div class="relative">
                                        <input type="password" name="password" id="password"
                                            placeholder="Masukkan password mu"
                                            class="{{ $errors->has('password') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700 focus:ring-red-500 focus:border-red-500 focus:ring-red-500 focus:border-red-500' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-2 text-sm mt-3 block w-full p-2.5"
                                            required autocomplete="current-password" autofocus>
                                        <button type="button" id="toggle-password"
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                                            <svg id="eye-icon-open" class="w-6 h-6 text-gray-300" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24" style="display: none;">
                                                <path fill-rule="evenodd"
                                                    d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <svg id="eye-icon-closed" class="w-6 h-6 text-gray-300" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="m4 15.6 3.055-3.056A4.913 4.913 0 0 1 7 12.012a5.006 5.006 0 0 1 5-5c.178.009.356.027.532.054l1.744-1.744A8.973 8.973 0 0 0 12 5.012c-5.388 0-10 5.336-10 7A6.49 6.49 0 0 0 4 15.6Z" />
                                                <path
                                                    d="m14.7 10.726 4.995-5.007A.998.998 0 0 0 18.99 4a1 1 0 0 0-.71.305l-4.995 5.007a2.98 2.98 0 0 0-.588-.21l-.035-.01a2.981 2.981 0 0 0-3.584 3.583c0 .012.008.022.01.033.05.204.12.402.211.59l-4.995 4.983a1 1 0 1 0 1.414 1.414l4.995-4.983c.189.091.386.162.59.211.011 0 .021.007.033.01a2.982 2.982 0 0 0 3.584-3.584c0-.012-.008-.023-.011-.035a3.05 3.05 0 0 0-.21-.588Z" />
                                                <path
                                                    d="m19.821 8.605-2.857 2.857a4.952 4.952 0 0 1-5.514 5.514l-1.785 1.785c.767.166 1.55.25 2.335.251 6.453 0 10-5.258 10-7 0-1.166-1.637-2.874-2.179-3.407Z" />
                                            </svg>
                                        </button>
                                    </div>
                                    @error('password')
                                        <p class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="password_confirmation"
                                        class="block mb-2 text-sm font-medium text-white">Konfirmasi Password</label>
                                    <div class="relative">
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            placeholder="Konfirmasi password"
                                            class="{{ $errors->has('password') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700 focus:ring-red-500 focus:border-red-500 focus:ring-red-500 focus:border-red-500' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-2 text-sm mt-3 block w-full p-2.5"
                                            required autocomplete="current-password" autofocus>
                                        <button type="button" id="toggle-password_confirmation"
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                                            <svg id="eye-icon-open" class="w-6 h-6 text-gray-300" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24" style="display: none;">
                                                <path fill-rule="evenodd"
                                                    d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <svg id="eye-icon-closed" class="w-6 h-6 text-gray-300" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="m4 15.6 3.055-3.056A4.913 4.913 0 0 1 7 12.012a5.006 5.006 0 0 1 5-5c.178.009.356.027.532.054l1.744-1.744A8.973 8.973 0 0 0 12 5.012c-5.388 0-10 5.336-10 7A6.49 6.49 0 0 0 4 15.6Z" />
                                                <path
                                                    d="m14.7 10.726 4.995-5.007A.998.998 0 0 0 18.99 4a1 1 0 0 0-.71.305l-4.995 5.007a2.98 2.98 0 0 0-.588-.21l-.035-.01a2.981 2.981 0 0 0-3.584 3.583c0 .012.008.022.01.033.05.204.12.402.211.59l-4.995 4.983a1 1 0 1 0 1.414 1.414l4.995-4.983c.189.091.386.162.59.211.011 0 .021.007.033.01a2.982 2.982 0 0 0 3.584-3.584c0-.012-.008-.023-.011-.035a3.05 3.05 0 0 0-.21-.588Z" />
                                                <path
                                                    d="m19.821 8.605-2.857 2.857a4.952 4.952 0 0 1-5.514 5.514l-1.785 1.785c.767.166 1.55.25 2.335.251 6.453 0 10-5.258 10-7 0-1.166-1.637-2.874-2.179-3.407Z" />
                                            </svg>
                                        </button>
                                    </div>
                                    @error('password')
                                        <p class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                {{-- <div class="mb-4">
                                    <span class="block mb-2 text-sm font-medium text-gray-900">Foto Profil</span>
                                    <div id="existingImagePreviewId" class="mb-3"></div>
                                    <label for="profile_picture"
                                        class="flex flex-col justify-center items-center w-full h-44 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer hover:bg-gray-100">
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
                                </div> --}}
                                <button type="submit"
                                    class="w-full text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Daftar</button>

                                <p class="text-center text-sm font-light text-gray-400">
                                    Sudah memiliki akun? <a href="{{ route('login') }}"
                                        class="font-medium text-yellow-500 hover:underline">Login</a>
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

        $(document).ready(function() {
            $('#toggle-password').on('click', function() {
                var passwordField = $('#password');
                var passwordFieldType = passwordField.attr('type');
                var eyeIconOpen = $('#eye-icon-open');
                var eyeIconClosed = $('#eye-icon-closed');

                if (passwordFieldType === 'password') {
                    passwordField.attr('type', 'text');
                    eyeIconOpen.show();
                    eyeIconClosed.hide();
                } else {
                    passwordField.attr('type', 'password');
                    eyeIconOpen.hide();
                    eyeIconClosed.show();
                }
            });
        });

        $(document).ready(function() {
            $('#toggle-password_confirmation').on('click', function() {
                var passwordField = $('#password_confirmation');
                var passwordFieldType = passwordField.attr('type');
                var eyeIconOpen = $('#eye-icon-open');
                var eyeIconClosed = $('#eye-icon-closed');

                if (passwordFieldType === 'password') {
                    passwordField.attr('type', 'text');
                    eyeIconOpen.show();
                    eyeIconClosed.hide();
                } else {
                    passwordField.attr('type', 'password');
                    eyeIconOpen.hide();
                    eyeIconClosed.show();
                }
            });
        });
    </script>
@endsection
