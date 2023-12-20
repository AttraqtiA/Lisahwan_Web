<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Address;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::where('user_id', 1)->first();
        if (!$cart) {
            return redirect('/products')->with('deleteCart_success', 'Pesanan berhasil dihapus!');
        } else {
            $products_bestseller = OrderDetail::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
                ->groupBy('product_id')
                ->orderByDesc('total_quantity')
                ->take(4)
                ->get();

            $shipment_price = $cart->getShipmentPrice();
            $address = Address::where('user_id', 1)->get();
            return view('customer.checkout', [
                "TabTitle" => "Checkout",
                "products_bestseller" => $products_bestseller,
                "carts" => $cart->cart_detail,
                "shipment_price" => $shipment_price,
                "addresses" => $address
            ]);
        }
    }

    public function show_orderhistory()
    {
        return view('customer.orderhistory');
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
        $validatedData = $request->validate([
            'address_id' => 'required_without:address|integer',
            'address' => 'required_if:address_id,0|string|nullable|max:100',
            'city' => 'required|string|max:50',
            'province' => 'required|string|max:50',
            'postal_code' => 'required|numeric',
            'note' => 'nullable|string|max:255',
            'payment_upload' => 'required|image|file|max:5000',
        ], [
            'address_id.required_without' => 'Alamat Pengiriman wajib diisi!',
            'address.required_if' => 'Alamat Pengiriman wajib diisi!',
            'address.max' => 'Maksimal :max karakter!',
            'city.required' => 'Kota wajib diisi!',
            'city.max' => 'Maksimal :max karakter!',
            'province.required' => 'Provinsi wajib diisi!',
            'province.max' => 'Maksimal :max karakter!',
            'postal_code.required' => 'Kode Pos wajib diisi!',
            'postal_code.numeric' => 'Kode Pos harus berupa angka!',
            'note.max' => 'Maksimal :max karakter!',
            'payment_upload.required' => 'Mohon upload bukti pembayaran anda!',
            'payment_upload.image' => 'File wajib berupa gambar!',
            'payment_upload.max' => 'Maksimal 5 MB!',
        ]);


        $order_date = now();

        $cart = Cart::where('user_id', 1)->first();
        $cart_details = $cart->cart_detail;

        $total_price = ($cart_details->sum('price')) + $cart->getShipmentPrice();
        $total_weight = $cart_details->sum('weight');

        if ($request->file('payment_upload')) {
            $validatedData['payment'] = $request->file('payment_upload')->store('upload_images', ['disk' => 'public']);
        }

        if ($validatedData['address_id']) {
            if ($validatedData['note']) {
                $order = Order::create([
                    'user_id' => 1,
                    'address_id' => $validatedData['address_id'],
                    'order_date' => $order_date,
                    'total_price' => $total_price,
                    'total_weight' => $total_weight,
                    'payment' => $validatedData['payment'],
                    'note' => $validatedData['note']
                ]);
            } else {
                $order = Order::create([
                    'user_id' => 1,
                    'address_id' => $validatedData['address_id'],
                    'order_date' => $order_date,
                    'total_price' => $total_price,
                    'total_weight' => $total_weight,
                    'payment' => $validatedData['payment']
                ]);
            }
        } else {
            $address = Address::create([
                'user_id' => 1,
                'address' => $validatedData['address'],
                'city' => $validatedData['city'],
                'province' => $validatedData['province'],
                'postal_code' => $validatedData['postal_code']
            ]);
            if ($validatedData['note']) {
                $order = Order::create([
                    'user_id' => 1,
                    'address_id' => $address->id,
                    'order_date' => $order_date,
                    'total_price' => $total_price,
                    'total_weight' => $total_weight,
                    'payment' => $validatedData['payment'],
                    'note' => $validatedData['note']
                ]);
            } else {
                $order = Order::create([
                    'user_id' => 1,
                    'address_id' => $address->id,
                    'order_date' => $order_date,
                    'total_price' => $total_price,
                    'total_weight' => $total_weight,
                    'payment' => $validatedData['payment']
                ]);
            }
        }

        foreach ($cart_details as $cart_detail) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $cart_detail->product_id,
                'quantity' => $cart_detail->quantity,
                'price' => $cart_detail->price,
                'weight' => $cart_detail->weight
            ]);
        }

        $cart->delete();

        return redirect('/products')->with('order_success', 'Pemesanan anda berhasil! <br><a href="/orderhistory" class="font-bold text-yellow-500">Check Status Pesanan</a>.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
