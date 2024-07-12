<?php

namespace App\Http\Controllers\Member;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;

use App\Models\Order;
use App\Models\Point;
use App\Models\Coupon;
use App\Models\Address;
use App\Models\UserCoupon;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function checkCoupon(Request $request)
    {
        $validatedData = $request->validate([
            "coupon" => "required|string|max:20",
        ], [
            'coupon.required' => 'Nama kupon wajib diisi!',
            'coupon.string' => 'Nama kupon wajib berupa karakter!',
            'coupon.max' => 'Nama kupon maksimal 20 karakter!',
        ]);

        // Simpan data alamat ke session
        $request->session()->put('checkout.address', $request->address);
        $request->session()->put('checkout.city', $request->city);
        $request->session()->put('checkout.province', $request->province);
        $request->session()->put('checkout.postal_code', $request->postal_code);
        $request->session()->put('checkout.note', $request->note);

        $coupon = Coupon::where('title', $validatedData['coupon'])->first();

        if (!$coupon) {
            return redirect()->back()->withErrors(['incorrectCoupon_error' => 'Oops, kupon yang kamu masukkan masih salah!']);
        }

        $user_coupon = UserCoupon::where('user_id', Auth::user()->id)->where('coupon_id', $coupon->id)->first();

        if ($user_coupon) {
            return redirect()->back()->withErrors(['alreadyAddCoupon_error' => "Oops, kupon {$coupon->title} sudah jadi milikmu!"]);
        }

        UserCoupon::create([
            "user_id" => Auth::user()->id,
            "coupon_id" => $coupon->id,
            "quantity" => $coupon->initial_quantity
        ]);

        return back()->with('correctCoupon_success', "Selamat! Kupon {$coupon->title} jadi milikmu!");
    }

    public function chooseCoupon(Request $request, $id)
    {
        // Simpan data alamat ke session
        $request->session()->put('checkout.address', $request->address);
        $request->session()->put('checkout.city', $request->city);
        $request->session()->put('checkout.province', $request->province);
        $request->session()->put('checkout.postal_code', $request->postal_code);
        $request->session()->put('checkout.note', $request->note);

        $coupon = Coupon::findOrFail($id);
        $user_coupon = $coupon->usercoupon->where('user_id', Auth::user()->id)->where("coupon_id", $id)->first();

        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $cart_details = $cart->cart_detail;

        if (Session::has('couponStatus_' . $id)) {
            // Jika kupon dinonaktifkan
            foreach ($cart_details as $cart_detail) {
                // Ambil harga asli item dari sesi
                $originalPriceKey = 'originalPrice_' . $cart_detail->id;
                $originalPrice = Session::get($originalPriceKey);

                // Reset harga item ke harga asli sebelum semua kupon diterapkan
                $cart_detail->update([
                    'price' => $originalPrice
                ]);

                // Terapkan kembali kupon yang masih aktif
                $activeCoupons = Session::get('activeCoupons', []);
                foreach ($activeCoupons as $activeCouponId) {
                    if ($activeCouponId != $id) {
                        $activeCoupon = Coupon::findOrFail($activeCouponId);
                        $cart_detail->update([
                            'price' => $cart_detail->price - ($cart_detail->price * ($activeCoupon->discount / 100))
                        ]);
                    }
                }
            }

            // Update jumlah kupon pengguna
            $user_coupon->update([
                'quantity' => $user_coupon->quantity + 1
            ]);

            // Hapus status kupon dari sesi
            Session::forget('couponStatus_' . $id);
            Session::put('activeCoupons', array_diff(Session::get('activeCoupons', []), [$id]));

            return back()->with('useCoupon_success', "Kupon {$coupon->title} tidak jadi dipakai!");
        } else {
            $now = Carbon::now();
            if ($now >= $coupon->starting_time && $now <= $coupon->ending_time && $user_coupon->quantity > 0) {
                // Jika kupon diaktifkan
                foreach ($cart_details as $cart_detail) {
                    // Simpan harga asli item jika belum disimpan
                    $originalPriceKey = 'originalPrice_' . $cart_detail->id;
                    if (!Session::has($originalPriceKey)) {
                        Session::put($originalPriceKey, $cart_detail->price);
                    }

                    // Terapkan diskon kupon
                    $cart_detail->update([
                        'price' => $cart_detail->price - ($cart_detail->price * ($coupon->discount / 100))
                    ]);
                }

                // Update jumlah kupon pengguna
                $user_coupon->update([
                    'quantity' => $user_coupon->quantity - 1
                ]);

                // Simpan status kupon dan aktifkan kupon ke dalam sesi
                Session::put('couponStatus_' . $id, true);
                Session::push('activeCoupons', $id);

                return back()->with('useCoupon_success', "Selamat! Kamu mendapatkan potongan sebesar {$coupon->discount}%!");
            } else {
                return redirect()->back()->withErrors(['couponExpired_error' => "Oops, kupon {$coupon->title} sudah kedaluwarsa!"]);
            }
        }
    }

    public function activatePoint(Request $request)
    {
        // Simpan data alamat ke session
        $request->session()->put('checkout.address', $request->address);
        $request->session()->put('checkout.city', $request->city);
        $request->session()->put('checkout.province', $request->province);
        $request->session()->put('checkout.postal_code', $request->postal_code);
        $request->session()->put('checkout.note', $request->note);

        $user = User::where('id', Auth::user()->id)->first();
        $point = Point::first();
        $reward = $user->reward * $point->money_per_poin;

        if (Session::has('pointStatus')) {
            Session::forget('pointStatus');
            return back()->with('activatePoint_success', "Poin tidak jadi dipakai!");
        } else {
            Session::put('pointStatus', true);
            return back()->with('activatePoint_success', "Selamat! Kamu mendapatkan potongan sebesar Rp. " . number_format($reward, 0, ',', '.') . "!");
        }
    }

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

            $coupons = Coupon::all();
            $user_coupons = UserCoupon::where('user_id', Auth::user()->id)->get();

            // REWARD POIN SYSTEM
            $point = Point::first();
            if ($point) {
                $total_price = $cart->cart_detail->sum('price');
                $total_poin = floor($total_price * ($point->percentage_from_totalprice / 100));

                // Membulatkan ke bawah ke kelipatan 1000 terdekat
                $total_poin = floor($total_poin / 1000) * 1000;
                $poin_to_money = $total_poin * $point->money_per_poin;
            } else {
                $total_poin = 0;
                $poin_to_money = 0;
            }
            //

            $customer = User::where('id', Auth::user()->id)->first();
            $reward_now = $customer->reward * $point->money_per_poin;

            return view('customer.checkout', [
                "TabTitle" => "Checkout",
                "active_2" => "text-yellow-500 rounded md:bg-transparent md:p-0",
                "products_bestseller" => $products_bestseller,
                "carts" => $cart->cart_detail,
                "shipment_price" => $shipment_price,
                "addresses" => $address,
                "coupons" => $coupons,
                "user_coupons" => $user_coupons,
                "total_poin" => $total_poin,
                "total_money" => $poin_to_money,
                "reward_now" => $reward_now,
                "point" => $point
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
        // dd($request->total_poin);
        $validatedData = $request->validate([
            'address_id' => 'required_without:address|integer',
            'address' => 'required_if:address_id,0|string|nullable|max:100',
            'city' => 'required|string|max:50',
            'province' => 'required|string|max:50',
            'postal_code' => 'required|numeric',
            'note' => 'nullable|string|max:255',
            'payment_upload' => 'required|image|file|max:5000',
            'total_poin' => 'required|numeric',
            'reward_now' => 'numeric'
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
            'total_poin.required' => 'Total poin wajib diisi!',
            'total_poin.numeric' => 'Total poin wajib berupa angka!',
            'reward_now.numeric' => 'Total reward sekarang wajib berupa angka!',
        ]);

        // Hapus semua sesi yang terkait dengan couponStatus
        $activeCoupons = Session::get('activeCoupons', []);
        foreach ($activeCoupons as $couponId) {
            Session::forget('couponStatus_' . $couponId);
        }

        // Hapus sesi activeCoupons
        Session::forget('activeCoupons');

        // Hapus sesi originalPrice yang mungkin ada
        $cart = Cart::where('user_id', Auth::user()->id)->first();
        if ($cart) {
            foreach ($cart->cart_detail as $cart_detail) {
                Session::forget('originalPrice_' . $cart_detail->id);
            }
        }

        Session::forget([
            'checkout.address',
            'checkout.city',
            'checkout.province',
            'checkout.postal_code',
            'checkout.note',
        ]);

        $order_date = now();

        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $cart_details = $cart->cart_detail;

        $customer = User::where('id', Auth::user()->id)->first();
        $point = Point::first();

        if (Session::has('pointStatus')) {
            Session::forget('pointStatus');
            $total_price_beforeReward = $cart_details->sum('price') + $cart->getShipmentPrice();
            $reward_now = $validatedData['reward_now'];
            if ($reward_now >= $total_price_beforeReward) {
                $total_price = 0;
            } else {
                $total_price =  $total_price_beforeReward - $reward_now;
            }
            $convertReward_toPoint = $total_price / $point->money_per_poin;
            $customer->update([
                'reward' => $convertReward_toPoint
            ]);
        } else {
            $total_price = $cart_details->sum('price') + $cart->getShipmentPrice();
        }
        $customer->update([
            'reward' => $customer->reward + $validatedData['total_poin']
        ]);

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

        return redirect()->route('products')->with('order_success', 'Pemesanan anda berhasil! <br><a href="' . route('member.orderhistory') . '" class="inline-flex items-center font-bold text-yellow-500 hover:underline">Check Status Pesanan <svg class="ml-1 w-4 h-4 text-yellow-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10"> <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M1 5h12m0 0L9 1m4 4L9 9" /> </svg></a>');
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
