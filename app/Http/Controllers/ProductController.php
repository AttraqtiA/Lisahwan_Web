<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('products_page', [
            "TabTitle" => "Lisahwan Snacks Surabaya",
            "pageTitle" => '<mark class="px-2 text-yellow-500 bg-gray-800 rounded dark:bg-gray-800">Produk</mark> Kami',
            'pageDescription' => 'Telusuri Kenikmatan Rasa <span class="underline underline-offset-2 decoration-4 decoration-yellow-500">Kualitas</span> melalui Produk Homemade <span class="underline underline-offset-2 decoration-4 decoration-amber-400">Lisahwan</span>',
            "active_2" => "text-white rounded md:bg-transparent md:text-yellow-500 md:p-0 md:dark:text-yellow-500",
            "products" => Product::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('index', [
            "carousel_1" => "/images/fotoproduk/GalleryCarousel_12.jpeg",
            "carousel_2" => "/images/fotoproduk/GalleryCarousel_3.jpg",
            "carousel_3" => "/images/fotoproduk/GalleryCarousel_10.jpg",
            "carousel_4" => "/images/fotoproduk/GalleryCarousel_11.jpg",

            "TabTitle" => "Lisahwan Snacks Surabaya",
            "active_1" => "text-white rounded md:bg-transparent md:text-yellow-500 md:p-0 md:dark:text-yellow-500",

            "products" => Product::where('best_seller', true)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
