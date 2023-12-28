<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('gallery_page', [
            "TabTitle" => "Galeri Lisahwan",
            "active_3" => "text-yellow-500 rounded md:bg-transparent md:p-0",
            "pageTitle" => '<mark class="px-2 text-yellow-500 bg-gray-900 rounded dark:bg-gray-900">Galeri</mark> Lisahwan',
            'pageDescription' => 'Kisah Rasa <span class="underline underline-offset-2 decoration-4 decoration-yellow-500">Autentik, Lokal, Homemade,</span> dan <span class="underline underline-offset-2 decoration-4 decoration-yellow-500">Premium</span>',
            "galleries" => Gallery::all(),
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
    public function store(StoreGalleryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        //
    }
}
