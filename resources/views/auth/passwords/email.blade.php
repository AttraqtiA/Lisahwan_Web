@extends('layouts.frame_auth')

@section('content_page')
    <div class="">
        <div class="row justify-center">
            <section style="background-image: url('/images/fotoproduk/GalleryCarousel_10.jpg')"
                class="bg-cover bg-center bg-no-repeat bg-gray-700 bg-blend-multiply">
                <div class="flex flex-col items-center justify-center p-8 mx-auto md:h-screen lg:py-0">
                    <div class="w-full rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 bg-gray-900">
                        @if (session('status'))
                            <div class="w-full flex justify-center items-center p-0 pt-8 text-xs sm:text-sm rounded-lg bg-gray-900 text-green-400"
                                role="alert">
                                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                </svg>
                                <span class="sr-only">Info</span>
                                <div>
                                    <span class="font-medium">{{ session('status') }}
                                </div>
                            </div>
                        @endif
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <h1 class="text-xl font-bold leading-tight tracking-tight md:text-2xl text-yellow-500">
                                Reset Password
                            </h1>
                            <form method="POST" action="{{ route('password.email') }}" class="space-y-4 md:space-y-6">
                                @csrf
                                <span class="text-gray-400 font-normal text-sm">
                                    Masukkan alamat email yang terhubung dengan akun Anda, dan kami akan segera mengirimkan
                                    tautan untuk mereset kata sandi Anda.
                                </span>
                                <div>
                                    <label for="email" class="block mb-2 text-sm font-medium text-white">Email</label>
                                    <input type="email" name="email" id="email"
                                        class="{{ $errors->has('email') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700 focus:ring-red-500 focus:border-red-500' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-2 text-sm mt-3 block w-full p-2.5"
                                        placeholder="Masukkan email mu" value="{{ old('email', session('last_email')) }}"
                                        required autocomplete="email" autofocus>
                                    @error('email')
                                        <p class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <button type="submit"
                                    class="w-full text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Kirim
                                    Link Reset Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
