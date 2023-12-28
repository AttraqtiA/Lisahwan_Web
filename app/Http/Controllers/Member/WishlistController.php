<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wishlists = Wishlist::where('user_id', Auth::user()->id)->get();
        $cart_user = Cart::where('user_id', Auth::user()->id)->first();
        if (empty($cart_user)) {
            $carts = null;
        } else {
            $carts = $cart_user->cart_detail;
        }
        return view('customer.wishlist', [
            "TabTitle" => "Wishlist",
            "active_wishlist" => "text-yellow-500 rounded md:bg-transparent md:p-0",
            "pageTitle" => '<mark class="px-2 text-yellow-500 bg-gray-900 rounded">Wishlist</mark>',
            'pageDescription' => 'Tambah produk favorit anda di <span class="underline underline-offset-2 decoration-4 decoration-yellow-500">Wishlist!</span>',
            "wishlists" => $wishlists,
            "carts" => $carts
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
        $user_id = Auth::user()->id;
        $wishlist = Wishlist::where('product_id', $id)->first();
        $product = Product::where('id', $id)->first();
        if ($wishlist) {
            $wishlist->delete();
            $product->update([
                'favorite_status' => '0'
            ]);
            return back()->with('deleteWishlist_success', 'Produk berhasil dihapus dari Wishlist!');
        } else {
            Wishlist::create([
                'user_id' =>  $user_id,
                'product_id' => $id
            ]);
            $product->update([
                'favorite_status' => '1'
            ]);
            return redirect()->route('member.wishlist')->with('addWishlist_success', 'Produk berhasil ditambahkan ke Wishlist!');
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
    public function update(Request $request, Wishlist $wishlist)
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
