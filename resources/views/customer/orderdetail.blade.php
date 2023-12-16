@extends('layouts.frame_nocarousel')

@section('content_page')
    <div class="grid sm:grid-cols-1 lg:grid-cols-2 gap-x-8 sm:gap-y-14 lg:gap-y-12 p-12 mx-auto">
        <div class="flex flex-col lg:justify-center">
            <img class="lg:h-screen lg:w-screen lg:object-bottom object-cover rounded-lg drop-shadow-md"
                src="/images/fotoproduk/{{ $product->image }}" alt="{{ $product->image }}">
        </div>
        <div class="flex flex-col justify-center">
            <div class="h-full">
                <h1 class="text-4xl font-extrabold dark:text-gray-900">{{ $product->name }}</h1>
                <p class="mt-2 text-xl font-semibold text-gray-900">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                <p class="mt-4 text-base font-medium text-gray-900">Ketersediaan stok: <span
                        class="underline underline-offset-2 decoration-4 decoration-yellow-500">{{ $product->stock }}
                        buah</span>
                </p>
                <hr class="h-px my-4 border-0 dark:bg-gray-400">
                <p class="text-base font-medium text-gray-900">{{ $product->description }}</p>

                <form class="max-w-xs mt-8">
                    <label for="{{ $product->id }}"
                        class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-900">Choose
                        quantity:</label>
                    <div class="relative flex items-center max-w-[8rem]">
                        <button type="button" id="{{ 'input-decrement-' . $product->id }}"
                            onClick="changeQuantity('{{ $product->id }}', -1, '{{ $product->price }}')"
                            class="bg-gray-100 dark:bg-gray-900 dark:hover:bg-gray-800 dark:border-gray-900 hover:bg-gray-800 border border-gray-900 rounded-s-lg p-3 h-11">
                            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1 1h16" />
                            </svg>
                        </button>
                        <input type="text" id="{{ 'input-' . $product->id }}" name="{{ 'input-' . $product->id }}"
                            value="0" data-input-counter data-input-counter-min="1"
                            aria-describedby="helper-text-explanation"
                            class="bg-gray-900 border-x-0 border-gray-900 h-11 text-center text-white text-sm block w-full py-2.5 dark:bg-gray-900 dark:border-gray-900 dark:placeholder-gray-800 dark:text-white"
                            required>
                        <button type="button" id="{{ 'input-increment-' . $product->id }}"
                            onClick="changeQuantity('{{ $product->id }}', 1, '{{ $product->price }}')"
                            class="bg-gray-100 dark:bg-gray-900 dark:hover:bg-gray-800 dark:border-gray-900 hover:bg-gray-800 border border-gray-900 rounded-e-lg p-3 h-11 ">
                            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 1v16M1 9h16" />
                            </svg>
                        </button>
                    </div>
                    <p id="helper-text-explanation" class="mt-2 text-sm text-gray-600 dark:text-gray-600">Mohon isikan
                        jumlah pemesanan anda.</p>
                    <label for="message"
                        class="mt-2 block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-900">Tambahkan
                        catatan:</label>
                    <textarea id="message" rows="2"
                        class="block p-2.5 w-full text-sm text-gray-600 bg-gray-300 rounded-lg border border-yellow-500  dark:bg-gray-300 dark:border-yellow-500 dark:placeholder-gray-300 dark:text-gray-600"
                        placeholder="Write your thoughts here..."></textarea>
                </form>
                <div class="flex flex-row mt-4 items-center">
                    <label for="cost" class="text-sm font-semibold text-gray-900">Subtotal:</label>
                    <input type="text" id="cost" name="cost" aria-label="disabled input 2"
                        class="ml-2 bg-gray-300 border border-yellow-500 text-gray-600 text-sm rounded-lg block w-4/12 lg:w-4/12 p-2.5 cursor-not-allowed dark:bg-gray-300 dark:border-yellow-500 dark:placeholder-gray-400 dark:text-gray-600"
                        value="0" readonly>
                </div>
                <hr class="h-px my-6 border-0 dark:bg-gray-400">
                <div class="flex flex-row mt-2 justify-center">
                    <button type="button"
                        class="text-yellow-500 hover:text-white border border-yellow-500 hover:bg-yellow-500 font-medium rounded-lg text-base px-5 py-2.5 me-2 dark:border-yellow-500 dark:text-yellow-500 dark:hover:text-white dark:hover:bg-yellow-500">Beli
                        Langsung</button>
                    <button type="button"
                        class="text-white bg-yellow-500 hover:bg-yellow-600 font-medium rounded-lg text-base px-5 py-2.5 text-center inline-flex items-center">
                        <svg class="w-3 h-3 mr-2 text-white dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 1v16M1 9h16" />
                        </svg>
                        Keranjang
                    </button>
                </div>
            </div>
        </div>
        <div class="flex flex-col h-full">
            <h1 class="text-3xl font-semibold dark:text-gray-900 sm:text-center lg:text-start">Customer Reviews</h1>
            <hr class="h-px my-2 border-0 dark:bg-gray-400">
            <div class="flex flex-col-reverse">
                @foreach ($testimonies as $testimony)
                    <div class="flex flex-row gap-x-3 mt-3">
                        <div class="flex-none">
                            <img class="w-12 h-12 object-top object-cover rounded-full overflow-hidden"
                                src="/images/testing/{{ $testimony->user->profile_picture }}"
                                alt="{{ $testimony->user->profile_picture }}">
                        </div>
                        <div class="flex flex-col mt-1">
                            <h4 class="text-base font-semibold dark:text-gray-900">{{ $testimony->user->name }}
                            </h4>
                            <p class="text-sm font-normal text-gray-400">
                                {{ date('d F Y', strtotime($testimony->date)) }}</p>
                            @php
                                $count_star = 0;
                            @endphp
                            <div class="flex flex-row mt-3">
                                @for ($i = 1; $i <= $testimony->rating; $i++)
                                    <svg class="w-5 h-5 text-yellow-500 dark:text-yellow-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path
                                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                    @php
                                        $count_star += 1;
                                    @endphp
                                @endfor
                                @if ($count_star < 5)
                                    <svg class="w-5 h-5 text-yellow-500 dark:text-yellow-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="m11.479 1.712 2.367 4.8a.532.532 0 0 0 .4.292l5.294.769a.534.534 0 0 1 .3.91l-3.83 3.735a.534.534 0 0 0-.154.473l.9 5.272a.535.535 0 0 1-.775.563l-4.734-2.49a.536.536 0 0 0-.5 0l-4.73 2.487a.534.534 0 0 1-.775-.563l.9-5.272a.534.534 0 0 0-.154-.473L2.158 8.48a.534.534 0 0 1 .3-.911l5.294-.77a.532.532 0 0 0 .4-.292l2.367-4.8a.534.534 0 0 1 .96.004Z" />
                                    </svg>
                                @endif
                            </div>
                            <p class="mt-2 text-sm font-normal text-gray-900">{{ $testimony->review }}</p>
                            <img class="mt-3 w-2/6 object-center object-cover rounded-lg"
                                src="/images/fotoproduk/{{ $testimony->image }}"
                                alt="{{ $testimony->user->profile_picture }}">
                            @if ($loop->first)
                            @else
                                <hr class="h-px mt-6 border-0 dark:bg-gray-400">
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex flex-row justify-center items-center mt-4">
                {{ $testimonies->links() }}
            </div>
        </div>
        <div class="flex flex-col">
            <div class="flex flex-row justify-between items-center">
                <h1 class="text-3xl font-semibold dark:text-gray-900">Produk Lainnya</h1>
                <a href="/products">
                    <p class="text-sm font-medium text-yellow-500 hover:text-yellow-600">Lihat semua</p>
                </a>
            </div>
            <hr class="h-px my-2 border-0 dark:bg-gray-400">
            <div class = "grid grid-cols-2 gap-3 p-4 mx-auto">
                @foreach ($products_bestseller as $bestseller)
                    <div
                        class="relative hover:shadow-xl transform transition duration-500 hover:-translate-y-4 hover:z-40">
                        <a href="/products/{{ $bestseller->product->id }}">
                            <div
                                class="relative w-full h-full bg-white rounded-lg dark:bg-gray-900 dark:border-gray-800 mx-auto shadow">
                                <img class="h-3/4 rounded-t-lg w-full object-center object-cover"
                                    src="/images/fotoproduk/{{ $bestseller->product->image }}"
                                    alt="{{ $bestseller->product->image }}" />
                                <div class="h-1/4 px-8 pb-2 flex flex-col justify-center items-center">
                                    <h5 class="sm:text-xl font-bold tracking-tight text-yellow-500 text-center">
                                        {{ $bestseller->product->name }}
                                    </h5>
                                    <p class="text-base font-normal text-white text-center"> Rp.
                                        {{ number_format($bestseller->product->price, 0, ',', '.') }}</p>
                                    <p class="text-sm font-normal text-lime-500 text-center mt-2">Tersisa
                                        {{ $bestseller->product->stock }}
                                        stock
                                        lagi</p>
                                </div>

                                <!-- SVG icon di kanan bawah dari gambar -->
                                <svg class="absolute w-6 h-6 text-gray-800 dark:text-white bottom-4 right-4 hover:text-red-600"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 20 18">
                                    <path
                                        d="M17.947 2.053a5.209 5.209 0 0 0-3.793-1.53A6.414 6.414 0 0 0 10 2.311 6.482 6.482 0 0 0 5.824.5a5.2 5.2 0 0 0-3.8 1.521c-1.915 1.916-2.315 5.392.625 8.333l7 7a.5.5 0 0 0 .708 0l7-7a6.6 6.6 0 0 0 2.123-4.508 5.179 5.179 0 0 0-1.533-3.793Z" />
                                </svg>

                                <!-- Diskon di pojok kanan atas -->
                                @if ($bestseller->product->discount == 0)
                                    <div
                                        class="absolute top-0 right-0 m-4 text-lg text-red-600 rounded-full font-bold bg-gray-900 p-4">
                                        {{ $bestseller->product->discount }}%</div>
                                @endif

                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script language="javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var inputElement = document.getElementById('input-{{ $product->id }}');
            var price = '{{ $product->price }}';

            // Fungsi untuk mengupdate subtotal
            function updateSubtotal() {
                var qty = parseInt(inputElement.value);
                qty = isNaN(qty) ? 0 : qty; // Pastikan qty adalah angka

                // Pastikan qty tidak kurang dari 1
                qty = Math.max(qty, 1);

                var total_price = qty * price;
                document.getElementById("cost").value = total_price;
            }

            // Menambahkan event listener untuk event input
            inputElement.addEventListener('input', function() {
                updateSubtotal();
            });

            // Menambahkan event listener untuk tombol decrement
            document.getElementById('input-decrement-{{ $product->id }}').addEventListener('click', function() {
                changeQuantity(-1);
                updateSubtotal();
            });

            // Menambahkan event listener untuk tombol increment
            document.getElementById('input-increment-{{ $product->id }}').addEventListener('click', function() {
                changeQuantity(1);
                updateSubtotal();
            });

            // Fungsi untuk mengubah kuantitas
            function changeQuantity(change) {
                var currentQuantity = parseInt(inputElement.value);

                // Periksa apakah nilai input adalah NaN
                if (isNaN(currentQuantity)) {
                    currentQuantity = 0; // Ganti dengan nilai awal, misalnya 0
                }

                var newQuantity = Math.max(currentQuantity + change, 1);

                inputElement.value = newQuantity;
            }
        });
    </script>
@endsection
