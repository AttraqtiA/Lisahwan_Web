<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Address;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->first();
        if (!$cart) {
            return redirect()->route('products')->with('checkout_cancel', 'Oops! Keranjang anda kosong!');
        } else {
            $products_bestseller = OrderDetail::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
                ->groupBy('product_id')
                ->orderByDesc('total_quantity')
                ->take(4)
                ->get();
            $shipment_price = $cart->getShipmentPrice();
            $address = Address::where('user_id', Auth::user()->id)->get();
            return view('customer.checkout', [
                "TabTitle" => "Checkout",
                "active_2" => "text-yellow-500 rounded md:bg-transparent md:p-0",
                "products_bestseller" => $products_bestseller,
                "carts" => $cart->cart_detail,
                "shipment_price" => $shipment_price,
                "addresses" => $address
            ]);
        }
    }

    public function show_orderhistory()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderByDesc('id')->paginate(4);
        $cart_user = Cart::where('user_id', Auth::user()->id)->first();
        if (empty($cart_user)) {
            $carts = null;
        } else {
            $carts = $cart_user->cart_detail;
        }
        if ($orders->isEmpty()) {
            return redirect()->route('products')->with('empty_order', 'Oops! Anda belum belanja sama sekali!');
        } else {
            foreach ($orders as $order) {
                $orderDate = Carbon::parse($order->order_date);
                $currentDate = Carbon::now();
                $daysDifference = $currentDate->diffInDays($orderDate);

                if ($daysDifference > 3) {
                    $order->update(['arrived_date' => $currentDate]);
                    $order->update(['acceptbyCustomer_status' => 'Sudah']);
                }
            }
            return view(
                'customer.orderhistory',
                [
                    "TabTitle" => "Riwayat Pemesanan",
                    "active_history" => "text-yellow-500 rounded md:bg-transparent md:p-0",
                    "pageTitle" => '<mark class="px-2 text-yellow-500 bg-gray-900 rounded">Riwayat</mark> Pemesanan',
                    'pageDescription' => 'Lacak pesanan anda <span class="underline underline-offset-2 decoration-4 decoration-yellow-500">di sini!</span>',
                    "orders" => $orders,
                    "carts" => $carts
                ]
            );
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
            'city.string' => 'Kota wajib berupa karakter!',
            'city.max' => 'Maksimal :max karakter!',
            'province.required' => 'Provinsi wajib diisi!',
            'province.string' => 'Provinsi wajib berupa karakter!',
            'province.max' => 'Maksimal :max karakter!',
            'postal_code.required' => 'Kode Pos wajib diisi!',
            'postal_code.numeric' => 'Kode Pos wajib berupa angka!',
            'note.max' => 'Maksimal :max karakter!',
            'payment_upload.required' => 'Mohon upload bukti pembayaran anda!',
            'payment_upload.image' => 'File wajib berupa gambar!',
            'payment_upload.max' => 'Maksimal ukuran gambar 5MB!',
        ]);

        $order_date = now();

        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $cart_details = $cart->cart_detail;

        $total_price = ($cart_details->sum('price')) + $cart->getShipmentPrice();
        $total_weight = $cart_details->sum('weight');

        if ($request->file('payment_upload')) {
            $validatedData['payment'] = $request->file('payment_upload')->store('bukti_transfer', ['disk' => 'public']);
        }

        if ($validatedData['address_id']) {
            if ($validatedData['note']) {
                $order = Order::create([
                    'user_id' => Auth::user()->id,
                    'address_id' => $validatedData['address_id'],
                    'order_date' => $order_date,
                    'total_price' => $total_price,
                    'total_weight' => $total_weight,
                    'payment' => $validatedData['payment'],
                    'note' => $validatedData['note']
                ]);
            } else {
                $order = Order::create([
                    'user_id' => Auth::user()->id,
                    'address_id' => $validatedData['address_id'],
                    'order_date' => $order_date,
                    'total_price' => $total_price,
                    'total_weight' => $total_weight,
                    'payment' => $validatedData['payment']
                ]);
            }
        } else {
            $address = Address::create([
                'user_id' => Auth::user()->id,
                'address' => $validatedData['address'],
                'city' => $validatedData['city'],
                'province' => $validatedData['province'],
                'postal_code' => $validatedData['postal_code']
            ]);
            if ($validatedData['note']) {
                $order = Order::create([
                    'user_id' => Auth::user()->id,
                    'address_id' => $address->id,
                    'order_date' => $order_date,
                    'total_price' => $total_price,
                    'total_weight' => $total_weight,
                    'payment' => $validatedData['payment'],
                    'note' => $validatedData['note']
                ]);
            } else {
                $order = Order::create([
                    'user_id' => Auth::user()->id,
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

        return redirect()->route('products')->with('order_success', 'Pemesanan anda berhasil! <br><a href="' . route('member.orderhistory') . '" class="inline-flex items-center font-bold text-yellow-500">Check Status Pesanan <svg class="ml-1 w-4 h-4 text-yellow-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10"> <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M1 5h12m0 0L9 1m4 4L9 9" /> </svg></a>');
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
    public function update($id)
    {
        $order = Order::where('id', $id)->first();
        $arrived_date = now();
        $order->update([
            'arrived_date' => $arrived_date,
            'acceptbyCustomer_status' => 'sudah'
        ]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
