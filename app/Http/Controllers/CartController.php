<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartDetail;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateCartRequest;

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
        $cart = Cart::where('user_id', 1)->first(); // Gunakan first() untuk mendapatkan satu objek bukan koleksi
        $product = Product::find($id);

        $validatedData = $request->validate([
            "quantity" => "required",
            "cost" => "required"
        ]);

        if (!$cart) {
            $cart_new = Cart::create([
                'user_id' => 1
            ]);
           CartDetail::create([
                'cart_id' => $cart_new->id,
                'product_id' => $id,
                'quantity' => $validatedData['quantity'],
                'price' => $validatedData['cost'],
                'weight' => $product->weight
            ]);
            // $carts = CartDetail::where('cart_id', $cart_new->id)->get();
        } else {
            CartDetail::create([
                'cart_id' => $cart->id,
                'product_id' => $id,
                'quantity' => $validatedData['quantity'],
                'price' => $validatedData['cost'],
                'weight' => $product->weight
            ]);
            // $carts = CartDetail::where('cart_id', $cart->id)->get();
        }

        return redirect('/products');
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
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
