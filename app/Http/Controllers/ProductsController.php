<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Http\Requests\StoreProductsRequest;
use App\Http\Requests\UpdateProductsRequest;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index', [
            "carousel_1" => "",
            "carousel_2" => "",
            "carousel_3" => "",
            "TabTitle" => "Lisahwan Products",
            'pageTitle' => '<mark class="px-2 text-yellow-500 bg-gray-800 rounded dark:bg-gray-800">Produk </mark> Kami',
            'pageDescription' => 'Telusuri Kenikmatan Rasa <span class="underline underline-offset-2 decoration-4 decoration-yellow-500">Kualitas</span> melalui Produk Homemade <span class="underline underline-offset-2 decoration-4 decoration-amber-400">Lisahwan</span>',
            "active_1" => "text-white rounded md:bg-transparent md:text-yellow-500 md:p-0 md:dark:text-yellow-500",

            "products" => Products::all(),
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
    public function store(StoreProductsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductsRequest $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        //
    }
}
