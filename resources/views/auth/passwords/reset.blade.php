@extends('layouts.frame_auth')

@section('content_page')
    <div class="">
        <div class="row justify-center">
            <section style="background-image: url('/images/fotoproduk/GalleryCarousel_10.jpg')"
                class="bg-cover bg-center bg-no-repeat bg-gray-700 bg-blend-multiply">
                <div class="flex flex-col items-center justify-center p-8 mx-auto md:h-screen lg:py-0">
                    <div data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                        class="w-full rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 bg-gray-900">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <h1 data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                class="text-xl font-bold leading-tight tracking-tight md:text-2xl text-yellow-500">
                                Create New Password
                            </h1>
                            <form method="POST" action="{{ route('password.update') }}" class="space-y-4 md:space-y-6">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div>
                                    <label data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                        for="email" class="block mb-2 text-sm font-medium text-white">Email</label>
                                    <input data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                        type="email" name="email" id="email"
                                        class="{{ $errors->has('email') || $errors->has('email_error') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700 focus:ring-red-500 focus:border-red-500' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-2 text-sm mt-3 block w-full p-2.5"
                                        placeholder="Masukkan email mu" value="{{ old('email', session('last_email')) }}"
                                        required autocomplete="email" autofocus>
                                    @error('email')
                                        <p data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                            class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div>
                                    <label data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                        for="password" class="block mb-2 text-sm font-medium text-white">Password
                                        Baru</label>
                                    <div data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                        class="relative">
                                        <input type="password" name="password" id="password"
                                            placeholder="Masukkan password mu"
                                            class="{{ $errors->has('password') || $errors->has('password_error') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700 focus:ring-red-500 focus:border-red-500' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-2 text-sm mt-3 block w-full p-2.5"
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
                                        <p data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                            class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div>
                                    <label data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                        for="password_confirmation"
                                        class="block mb-2 text-sm font-medium text-white">Konfirmasi Password</label>
                                    <div data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                        class="relative">
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            placeholder="Konfirmasi password"
                                            class="{{ $errors->has('password') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700 focus:ring-red-500 focus:border-red-500 focus:ring-red-500 focus:border-red-500' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-2 text-sm mt-3 block w-full p-2.5"
                                            required autocomplete="current-password" autofocus>
                                        <button type="button" id="toggle-password_confirmation"
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                                            <svg id="eye-icon-open_confirmation" class="w-6 h-6 text-gray-300"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="currentColor" viewBox="0 0 24 24"
                                                style="display: none;">
                                                <path fill-rule="evenodd"
                                                    d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <svg id="eye-icon-closed_confirmation" class="w-6 h-6 text-gray-300"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="currentColor" viewBox="0 0 24 24">
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
                                        <p data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                            class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <button data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                    type="submit"
                                    class="w-full text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Reset
                                    Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script>
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
                var eyeIconOpen = $('#eye-icon-open_confirmation');
                var eyeIconClosed = $('#eye-icon-closed_confirmation');

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
