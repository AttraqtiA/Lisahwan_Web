<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller; // tambah ini buat yg folder per role

use App\Models\Product;
use App\Models\Production;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('customer.products', [
            "TabTitle" => "Produk Lisahwan",
            "pageTitle" => '<mark class="px-2 text-yellow-500 bg-gray-800 rounded dark:bg-gray-800">Produk</mark> Kami',
            'pageDescription' => 'Jelajahi camilan terbaik di <span class="underline underline-offset-2 decoration-4 decoration-yellow-500">Lisahwan</span> dan pilih favorit Anda sekarang!',
            "active_2" => "text-white rounded md:bg-transparent md:text-yellow-500 md:p-0 md:dark:text-yellow-500",
            "products" => Product::all(),
        ]);
    }

    public function admin_products(Request $request)
    {
        if ($request->has('search')) {
            $products = Product::where('name', 'like', '%' . $request->search . '%')->orWhere('price', 'like', '%' . $request->search . '%')->paginate(10)->withQueryString();
        } else {
            $products = Product::paginate(10);
        }

        return view('admin.products', [
            "active_3" => "text-yellow-500",
            "products" => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|unique:products',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'weight' => 'required|numeric',
            'discount' => 'required|numeric',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5000', // ini untuk validasi file image
        ]);

        // cek apakah ada inputan file berupa image, kalau ada file image dimasukkan ke folder image di public lalu pathnya masuk ke database
        if ($request->file('image')) {

            $validatedData['image'] = $request->file('image')->store('upload_images', ['disk' => 'public']);
            // disk public ini untuk membuat folder upload_images di folder storage/app/public
            // function store ini akan memasukkan gambar ke dalam storage/public/nama_folder_image
            // dengan nama file yang sudah merupakan string random sehingga memungkinkan kita untuk
            // memasukkan file gambar dengan nama yang sama tapii beda gambar.

            $product = Product::create([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'stock' => $validatedData['stock'],
                'weight' => $validatedData['weight'],
                'discount' => $validatedData['discount'],
                'image' => $validatedData['image'],
            ]);

            Production::create([
                'date' => now(),
                'product_id' => $product->id,
                'quantity' => $validatedData['stock'],
                'type' => 'tambah'
            ]);
        } else {
            $product = Product::create([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'stock' => $validatedData['stock'],
                'weight' => $validatedData['weight'],
                'discount' => $validatedData['discount'],
            ]);

            Production::create([
                'date' => now(),
                'product_id' => $product->id,
                'quantity' => $validatedData['stock'],
                'type' => 'tambah'
            ]);
        }

        return redirect()->route('owner.admin_products');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('customer.orderdetail', [
            "TabTitle" => $product->name,
            // "active_2" => "text-white rounded md:bg-transparent md:text-yellow-500 md:p-0 md:dark:text-yellow-500",
            "product" => $product,
        ]);
    }


    public function detail(Product $product) // show buat for admin
    {
        $productDetail = Product::where('id', $product->id)->first();

        return view('admin.production_detail', [
            "active_3" => "text-yellow-500",
            "productDetail" => $productDetail,
        ]);
    }

    public function addStock(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'stock' => 'required|numeric',
        ]);

        $product->update([
            'stock' => $product->stock + $validatedData['stock'],
        ]);

        Production::create([
            'date' => now(),
            'product_id' => $product->id,
            'quantity' => $validatedData['stock'],
            'type' => 'tambah'
        ]);

        return redirect()->route('owner.admin_products.detail', $product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Product $product)
    // {
    //     $productEdit = Product::where('id', $product->id)->first();

    //     return view('admin.update_product', compact('productEdit'));
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'weight' => 'required|numeric',
            'discount' => 'required|numeric',
            'description' => 'required',
        ]);

        $product->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'weight' => $validatedData['weight'],
            'discount' => $validatedData['discount'],
        ]);


        return redirect()->route('owner.admin_products');
    }

    public function updateImage(Request $request, Product $product)
    {

        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5000', // ini untuk validasi file image
        ]);

        // cek apakah ada inputan file berupa image, kalau ada file image dimasukkan ke folder image di public lalu pathnya masuk ke database
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::disk('public')->delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('upload_images', ['disk' => 'public']);
            // disk public ini untuk membuat folder upload_images di folder storage/app/public
            // function store ini akan memasukkan gambar ke dalam storage/public/nama_folder_image
            // dengan nama file yang sudah merupakan string random sehingga memungkinkan kita untuk
            // memasukkan file gambar dengan nama yang sama tapii beda gambar.

            $product->update([
                'image' => $validatedData['image'],
            ]);
        }

        return redirect()->route('owner.admin_products.detail', $product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('owner.admin_products');
    }
}
