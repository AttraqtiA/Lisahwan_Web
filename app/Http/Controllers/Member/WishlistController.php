<?php

namespace App\Http\Controllers\Member;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Point;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wishlists = Wishlist::where('user_id', Auth::user()->id)->get();
        // Query untuk mendapatkan cart_user yang lebih dari 7 hari
        $cart_user = Cart::where('user_id', Auth::user()->id)
            ->where('created_at', '<', Carbon::now()->subDays(7))
            ->first();
        // Jika cart_user ditemukan dan sudah lebih dari 7 hari, hapus
        if (!empty($cart_user)) {
            $cart_user->delete();
            $carts = null;
            $shipment_price = null;
            $admin_fee = null;
            $reward_now = null;
            $point = null;
        } else {
            // Jika tidak ditemukan cart_user yang lebih dari 7 hari, cari cart_user biasa
            $cart_user = Cart::where('user_id', Auth::user()->id)->first();
            if (empty($cart_user)) {
                $carts = null;
                $shipment_price = null;
                $admin_fee = null;
                $reward_now = null;
                $point = null;
            } else {
                $shipment_price = $cart_user->shipment_price;
                $admin_fee = $cart_user->admin_fee;

                // REWARD POIN SYSTEM
                $point = Point::first();
                if ($point) {
                    $total_price = $cart_user->cart_detail->sum('price');
                    $total_poin = $total_price * ($point->percentage_from_totalprice / 100);

                    // Membulatkan ke bawah ke kelipatan 1000 terdekat
                    $total_poin = floor($total_poin / 10) * 10; // Membulatkan ke kelipatan 10
                    $poin_to_money = $total_poin * $point->money_per_poin;

                    $cart_user->update([
                        'total_poin' => $total_poin
                    ]);

                    $customer = User::where('id', Auth::user()->id)->first();
                    $reward_now = $customer->reward * $point->money_per_poin;
                } else {
                    $total_poin = 0;
                    $poin_to_money = 0;
                    $reward_now = 0;
                }
                //

                $carts = $cart_user->cart_detail;
            }
        }
        return view('customer.wishlist', [
            "TabTitle" => "Wishlist",
            "active_wishlist" => "text-yellow-500 rounded md:bg-transparent md:p-0",
            "pageTitle" => '<mark class="px-2 text-yellow-500 bg-gray-900 rounded">Wishlist</mark>',
            'pageDescription' => 'Tambah produk favorit anda di <span class="underline underline-offset-2 decoration-4 decoration-yellow-500">Wishlist!</span>',
            "wishlists" => $wishlists,
            "carts" => $carts,
            "shipment_price" => $shipment_price,
            "admin_fee" => $admin_fee,
            "reward_now" => $reward_now,
            "point" => $point
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
        // $product = Product::where('id', $id)->first();
        if ($wishlist) {
            $wishlist->delete();
            $wishlist->update([
                'favorite_status' => '0'
            ]);
            return back()->with('deleteWishlist_success', 'Produk berhasil dihapus dari Wishlist!');
        } else {
            Wishlist::create([
                'user_id' =>  $user_id,
                'product_id' => $id,
                'favorite_status' => '1'
            ]);
            // $product->update([
            //     'favorite_status' => '1'
            // ]);
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
