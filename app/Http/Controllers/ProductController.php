<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Testimony;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart_user = Cart::where('user_id', Auth::user()->id)->first();
        if (empty($cart_user)) {
            $carts = null;
        } else {
            $carts = $cart_user->cart_detail;
        }
        return view('customer.products', [
            "TabTitle" => "Produk Lisahwan",
            "pageTitle" => '<mark class="px-2 text-yellow-500 bg-gray-800 rounded dark:bg-gray-800">Produk</mark> Kami',
            'pageDescription' => 'Jelajahi camilan terbaik di <span class="underline underline-offset-2 decoration-4 decoration-yellow-500">Lisahwan</span> dan pilih favorit Anda sekarang!',
            "active_2" => "text-white rounded md:bg-transparent md:text-yellow-500 md:p-0 md:dark:text-yellow-500",
            "products" => Product::all(),
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::find($id);
        if ($product->stock == 0) {
            return redirect('/products')->with('empty_stock', 'Mohon maaf, stok habis!');
        } else {
            $testimonies = Testimony::where('product_id', $id)->paginate(4);
            $check_testimonies = $testimonies->where('user_id', Auth::user()->id)->first();
            $user = User::find(Auth::user()->id);
            $product_id = $id;
            $check_order_user = $user->order->filter(function ($order) use ($product_id) {
                return $order->order_detail->where('product_id', $product_id)->isNotEmpty();
            })->isNotEmpty();
            $products_bestseller = OrderDetail::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
                ->groupBy('product_id')
                ->orderByDesc('total_quantity')
                ->take(4)
                ->get();
            $total_product = Product::count();
            $cart_user = Cart::where('user_id', Auth::user()->id)->first();
            if (empty($cart_user)) {
                $carts = null;
            } else {
                $carts = $cart_user->cart_detail;
            }
            return view('customer.orderdetail', [
                "TabTitle" => $product->name,
                "product" => $product,
                "total_product" => $total_product,
                "testimonies" => $testimonies,
                "check_order_user" => $check_order_user,
                "check_testimonies" => $check_testimonies,
                "products_bestseller" => $products_bestseller,
                "carts" => $carts
            ]);
        }
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
