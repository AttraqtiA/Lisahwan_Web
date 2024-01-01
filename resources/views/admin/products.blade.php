@extends('layouts.admin.frame_admin')

@section('content_page')

    <!-- Start block -->
    <section class="bg-neutral-200 p-2 sm:p-4 antialiased h-full">
        <div class="mx-auto max-w-screen-2xl pt-24 sm:ml-56">
            <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="flex-1 flex items-center space-x-2">
                        <h5>
                            <span class="text-gray-500">Semua Produk:</span>
                            <span class="text-gray-500">{{ $products->count() }}</span>
                        </h5>
                        <h5 class="text-gray-500 ml-1">(1-{{ (int) ceil($products->count() / 10) }})</h5>
                    </div>
                    <div class="text-lg font-bold text-gray-800">
                        Daftar Produk
                    </div>
                </div>
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t">
                    <div class="w-full md:w-1/3">
                        <form class="flex items-center" action="{{ route('owner.admin_products') }}" method="GET">

                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor"
                                        viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
                                    </svg>
                                </div>
                                <input type="search" name="search" id="simple-search" placeholder="Cari produk"
                                    required=""
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2">
                            </div>

                            <button type="submit" class="bg-yellow-500 ml-2 p-2 rounded-lg text-sm">
                                <p class="font-semibold text-white px-2">Search</p>
                            </button>

                        </form>
                    </div>
                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <button type="button" id="createProductButton" data-modal-toggle="createProductModal"
                            class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none">
                            <svg class="h-3.5 w-3.5 mr-1.5 -ml-1" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>

                            <p class="text-gray-500">+ Tambah Produk</p>

                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-center text-gray-500">
                        <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="p-4">No.</th>
                                <th scope="col" class="p-4">Nama</th>
                                <th scope="col" class="p-4">Harga</th>
                                <th scope="col" class="p-4">Stok</th>
                                <th scope="col" class="p-4">Berat</th>
                                <th scope="col" class="p-4">Rating</th>
                                <th scope="col" class="p-4">Diskon</th>
                                <th scope="col" class="p-4">Terjual</th>
                                <th scope="col" class="p-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($products->count() == 0)
                                <tr>
                                    <td colspan="6" class="p-4 text-center">
                                        <p class="text-gray-400">Belum ada product yang terdaftar</p>
                                    </td>
                                </tr>
                            @else
                                @foreach ($products as $product)
                                    <tr class="border-b hover:bg-gray-100">
                                        <td class="p-4 w-4">
                                            {{ $loop->index + ($products->currentPage() - 1) * $products->perPage() + 1 }}
                                        </td>
                                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                            <div class="flex items-center mr-3">
                                                @if (strlen($product->image) > 25)
                                                    <img src="{{ asset('storage/' . $product->image) }}" alt="product image"
                                                        class="w-8 h-8 mr-3 object-cover object-center rounded-md">
                                                @else
                                                    <img src="/images/fotoproduk/{{ $product->image }}" alt="product image"
                                                        class="w-8 h-8 mr-3 object-cover object-center rounded-md">
                                                @endif

                                                <p>{{ $product->name }}</p>
                                            </div>
                                        </th>
                                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">Rp.
                                            {{ number_format($product->price, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $product->stock }}</td>
                                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $product->weight }}g</td>

                                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                            <div class="flex items-center">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $product->testimony->pluck('rating')->average())
                                                        <svg class="w-5 h-5 text-yellow-500" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            viewBox="0 0 22 20">
                                                            <path
                                                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                        </svg>
                                                    @else
                                                        <svg class="w-5 h-5 text-yellow-500" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 21 20">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m11.479 1.712 2.367 4.8a.532.532 0 0 0 .4.292l5.294.769a.534.534 0 0 1 .3.91l-3.83 3.735a.534.534 0 0 0-.154.473l.9 5.272a.535.535 0 0 1-.775.563l-4.734-2.49a.536.536 0 0 0-.5 0l-4.73 2.487a.534.534 0 0 1-.775-.563l.9-5.272a.534.534 0 0 0-.154-.473L2.158 8.48a.534.534 0 0 1 .3-.911l5.294-.77a.532.532 0 0 0 .4-.292l2.367-4.8a.534.534 0 0 1 .96.004Z" />
                                                        </svg>
                                                    @endif
                                                    </svg>
                                                @endfor

                                                @if ($product->testimony->isNotEmpty())
                                                    <span
                                                        class="text-gray-500 ml-2">{{ number_format($product->testimony->pluck('rating')->average(), 2) }}</span>
                                                @else
                                                    <span class="text-gray-500 ml-2">No reviews yet.</span>
                                                @endif
                                            </div>

                                        </td>


                                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $product->discount }}%</td>

                                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24"
                                                    fill="currentColor" class="w-5 h-5 text-gray-400 mr-2"
                                                    aria-hidden="true">
                                                    <path
                                                        d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" />
                                                </svg>
                                                {{ $product->production->where('type', 'kurang')->sum('quantity') }}
                                            </div>
                                        </td>

                                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                            <div class="flex items-center space-x-4">

                                                <a href="{{ route('owner.admin_products.detail', $product) }}">
                                                    <button type="button"
                                                        class="py-2 px-3 flex items-center text-sm font-medium text-center text-gray-600 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24"
                                                            fill="currentColor" class="w-4 h-4 mr-2 -ml-0.5">
                                                            <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                                        </svg>
                                                        Detail
                                                    </button>
                                                </a>

                                                {{-- <a href="{{ route('owner.admin_products.edit', $product) }}"> --}}
                                                <button type="button"
                                                    data-modal-target="update-modal{{ $product->id }}"
                                                    data-modal-toggle="update-modal{{ $product->id }}"
                                                    class="py-2 px-3 flex items-center text-sm font-medium text-center text-gray-700 bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300">
                                                    {{-- {{ $product_to_update = Product::where('id', $product->id)->first() }} --}}
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5"
                                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path
                                                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                        <path fill-rule="evenodd"
                                                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Edit
                                                </button>

                                                {{-- </a> --}}

                                                <button type="button" data-modal-target="delete-modal"
                                                    data-modal-toggle="delete-modal"
                                                    class="flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center"
                                                    onclick="changeDeleteModal('{{ route('owner.admin_products.destroy', $product) }}')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5"
                                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Delete
                                                </button>

                                            </div>
                                        </td>
                                    </tr>



                                    <form id="update-form" action="{{ route('owner.admin_products.update', $product) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @method('put')
                                        @csrf

                                        <div id="update-modal{{ $product->id }}" tabindex="-1" aria-hidden="true"
                                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                            <div class="relative p-4 w-full max-w-3xl h-full md:h-auto">
                                                <!-- Modal content -->
                                                <div id="update-modal-content"
                                                    class="relative p-4 bg-white rounded-lg shadow sm:p-5">
                                                    <!-- Modal header -->
                                                    <div
                                                        class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                                                        <h3 class="text-lg font-semibold text-gray-900">Update Product</h3>
                                                        <button type="button"
                                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                                            data-modal-toggle="update-modal{{ $product->id }}">
                                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd"
                                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->


                                                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                                        <div>
                                                            <label for="name"
                                                                class="block mb-2 text-sm font-medium text-gray-900">Product
                                                                Name</label>
                                                            <input type="text" name="name" id="name"
                                                                class="{{ $errors->has('name') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm mt-3 block w-full p-2.5"
                                                                value="{{ $product->name }}" required="">
                                                            @error('name')
                                                                <p class="mt-2 text-sm text-red-500"><span
                                                                        class="font-medium">{{ $message }}
                                                                </p>
                                                            @enderror
                                                        </div>

                                                        <div>
                                                            <label for="price"
                                                                class="block mb-2 text-sm font-medium text-gray-900">Harga
                                                                (Rp)
                                                            </label>
                                                            <input type="number" name="price" id="price"
                                                                class="{{ $errors->has('price') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm mt-3 block w-full p-2.5"
                                                                value="{{ $product->price }}" required="">
                                                            @error('price')
                                                                <p class="mt-2 text-sm text-red-500"><span
                                                                        class="font-medium">{{ $message }}
                                                                </p>
                                                            @enderror
                                                        </div>
                                                        <div>
                                                            <label for="weight"
                                                                class="block mb-2 text-sm font-medium text-gray-900">Berat
                                                                (gram)
                                                            </label>
                                                            <input type="number" name="weight" id="weight"
                                                                class="{{ $errors->has('weight') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm mt-3 block w-full p-2.5"
                                                                value="{{ $product->weight }}" required="">
                                                            @error('weight')
                                                                <p class="mt-2 text-sm text-red-500"><span
                                                                        class="font-medium">{{ $message }}
                                                                </p>
                                                            @enderror
                                                        </div>

                                                        <div>
                                                            <label for="discount"
                                                                class="block mb-2 text-sm font-medium text-gray-900">Diskon
                                                                (%)</label>
                                                            <input type="number" name="discount" id="discount"
                                                                class="{{ $errors->has('discount') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm mt-3 block w-full p-2.5"
                                                                value="{{ $product->discount }}" required="">
                                                            @error('discount')
                                                                <p class="mt-2 text-sm text-red-500"><span
                                                                        class="font-medium">{{ $message }}
                                                                </p>
                                                            @enderror
                                                        </div>


                                                        <div class="sm:col-span-2">
                                                            <label for="description"
                                                                class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                                                            <textarea name="description" id="description" rows="4"
                                                                class="{{ $errors->has('description') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm mt-3 block w-full p-2.5">{{ $product->description }}
                                                            </textarea>
                                                            @error('description')
                                                                <p class="mt-2 text-sm text-red-500"><span
                                                                        class="font-medium">{{ $message }}
                                                                </p>
                                                            @enderror
                                                        </div>

                                                        <p
                                                            class="mb-4 text-red-700 text-xs text-center md:text-start sm:col-span-2">
                                                            *Untuk edit foto produk, mohon ke halaman detail</p>
                                                    </div>


                                                    <div class="items-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                                                        <button type="submit"
                                                            class="w-full sm:w-auto justify-center text-white inline-flex bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update
                                                            product</button>

                                                        <button data-modal-toggle="update-modal{{ $product->id }}"
                                                            type="button"
                                                            class="w-full justify-center sm:w-auto text-white inline-flex items-center bg-red-500 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                                                            <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor"
                                                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
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
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <nav class="flex flex-col md:flex-row justify-end items-center space-y-3 md:space-y-0 p-4"
                    aria-label="Table navigation">

                    {{ $products->links('vendor.pagination.tailwind') }}

                </nav>
            </div>
        </div>
    </section>
    <!-- End block -->



    <div id="createProductModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] md:h-full">
        <div class="relative p-4 w-full max-w-3xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                    <h3 class="text-lg font-semibold text-gray-900">Add Product</h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                        data-modal-toggle="createProductModal">
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
                <form action="{{ route('owner.admin_products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Product
                                Name</label>
                            <input type="text" name="name" id="name"
                                class="{{ $errors->has('name') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm mt-3 block w-full p-2.5"
                                placeholder="(Contoh: Teri Oven)" required="">
                            @error('name')
                                <p class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Harga (Rp)</label>
                            <input type="number" name="price" id="price"
                                class="{{ $errors->has('price') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm mt-3 block w-full p-2.5"
                                placeholder="(Contoh: 42000)" required="">
                            @error('price')
                                <p class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="grid gap-4 sm:col-span-2 md:gap-6 sm:grid-cols-4">
                            <div>
                                <label for="weight" class="block mb-2 text-sm font-medium text-gray-900">Berat
                                    (gram)</label>
                                <input type="number" name="weight" id="weight"
                                    class="{{ $errors->has('weight') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm mt-3 block w-full p-2.5"
                                    placeholder="" required="">
                                @error('weight')
                                    <p class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label for="stock" class="block mb-2 text-sm font-medium text-gray-900">Stok</label>
                                <input type="number" name="stock" id="stock"
                                    class="{{ $errors->has('stock') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm mt-3 block w-full p-2.5"
                                    placeholder="" required="">
                                @error('stock')
                                    <p class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label for="discount" class="block mb-2 text-sm font-medium text-gray-900">Diskon
                                    (%)</label>
                                <input type="number" name="discount" id="discount"
                                    class="{{ $errors->has('discount') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm mt-3 block w-full p-2.5"
                                    placeholder="" required="">
                                @error('discount')
                                    <p class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                            <textarea name="description" id="description" rows="4"
                                class="{{ $errors->has('description') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700' : 'bg-white border-yellow-500 text-gray-900 placeholder-gray-400  focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg border-1 text-sm mt-3 block w-full p-2.5"
                                placeholder="Tuliskan deskripsi produk" required=""></textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-500"><span class="font-medium">{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <span class="block mb-2 text-sm font-medium text-gray-900">Product Image</span>

                        <div id="existingImagePreviewId" class="mb-3"></div>
                        <label for="image"
                            class="flex flex-col justify-center items-center w-full h-44 bg-gray-50 rounded-lg border-1 border-gray-300 border-dashed cursor-pointer hover:bg-gray-100">
                            <input type="file" name="image" id="image" class="hidden"
                                onchange="displayImagePreview_Add(this)">
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
                            class="w-full sm:w-auto justify-center text-white inline-flex bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Add
                            product</button>

                        <button data-modal-toggle="createProductModal" type="button"
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
                </form>
            </div>
        </div>
    </div>



    <div id="delete-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full h-auto max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <form id="delete-form" action="{{ route('owner.admin_products.destroy', $product) }}" method="POST">
                    @method('delete')
                    @csrf


                    {{-- onclick="return confirm('Anda yakin hendak menghapus {{ $product->name }}?')" --}}
                    <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                        data-modal-toggle="delete-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14" fill="none"
                            stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500">Apakah anda yakin ingin menghapus produk ini?
                        </h3>


                        <button type="submit" id="delete" name="delete"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">Ya,
                            yakin</button>

                        <button data-modal-toggle="delete-modal" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Tidak,
                            batal</button>
                    </div>
                </form>
            </div>
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

        function changeDeleteModal(url) {
            var deleteForm = $('#delete-form');
            deleteForm.action = url;
        }
    </script>
@endsection
