<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use App\Http\Requests\StoreWishlistRequest;
use App\Http\Requests\UpdateWishlistRequest;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wishlists = Wishlist::where('user_id', 1)->get();
        return view('customer.wishlist', [
            "TabTitle" => "Wish List",
            "pageTitle" => '<mark class="px-2 text-yellow-500 bg-gray-800 rounded dark:bg-gray-800">Wish List</mark>',
            'pageDescription' => 'Tambah produk favorit anda di <span class="underline underline-offset-2 decoration-4 decoration-yellow-500">Wish List!</span>',
            "wishlists" => $wishlists
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
    public function store($id)
    {
        $user_id = 1;
        $wishlist = Wishlist::where('product_id', $id)->first();
        $product = Product::where('id', $id)->first();
        if ($wishlist) {
            $wishlist->delete();
            $product->update([
                'favorite_status' => '0'
            ]);
            return back()->with('deleteWishlist_success', 'Produk berhasil dihapus dari Wish List!');
        } else {
            Wishlist::create([
                'user_id' =>  $user_id,
                'product_id' => $id
            ]);
            $product->update([
                'favorite_status' => '1'
            ]);
            return redirect('/wishlist')->with('addWishlist_success', 'Produk berhasil ditambahkan ke Wish List!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Wishlist $wishlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWishlistRequest $request, Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wishlist $wishlist)
    {
        //
    }
}
