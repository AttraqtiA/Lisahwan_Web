@extends('layouts.admin.frame_admin')

@section('content_page')
    <!-- Start block -->
    <section class="bg-neutral-200 p-2 sm:p-4 antialiased">
        <div class="bg-neutral-200 mx-auto max-w-screen-2xl pt-20 sm:pt-24 sm:ml-56">
            <div
                class="flex flex-col justify-center items-center w-full {{ session('addCategory_success') || session('updateCategory_success') || session('deleteCategory_success') || $errors->any() ? 'mb-6 mt-10 sm:mb-10 sm:mt-4' : '' }}">
                @if (session('addCategory_success'))
                    <div data-aos="zoom-in-down" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                        class="w-10/12 md:w-9/12 lg:w-6/12 flex justify-center items-center p-4 mb-2 text-sm rounded-lg bg-gray-900 text-green-400"
                        role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">{{ session('addCategory_success') }}</span>
                        </div>
                    </div>
                @endif
                @if (session('updateCategory_success'))
                    <div data-aos="zoom-in-down" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                        class="w-10/12 md:w-9/12 lg:w-6/12 flex justify-center items-center p-4 mb-2 text-sm rounded-lg bg-gray-900 text-green-400"
                        role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">{{ session('updateCategory_success') }}</span>
                        </div>
                    </div>
                @endif
                @if (session('deleteCategory_success'))
                    <div data-aos="zoom-in-down" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                        class="w-10/12 md:w-9/12 lg:w-6/12 flex justify-center items-center p-4 mb-2 text-sm rounded-lg bg-gray-900 text-green-400"
                        role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">{{ session('deleteCategory_success') }}</span>
                        </div>
                    </div>
                @endif
                @if ($errors->any())
                    <div data-aos="zoom-in-down" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                        class="w-10/12 md:w-9/12 lg:w-6/12 flex flex-col justify-center p-4 text-sm rounded-lg bg-gray-900 text-red-400"
                        role="alert">
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                            </svg>
                            <span class="font-medium">Pastikan semua input diisi dengan benar:</span>
                        </div>
                        <ul class="mt-1.5 list-disc list-inside ml-7">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="bg-white relative shadow-md rounded-md sm:rounded-lg overflow-hidden m-2 mt-8 sm:m-0">
                <div
                    class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="flex-1 flex items-center space-x-2">
                        <h5 data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800">
                            <span class="text-gray-500">Semua Kategori:</span>
                            <span class="text-gray-500">{{ $categories->count() }}</span>
                        </h5>
                    </div>
                    <div data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                        class="text-lg font-bold text-gray-800">
                        Daftar Kategori
                    </div>
                </div>
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-end mx-4 py-4 border-t">
                    <div data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                        class="flex flex-row justify-center mt-2 lg:mt-0">
                        <button type="button" data-modal-target="createCategoryModal"
                            data-modal-toggle="createCategoryModal"
                            class="flex flex-row items-center justify-center w-44 cursor-pointer text-yellow-500 bg-gray-900 hover:bg-gray-950 font-medium rounded-lg text-xs md:text-sm px-3 py-2.5 text-center">
                            <svg class="w-4 h-4 mr-2 text-yellow-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4.243a1 1 0 1 0-2 0V11H7.757a1 1 0 1 0 0 2H11v3.243a1 1 0 1 0 2 0V13h3.243a1 1 0 1 0 0-2H13V7.757Z"
                                    clip-rule="evenodd" />
                            </svg>
                            Tambah Kategori
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto overflow-y-hidden">
                    <table class="w-full text-sm text-center text-gray-500">
                        <thead data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                            class="text-xs text-center text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="p-4">No.</th>
                                <th scope="col" class="p-4">Nama Kategori</th>
                                <th scope="col" class="p-4">Jumlah Produk</th>
                                <th scope="col" class="p-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($categories->count() == 0)
                                <tr data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800">
                                    <td colspan="4" class="p-4 text-center">
                                        <p class="text-gray-400">Belum ada kategori yang terdaftar</p>
                                    </td>
                                </tr>
                            @else
                                @foreach ($categories as $index => $category)
                                    <tr data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800"
                                        class="border-b hover:bg-gray-100">
                                        <td class="p-4 w-4 text-center">
                                            {{ $index + 1 }}
                                        </td>
                                        <td scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $category->name }}
                                        </td>
                                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $category->products->count() }} Produk
                                        </td>
                                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                            <div class="flex items-center justify-center space-x-2">
                                                <!-- Tombol Edit -->
                                                <button type="button" data-modal-target="edit-modal-{{ $category->id }}"
                                                    data-modal-toggle="edit-modal-{{ $category->id }}"
                                                    class="py-2 px-3 flex items-center text-sm font-medium text-center text-gray-600 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5"
                                                        viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path
                                                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                        <path fill-rule="evenodd"
                                                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Edit
                                                </button>

                                                <!-- Tombol Hapus -->
                                                <button type="button"
                                                    data-modal-target="delete-modal-{{ $category->id }}"
                                                    data-modal-toggle="delete-modal-{{ $category->id }}"
                                                    class="flex items-center text-red-500 hover:text-white border border-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5"
                                                        viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Tambah Kategori -->
            <div id="createCategoryModal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
                        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                            <h3 class="text-lg font-semibold text-gray-900">Tambah Kategori</h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                data-modal-target="createCategoryModal" data-modal-toggle="createCategoryModal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <form action="{{ route('owner.admin_categories.store') }}" method="POST">
                            @csrf
                            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                <div class="sm:col-span-2">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama
                                        Kategori</label>
                                    <input type="text" name="name" id="name"
                                        class="{{ $errors->has('name') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700 focus:ring-red-500 focus:border-red-500' : 'bg-white border border-yellow-500 text-gray-900 placeholder-gray-400 focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg block w-full p-2.5 mt-3"
                                        placeholder="Contoh: Hampers Lebaran" value="{{ old('name') }}" required>
                                </div>
                            </div>
                            <div class="items-center space-y-2 sm:flex sm:space-y-0 sm:space-x-2">
                                <button type="submit"
                                    class="w-full sm:w-auto justify-center text-white inline-flex bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    Tambah Kategori
                                </button>
                                <button data-modal-toggle="createCategoryModal" type="button"
                                    class="w-full sm:w-auto justify-center text-white inline-flex bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
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

            @foreach ($categories as $category)
                <!-- Modal Edit Kategori -->
                <div id="edit-modal-{{ $category->id }}" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
                            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                                <h3 class="text-lg font-semibold text-gray-900">Edit Kategori</h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                    data-modal-target="edit-modal-{{ $category->id }}"
                                    data-modal-toggle="edit-modal-{{ $category->id }}">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <form action="{{ route('owner.admin_categories.update', $category->id) }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                    <div class="sm:col-span-2">
                                        <label for="name_edit" class="block mb-2 text-sm font-medium text-gray-900">Nama
                                            Kategori</label>
                                        <input type="text" name="name_edit" id="name_edit"
                                            value="{{ old('name_edit', $category->name) }}"
                                            class="{{ $errors->has('name_edit') ? 'bg-red-100 border-red-400 text-red-500 placeholder-red-700 focus:ring-red-500 focus:border-red-500' : 'bg-white border border-yellow-500 text-gray-900 placeholder-gray-400 focus:ring-yellow-500 focus:border-yellow-500' }} rounded-lg block w-full p-2.5 mt-3"
                                            required>
                                    </div>
                                </div>
                                <div class="items-center space-y-2 sm:flex sm:space-y-0 sm:space-x-2">
                                    <button type="submit"
                                        class="w-full sm:w-auto justify-center text-white inline-flex bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                        Perbarui Kategori
                                    </button>
                                    <button data-modal-toggle="edit-modal-{{ $category->id }}" type="button"
                                        class="w-full sm:w-auto justify-center text-white inline-flex bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
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

                <!-- Modal Hapus Kategori -->
                <div id="delete-modal-{{ $category->id }}" tabindex="-1"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow">
                            <form action="{{ route('owner.admin_categories.destroy', $category->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="button"
                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                    data-modal-hide="delete-modal-{{ $category->id }}">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500">Anda yakin ingin
                                        menghapus kategori <br><strong>{{ $category->name }}</strong>?</h3>
                                    <p class="text-sm text-gray-400 mb-5">Semua produk di dalamnya <b>TIDAK</b> akan ikut
                                        terhapus, melainkan akan dipindahkan statusnya menjadi tanpa kategori.</p>
                                    <div
                                        class="w-full justify-center items-center flex flex-col sm:flex-row space-y-2 sm:space-x-2 sm:space-y-0">
                                        <button type="submit"
                                            class="w-full justify-center text-white inline-flex bg-red-500 hover:bg-red-600 focus:ring-2 focus:outline-none focus:ring-yellow-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                            Ya, yakin
                                        </button>
                                        <button data-modal-hide="delete-modal-{{ $category->id }}" type="button"
                                            class="w-full justify-center text-gray-500 items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
