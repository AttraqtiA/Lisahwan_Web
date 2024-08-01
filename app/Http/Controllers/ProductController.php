<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function home(Request $request)
    {
        if (Session::has('poinStatus')) {
            Session::forget('pointStatus');
        }
        foreach (Cookie::get() as $name => $value) {
            if (strpos($name, 'remember_web_') === 0) {
                // Query untuk mendapatkan cart_user yang lebih dari 7 hari
                $cart_user = Cart::where('user_id', Auth::user()->id)
                    ->where('created_at', '<', Carbon::now()->subDays(7))
                    ->first();
                // Jika cart_user ditemukan dan sudah lebih dari 7 hari, hapus
                if (!empty($cart_user)) {
                    $cart_user->delete();
                    $carts = null;
                } else {
                    // Jika tidak ditemukan cart_user yang lebih dari 7 hari, cari cart_user biasa
                    $cart_user = Cart::where('user_id', Auth::user()->id)->first();
                    if (empty($cart_user)) {
                        $carts = null;
                    } else {
                        $carts = $cart_user->cart_detail;
                    }
                }

                return view('customer.products', [
                    "TabTitle" => "Produk Lisahwan",
                    "active_2" => "text-yellow-500 rounded md:bg-transparent md:p-0",
                    "pageTitle" => '<mark class="px-2 text-yellow-500 bg-gray-900 rounded">Produk</mark> Kami',
                    'pageDescription' => 'Jelajahi camilan terbaik di <span class="underline underline-offset-2 decoration-4 decoration-yellow-500">Lisahwan</span> dan pilih favorit Anda sekarang!',
                    "products" => Product::all(),
                    "carts" => $carts
                ]);
            }
        }

        $products_bestseller = OrderDetail::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->take(4)
            ->get();
        // $user = User::where('id', Auth::user()->id)->first();
        // $cart_user = Cart::where('user_id', $user->id)->first();
        // if (empty($cart_user)) {
        //     $carts = null;
        // } else {
        //     $carts = $cart_user->cart_detail;
        // }
        return view('index', [
            "TabTitle" => "Lisahwan Surabaya",
            "active_1" => "text-yellow-500 rounded md:bg-transparent md:p-0",
            "carousel_1" => "/images/fotoproduk/GalleryCarousel_12.jpeg",
            "carousel_2" => "/images/fotoproduk/GalleryCarousel_10.jpg",
            "carousel_3" => "/images/fotoproduk/GalleryCarousel_8.jpg",
            "carousel_4" => "/images/fotoproduk/GalleryCarousel_13.jpeg",
            "products_bestseller" => $products_bestseller,
            // "carts" => $carts
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Session::has('poinStatus')) {
            Session::forget('pointStatus');
        }
        if (Auth::check()) {
            // Query untuk mendapatkan cart_user yang lebih dari 7 hari
            $cart_user = Cart::where('user_id', Auth::user()->id)
                ->where('created_at', '<', Carbon::now()->subDays(7))
                ->first();
            // Jika cart_user ditemukan dan sudah lebih dari 7 hari, hapus
            if (!empty($cart_user)) {
                $cart_user->delete();
                $carts = null;
            } else {
                // Jika tidak ditemukan cart_user yang lebih dari 7 hari, cari cart_user biasa
                $cart_user = Cart::where('user_id', Auth::user()->id)->first();
                if (empty($cart_user)) {
                    $carts = null;
                } else {
                    $carts = $cart_user->cart_detail;
                }
            }
            return view('customer.products', [
                "TabTitle" => "Produk Lisahwan",
                "active_2" => "text-yellow-500 rounded md:bg-transparent md:p-0",
                "pageTitle" => '<mark class="px-2 text-yellow-500 bg-gray-900 rounded">Produk</mark> Kami',
                'pageDescription' => 'Jelajahi camilan terbaik di <span class="underline underline-offset-2 decoration-4 decoration-yellow-500">Lisahwan</span> dan pilih favorit Anda sekarang!',
                "products" => Product::whereNotIn('name', ['Rambak Kerbau', 'Kentang Udang'])->get(),
                "carts" => $carts
            ]);
        } else {
            return view('customer.products', [
                "TabTitle" => "Produk Lisahwan",
                "active_2" => "text-yellow-500 rounded md:bg-transparent md:p-0",
                "pageTitle" => '<mark class="px-2 text-yellow-500 bg-gray-900 rounded">Produk</mark> Kami',
                'pageDescription' => 'Jelajahi camilan terbaik di <span class="underline underline-offset-2 decoration-4 decoration-yellow-500">Lisahwan</span> dan pilih favorit Anda sekarang!',
                "products" => Product::whereNotIn('name', ['Rambak Kerbau', 'Kentang Udang'])->get()
            ]);
        }
    }

    public function admin_products(Request $request)
    {
        //
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

        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }


    public function detail(Product $product) // show buat for admin
    {
        //
    }

    public function addStock(Request $request, Product $product)
    {
        //
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
        //
    }

    public function updateImage(Request $request, Product $product)
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
