<?php

namespace App\Http\Controllers\Member;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Point;
use App\Models\Product;
use App\Models\Testimony;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
        $product = Product::find($id);
        if ($product->stock == 0) {
            return redirect()->route('products')->with('empty_stock', 'Mohon maaf, stok habis!');
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

            return view('customer.orderdetail', [
                "TabTitle" => $product->name,
                "active_2" => "text-yellow-500 rounded md:bg-transparent md:p-0",
                "product" => $product,
                "total_product" => $total_product,
                "testimonies" => $testimonies,
                "check_order_user" => $check_order_user,
                "check_testimonies" => $check_testimonies,
                "products_bestseller" => $products_bestseller,
                "carts" => $carts,
                "shipment_price" => $shipment_price,
                "admin_fee" => $admin_fee,
                "reward_now" => $reward_now,
                "point" => $point
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
