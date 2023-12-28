<?php

namespace App\Http\Controllers\Member;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Testimony;
use App\Models\CartDetail;
use App\Models\Production;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
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
    public function store(Request $request, $id)
    {
        $submitButton = $request->input('submitButton');

        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $product = Product::find($id);

        $validatedData = $request->validate([
            "quantity" => "required|not_in:0",
            "cost" => "required|not_in:0"
        ], [
            'quantity.required' => 'Oops! Anda lupa mengisikan jumlah pemesanan!',
            'quantity.not_in' => 'Oops! Anda lupa mengisikan jumlah pemesanan!',
            'cost.required' => 'Pastikan anda sudah mengisi jumlah pemesanan!',
            'cost.not_in' => 'Pastikan anda sudah mengisi jumlah pemesanan!',
        ]);

        // Membersihkan dari karakter non-numeric, termasuk pemisah ribuan
        $price_beforeConverted = filter_var($validatedData['cost'], FILTER_SANITIZE_NUMBER_INT);

        // Konversi ke integer
        $price_afterConverted = intval($price_beforeConverted);

        $total_weight = $product->weight * $validatedData['quantity'];

        if ($validatedData['quantity'] <= $product->stock) {
            if (!$cart) {
                $cart_new = Cart::create([
                    'user_id' => Auth::user()->id
                ]);
                CartDetail::create([
                    'cart_id' => $cart_new->id,
                    'product_id' => $id,
                    'quantity' => $validatedData['quantity'],
                    'price' => $price_afterConverted,
                    'weight' => $total_weight
                ]);
            } else {
                $cart_detail = $cart->cart_detail;
                $check_product = $cart_detail->where('product_id', $id)->first();

                if ($check_product) {
                    $check_product->update([
                        'quantity' => $check_product->quantity + $validatedData['quantity'],
                        'price' => $check_product->price + $price_afterConverted,
                        'weight' => $check_product->weight + $total_weight
                    ]);
                } else {
                    CartDetail::create([
                        'cart_id' => $cart->id,
                        'product_id' => $id,
                        'quantity' => $validatedData['quantity'],
                        'price' => $price_afterConverted,
                        'weight' => $total_weight
                    ]);
                }
            }
            $product->update([
                'stock' =>  $product->stock - $validatedData['quantity']
            ]);
            Production::create([
                'date' => now(),
                'product_id' => $id,
                'quantity' => $validatedData['quantity'],
                'type' => 'kurang'
            ]);
            if ($submitButton === 'submit1') {
                return redirect()->route('member.checkout');
            } else {
                return redirect()->route('products')->with('addCart_success', 'Pesanan ditambahkan ke keranjang!');
            }
        } else {
            return back()->with('over_quantity', 'Mohon maaf, pesanan anda melebihi stok!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cart_detail = CartDetail::where('product_id', $id)->first();

        if (!$cart_detail) {
            return redirect()->route('products')->with('deleteCart_success', 'Mohon maaf, keranjang anda kosong!');
        } else {
            $testimonies = Testimony::where('product_id', $id)->paginate(4);
            $products_bestseller = OrderDetail::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
                ->groupBy('product_id')
                ->orderByDesc('total_quantity')
                ->take(4)
                ->get();
            $total_product = Product::count();
            $cart_user = Cart::where('user_id', 1)->first();
            if (empty($cart_user)) {
                $carts = null;
            } else {
                $carts = $cart_user->cart_detail;
            }
            return view(
                'customer.edit_orderdetail',
                [
                    "TabTitle" => $cart_detail->product->name,
                    "active_2" => "text-yellow-500 rounded md:bg-transparent md:p-0",
                    "total_product" => $total_product,
                    "testimonies" => $testimonies,
                    "products_bestseller" => $products_bestseller,
                    "carts" => $carts,
                    "cart_detail" => $cart_detail
                ]
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cart_detail = CartDetail::where('id', $id)->first();

        $validatedData = $request->validate([
            "quantity" => "required|not_in:0",
            "cost" => "required|not_in:0"
        ], [
            'quantity.required' => 'Oops! Anda lupa mengisikan jumlah pemesanan!',
            'quantity.not_in' => 'Oops! Anda lupa mengisikan jumlah pemesanan!',
            'cost.required' => 'Pastikan anda sudah mengisi jumlah pemesanan!',
            'cost.not_in' => 'Pastikan anda sudah mengisi jumlah pemesanan!',
        ]);

        // Membersihkan dari karakter non-numeric, termasuk pemisah ribuan
        $price_beforeConverted = filter_var($validatedData['cost'], FILTER_SANITIZE_NUMBER_INT);

        // Konversi ke integer
        $price_afterConverted = intval($price_beforeConverted);

        $total_weight = $cart_detail->product->weight * $validatedData['quantity'];

        if ($validatedData['quantity'] <= $cart_detail->product->stock) {
            $quantity_difference = $validatedData['quantity'] - $cart_detail->quantity;
            $product = $cart_detail->product;
            $product->update([
                'stock' => $cart_detail->product->stock - $quantity_difference
            ]);
            $production = Production::where('product_id', $product->id)->first();
            $production->update([
                'quantity' => $quantity_difference,
                'type' => 'tambah'
            ]);
            $cart_detail->update([
                'quantity' => $validatedData['quantity'],
                'price' => $price_afterConverted,
                'weight' => $total_weight
            ]);
            return redirect()->route('products')->with('updateCart_success', 'Pesanan berhasil diperbarui!');
        } else {
            return back()->with('over_quantity', 'Mohon maaf, pesanan anda melebihi stok!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cartDetail = CartDetail::find($id);
        if ($cartDetail) {
            // Temukan Cart yang sesuai dengan relasi
            $cart = $cartDetail->cart;

            // Update stock produk yang dihapus
            $cartDetail->product->update([
                'stock' => $cartDetail->product->stock + $cartDetail->quantity
            ]);

            // Hapus CartDetail
            $cartDetail->delete();

            // Periksa apakah setelah menghapus CartDetail, tidak ada lagi cart_detail dalam keranjang
            if ($cart && $cart->cart_detail->isEmpty()) {
                // Jika tidak ada cart_detail, hapus juga keranjangnya
                $cart->delete();
            }
            return back()->with('deleteCart_success', 'Pesanan berhasil dihapus!');
        }
    }
}
