@extends('layouts.admin.frame_admin')

@section('content_page')

    <section class="bg-neutral-200 p-2 sm:p-4 antialiased h-full">
        <div class="mx-auto max-w-screen-2xl pt-24 sm:ml-56">
            <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">

                <div class="flex flex-col md:flex-row gap-8 p-8">
                    <div class="relative h-96 w-96 p-2 mb-2 bg-gray-100 rounded-lg">
                        @if (strlen($productDetail->image) > 25)
                            <img src="{{ asset('storage/' . $productDetail->image) }}"
                                class="h-full w-full object-contain rounded-lg" alt="product Image">
                        @else
                            <img src="/images/fotoproduk/{{ $productDetail->image }}"
                                class="h-full w-full object-contain rounded-lg" alt="product Image">
                        @endif

                        <div class="absolute top-0 right-0 m-4 text-lg text-red-600 rounded-full font-bold bg-gray-900 p-4">
                            {{ $productDetail->discount }}%</div>
                    </div>
                    <div class="flex-col items-center md:items-start">
                        <div>
                            <h4 class="mb-1.5 leading-none text-2xl font-semibold text-gray-900">
                                {{ $productDetail->name }}</h4>
                            <h5 class="text-lg font-bold text-gray-900">Rp.
                                {{ number_format($productDetail->price, 0, ',', '.') }}</h5>
                            <div class="flex items-center">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $productDetail->testimony->pluck('rating')->average())
                                        <svg class="w-5 h-5 text-yellow-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path
                                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-yellow-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="m11.479 1.712 2.367 4.8a.532.532 0 0 0 .4.292l5.294.769a.534.534 0 0 1 .3.91l-3.83 3.735a.534.534 0 0 0-.154.473l.9 5.272a.535.535 0 0 1-.775.563l-4.734-2.49a.536.536 0 0 0-.5 0l-4.73 2.487a.534.534 0 0 1-.775-.563l.9-5.272a.534.534 0 0 0-.154-.473L2.158 8.48a.534.534 0 0 1 .3-.911l5.294-.77a.532.532 0 0 0 .4-.292l2.367-4.8a.534.534 0 0 1 .96.004Z" />
                                        </svg>
                                    @endif
                                    </svg>
                                @endfor

                                @if ($productDetail->testimony->isNotEmpty())
                                    <span
                                        class="text-gray-500 ml-2">{{ number_format($productDetail->testimony->pluck('rating')->average(), 2) }}</span>
                                @else
                                    <span class="text-gray-500 ml-2">No reviews yet.</span>
                                @endif
                            </div>
                            <h5 class="mb-5 text-md text-gray-900">
                                {{ $productDetail->weight }} gram</h5>
                        </div>

                        <button type="button" data-modal-target="update-image-modal" data-modal-toggle="update-image-modal"
                            class="py-2 mb-4 px-3 flex items-center text-sm font-medium text-center text-gray-700 bg-primary-700 border border-gray-500 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300">
                            {{-- {{ $product_to_update = Product::where('id', $product->id)->first() }} --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                <path fill-rule="evenodd"
                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                    clip-rule="evenodd" />
                            </svg>
                            Edit Foto Produk
                        </button>

                        <h5 class="mb-4 text-base text-gray-900">
                            {{ $productDetail->description }}</h5>

                        <form id="add-stock-form" action="{{ route('owner.admin_products.addStock', $productDetail) }}"
                            method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf

                            <div class="flex flex-row gap-4 items-end">
                                <div class="mt-4 w-1/2 md:w-1/4">
                                    <label for="stock" class="block mb-2 text-sm font-medium text-gray-900">Tambah
                                        stok</label>
                                    <input type="number" name="stock" id="stock"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                        placeholder="Contoh: 10" required="">
                                    @error('stock')
                                        <p class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <button type="submit"
                                    class="h-1/2 w-full sm:w-auto justify-center text-white inline-flex bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    Add
                                </button>
                            </div>
                        </form>

                    </div>

                </div>


                <table class="m-8 w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Quantity
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($productDetail->production->count() == 0)
                            <tr>
                                <td colspan="3" class="p-4 text-center">
                                    <p class="text-gray-400">Belum ada histori stock
                                    </p>
                                </td>
                            </tr>
                        @else
                            @foreach ($productDetail->production as $stock_history)
                                <tr class="bg-white border-b">
                                    <td scope="row" class="px-6 py-4">
                                        {{ $stock_history->date }}
                                    </td>

                                    @if ($stock_history->type == 'tambah')
                                        <td class="px-6 py-4 text-green-400">
                                            + {{ $stock_history->quantity }}
                                        </td>
                                    @else
                                        <td class="px-6 py-4 text-red-700">
                                            - {{ $stock_history->quantity }}
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>


        <form id="update-form" action="{{ route('owner.admin_products.updateImage', $productDetail) }}" method="POST"
            enctype="multipart/form-data">
            @method('put')
            @csrf

            <input type="hidden" name="oldImage" value="{{ $productDetail->image }}">

            <div id="update-image-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] md:h-full">
                <div class="relative p-4 w-full max-w-3xl h-full md:h-auto">
                    <!-- Modal content -->
                    <div id="update-modal-content" class="relative p-4 bg-white rounded-lg shadow sm:p-5">
                        <!-- Modal header -->
                        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                            <h3 class="text-lg font-semibold text-gray-900">Update Foto Produk</h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                data-modal-toggle="update-image-modal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->


                        <div class="mb-4">
                            <span class="block mb-2 text-sm font-medium text-gray-900">Product Image</span>

                            <div id="existingImagePreviewId" class="mb-3">
                                @if ($productDetail->image)
                                    <img src="{{ asset('') . $productDetail->image }}"
                                        class="w-1/2 md:w-1/4 mx-auto rounded-lg object-cover" />
                                @endif
                            </div>
                            <label for="image"
                                class="flex flex-col justify-center items-center w-full h-44 bg-gray-50 rounded-lg border-1 border-gray-300 border-dashed cursor-pointer hover:bg-gray-100">
                                <input type="file" name="image" id="image" class="hidden"
                                    onchange="displayImagePreview_Update(this, '{{ $productDetail->image }}', 'existingImagePreviewId')">
                                <div class="flex flex-col justify-center items-center w-full pt-5 pb-6">
                                    <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
                            @error('image')
                                <p class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                </p>
                            @enderror
                        </div>


                        <div class="items-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                            <button type="submit"
                                class="w-full sm:w-auto justify-center text-white inline-flex bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update
                                product</button>

                            <button data-modal-toggle="update-image-modal" type="button"
                                class="w-full justify-center sm:w-auto text-white inline-flex items-center bg-red-500 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                                <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                                Batal
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </form>

    </section>

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
                        'w-1/2 md:w-1/4 mx-auto rounded-lg object-cover');
                    preview.append(img);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }


        function displayImagePreview_Update(input, existingImageUrl, existingImagePreviewId) {
            var preview = $('#' + existingImagePreviewId);

            // Remove existing image
            preview.empty();

            // Display newly uploaded image
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = $('<img>').attr('src', e.target.result).addClass(
                        'w-1/2 md:w-1/4 mx-auto rounded-lg object-cover');
                    preview.append(img);
                };
                reader.readAsDataURL(input.files[0]);
            } else if (existingImageUrl) {
                // Display existing image if available
                var existingImg = $('<img>').attr('src', '{{ asset('') }}' + existingImageUrl).addClass(
                    'w-1/2 md:w-1/4 mx-auto rounded-lg object-cover');
                preview.append(existingImg);
            }
        }
    </script>
@endsection
