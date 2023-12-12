@extends('layouts.frame_nocarousel')

@section('content_page')
    <div class="flex flex-col lg:flex-row p-12">
        <div class="flex flex-col items-center">
            <img class="md:h-2/4 lg:h-4/5 w-full object-bottom object-cover rounded-lg drop-shadow-md"
                src="/images/fotoproduk/{{ $product->image }}" alt="{{ $product->image }}">
        </div>
        <div class="flex flex-col lg:ml-7">
            <h1 class="sm:mt-6 md:mt-6 text-4xl font-extrabold dark:text-gray-900">{{ $product->name }}</h1>
            <p class="mt-2 text-xl font-semibold text-gray-900">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
            <p class="mt-4 text-base font-medium text-gray-900">Ketersediaan stok: <span
                    class="underline underline-offset-2 decoration-4 decoration-yellow-500">{{ $product->stock }} buah</span>
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

            <div class="flex sm:flex-col lg:flex-row mt-4 lg:items-center  lg:space-x-12">
                <div class="flex sm:flex-col sm:justify-center lg:flex-row lg:items-center">
                    <label for="cost" class="text-sm font-semibold text-gray-900">Subtotal:</label>
                    <input type="text" id="cost" name="cost" aria-label="disabled input 2"
                        class="sm:mt-2 lg:mt-0 lg:ml-2 bg-gray-300 border border-yellow-500 text-gray-600 text-sm rounded-lg  block w-4/12 lg:w-8/12 p-2.5 cursor-not-allowed dark:bg-gray-300 dark:border-yellow-500 dark:placeholder-gray-400 dark:text-gray-600"
                        value="0" readonly>
                </div>
                <div class="flex lg:flex-row sm:items-center sm:justify-center sm:mt-8 lg:mt-0">
                    <button type="button"
                        class="text-yellow-500 hover:text-white border border-yellow-500 hover:bg-yellow-500 font-medium rounded-lg text-base px-5 py-2.5 text-center me-2 dark:border-yellow-500 dark:text-yellow-500 dark:hover:text-white dark:hover:bg-yellow-500">Beli
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
