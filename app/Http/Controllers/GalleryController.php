<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Point;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
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
            return view('gallery_page', [
                "TabTitle" => "Galeri Lisahwan",
                "active_3" => "text-yellow-500 rounded md:bg-transparent md:p-0",
                "pageTitle" => '<mark class="px-2 text-yellow-500 bg-gray-900 rounded dark:bg-gray-900">Galeri</mark> Lisahwan',
                'pageDescription' => 'Kisah Rasa <span class="underline underline-offset-2 decoration-4 decoration-yellow-500">Autentik, Lokal, Homemade,</span> dan <span class="underline underline-offset-2 decoration-4 decoration-yellow-500">Premium</span>',
                "galleries" => Gallery::all(),
                "carts" => $carts,
                "shipment_price" => $shipment_price,
                "admin_fee" => $admin_fee,
                "reward_now" => $reward_now,
                "point" => $point
            ]);
        } else {
            return view('gallery_page', [
                "TabTitle" => "Galeri Lisahwan",
                "active_3" => "text-yellow-500 rounded md:bg-transparent md:p-0",
                "pageTitle" => '<mark class="px-2 text-yellow-500 bg-gray-900 rounded dark:bg-gray-900">Galeri</mark> Lisahwan',
                'pageDescription' => 'Kisah Rasa <span class="underline underline-offset-2 decoration-4 decoration-yellow-500">Autentik, Lokal, Homemade,</span> dan <span class="underline underline-offset-2 decoration-4 decoration-yellow-500">Premium</span>',
                "galleries" => Gallery::all()
            ]);
        }
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
