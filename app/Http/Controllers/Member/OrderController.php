<?php

namespace App\Http\Controllers\Member;

use Carbon\Carbon;
use Midtrans\Snap;
use App\Models\Cart;

use App\Models\User;
use App\Models\Order;
use App\Models\Point;
use App\Models\Coupon;
use App\Models\Address;
use App\Models\UserCoupon;
use Midtrans\Notification;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function handleTransactionStatus(Request $request)
    {
        // Ambil semua parameter dari URL
        $parameters = $request->all();

        $orderId = $request->query('order_id');
        $statusCode = $request->query('status_code');
        $transactionStatus = $request->query('transaction_status');

        $order = Order::where('midtrans_order_id', $orderId)->first();
        $cart = Cart::where('user_id', optional($order)->user_id)->first();

        // Logika untuk menampilkan pesan berdasarkan status transaksi
        if ($transactionStatus == 'capture') {
            if ($cart) {
                $cart->delete();
                // Hapus semua sesi yang terkait dengan couponStatus
                $activeCoupons = Session::get('activeCoupons', []);
                foreach ($activeCoupons as $couponId) {
                    if (Session::has('couponStatus_' . $couponId)) {
                        Session::forget('couponStatus_' . $couponId);
                    }
                }
                // Hapus sesi activeCoupons
                if (Session::has('activeCoupons')) {
                    Session::forget('activeCoupons');
                }
                // Hapus semua sesi yang terkait dengan arraycourierStatus
                $activeCouriersStatus = Session::get('arraycourierStatus', []);
                foreach ($activeCouriersStatus as $courierStatus) {
                    if (Session::has('courierStatus_' . $courierStatus)) {
                        Session::forget('courierStatus_' . $courierStatus);
                    }
                }
                // Hapus sesi arraycourierStatus
                if (Session::has('arraycourierStatus')) {
                    Session::forget('arraycourierStatus');
                }
                // Mendapatkan semua sesi yang terkait dengan arraycostStatus
                $activeCostStatus = Session::get('arraycostStatus', []);
                // Menghapus semua sesi yang terkait dengan arraycostStatus
                foreach ($activeCostStatus as $costStatus) {
                    if (Session::has($costStatus)) {
                        Session::forget($costStatus); // Hapus sesi berdasarkan kunci yang disimpan
                    }
                }
                // Hapus sesi arraycostStatus
                if (Session::has('arraycostStatus')) {
                    Session::forget('arraycostStatus');
                }
                // Hapus sesi originalPrice yang mungkin ada
                foreach ($cart->cart_detail as $cart_detail) {
                    if (Session::has('originalPrice_' . $cart_detail->id)) {
                        Session::forget('originalPrice_' . $cart_detail->id);
                    }
                }
            }
            if (Session::has('checkout.address_id')) {
                Session::forget('checkout.address_id');
            }
            if (Session::has('checkout.address')) {
                Session::forget('checkout.address');
            }
            if (Session::has('checkout.city')) {
                Session::forget('checkout.city');
            }
            if (Session::has('checkout.note')) {
                Session::forget('checkout.note');
            }
            return redirect()->route('member.orderhistory')->with('capturePayment_SUCCESSFULL', "Pesanan anda berhasil! Tinjau status pesanan anda disini!");
        } elseif ($transactionStatus == 'settlement') {
            if ($cart) {
                $cart->delete();
                // Hapus semua sesi yang terkait dengan couponStatus
                $activeCoupons = Session::get('activeCoupons', []);
                foreach ($activeCoupons as $couponId) {
                    if (Session::has('couponStatus_' . $couponId)) {
                        Session::forget('couponStatus_' . $couponId);
                    }
                }
                // Hapus sesi activeCoupons
                if (Session::has('activeCoupons')) {
                    Session::forget('activeCoupons');
                }
                // Hapus semua sesi yang terkait dengan arraycourierStatus
                $activeCouriersStatus = Session::get('arraycourierStatus', []);
                foreach ($activeCouriersStatus as $courierStatus) {
                    if (Session::has('courierStatus_' . $courierStatus)) {
                        Session::forget('courierStatus_' . $courierStatus);
                    }
                }
                // Hapus sesi arraycourierStatus
                if (Session::has('arraycourierStatus')) {
                    Session::forget('arraycourierStatus');
                }
                // Mendapatkan semua sesi yang terkait dengan arraycostStatus
                $activeCostStatus = Session::get('arraycostStatus', []);
                // Menghapus semua sesi yang terkait dengan arraycostStatus
                foreach ($activeCostStatus as $costStatus) {
                    if (Session::has($costStatus)) {
                        Session::forget($costStatus); // Hapus sesi berdasarkan kunci yang disimpan
                    }
                }
                // Hapus sesi arraycostStatus
                if (Session::has('arraycostStatus')) {
                    Session::forget('arraycostStatus');
                }
                // Hapus sesi originalPrice yang mungkin ada
                foreach ($cart->cart_detail as $cart_detail) {
                    if (Session::has('originalPrice_' . $cart_detail->id)) {
                        Session::forget('originalPrice_' . $cart_detail->id);
                    }
                }
            }
            if (Session::has('checkout.address_id')) {
                Session::forget('checkout.address_id');
            }
            if (Session::has('checkout.address')) {
                Session::forget('checkout.address');
            }
            if (Session::has('checkout.city')) {
                Session::forget('checkout.city');
            }
            if (Session::has('checkout.note')) {
                Session::forget('checkout.note');
            }
            return redirect()->route('member.orderhistory')->with('settlementPayment_SUCCESSFULL', "Pesanan anda berhasil! Tinjau status pesanan anda disini!");
        } elseif ($transactionStatus == 'pending') {
            return redirect()->route('member.checkout')->withErrors(['pendingPayment_ERROR' => "Proses pembayaran anda belum selesai!"]);
        } elseif ($transactionStatus == 'deny') {
            return redirect()->route('member.checkout')->withErrors(['denyPayment_ERROR' => "Pembayaran anda ditolak!"]);
        } elseif ($transactionStatus == 'expire') {
            return redirect()->route('member.checkout')->withErrors(['expirePayment_ERROR'  => "Proses pembayaran anda sudah kedaluwarsa, mohon melakukan pembayaran ulang!"]);
        } elseif ($transactionStatus == 'cancel') {
            if ($cart) {
                $cart->delete();
                // Hapus semua sesi yang terkait dengan couponStatus
                $activeCoupons = Session::get('activeCoupons', []);
                foreach ($activeCoupons as $couponId) {
                    if (Session::has('couponStatus_' . $couponId)) {
                        Session::forget('couponStatus_' . $couponId);
                    }
                }
                // Hapus sesi activeCoupons
                if (Session::has('activeCoupons')) {
                    Session::forget('activeCoupons');
                }
                // Hapus semua sesi yang terkait dengan arraycourierStatus
                $activeCouriersStatus = Session::get('arraycourierStatus', []);
                foreach ($activeCouriersStatus as $courierStatus) {
                    if (Session::has('courierStatus_' . $courierStatus)) {
                        Session::forget('courierStatus_' . $courierStatus);
                    }
                }
                // Hapus sesi arraycourierStatus
                if (Session::has('arraycourierStatus')) {
                    Session::forget('arraycourierStatus');
                }
                // Mendapatkan semua sesi yang terkait dengan arraycostStatus
                $activeCostStatus = Session::get('arraycostStatus', []);
                // Menghapus semua sesi yang terkait dengan arraycostStatus
                foreach ($activeCostStatus as $costStatus) {
                    if (Session::has($costStatus)) {
                        Session::forget($costStatus); // Hapus sesi berdasarkan kunci yang disimpan
                    }
                }
                // Hapus sesi arraycostStatus
                if (Session::has('arraycostStatus')) {
                    Session::forget('arraycostStatus');
                }
                // Hapus sesi originalPrice yang mungkin ada
                foreach ($cart->cart_detail as $cart_detail) {
                    if (Session::has('originalPrice_' . $cart_detail->id)) {
                        Session::forget('originalPrice_' . $cart_detail->id);
                    }
                }
            }
            if (Session::has('checkout.address_id')) {
                Session::forget('checkout.address_id');
            }
            if (Session::has('checkout.address')) {
                Session::forget('checkout.address');
            }
            if (Session::has('checkout.city')) {
                Session::forget('checkout.city');
            }
            if (Session::has('checkout.note')) {
                Session::forget('checkout.note');
            }
            return redirect()->route('member.products')->withErrors(['cancelPayment_ERROR' => "Pesanan anda dibatalkan! Silahkan menghubungi Lisahwan™ (082230308030)!"]);
        } elseif ($transactionStatus == 'failure') {
            if ($cart) {
                $cart->delete();
                // Hapus semua sesi yang terkait dengan couponStatus
                $activeCoupons = Session::get('activeCoupons', []);
                foreach ($activeCoupons as $couponId) {
                    if (Session::has('couponStatus_' . $couponId)) {
                        Session::forget('couponStatus_' . $couponId);
                    }
                }
                // Hapus sesi activeCoupons
                if (Session::has('activeCoupons')) {
                    Session::forget('activeCoupons');
                }
                // Hapus semua sesi yang terkait dengan arraycourierStatus
                $activeCouriersStatus = Session::get('arraycourierStatus', []);
                foreach ($activeCouriersStatus as $courierStatus) {
                    if (Session::has('courierStatus_' . $courierStatus)) {
                        Session::forget('courierStatus_' . $courierStatus);
                    }
                }
                // Hapus sesi arraycourierStatus
                if (Session::has('arraycourierStatus')) {
                    Session::forget('arraycourierStatus');
                }
                // Mendapatkan semua sesi yang terkait dengan arraycostStatus
                $activeCostStatus = Session::get('arraycostStatus', []);
                // Menghapus semua sesi yang terkait dengan arraycostStatus
                foreach ($activeCostStatus as $costStatus) {
                    if (Session::has($costStatus)) {
                        Session::forget($costStatus); // Hapus sesi berdasarkan kunci yang disimpan
                    }
                }
                // Hapus sesi arraycostStatus
                if (Session::has('arraycostStatus')) {
                    Session::forget('arraycostStatus');
                }
                // Hapus sesi originalPrice yang mungkin ada
                foreach ($cart->cart_detail as $cart_detail) {
                    if (Session::has('originalPrice_' . $cart_detail->id)) {
                        Session::forget('originalPrice_' . $cart_detail->id);
                    }
                }
            }
            if (Session::has('checkout.address_id')) {
                Session::forget('checkout.address_id');
            }
            if (Session::has('checkout.address')) {
                Session::forget('checkout.address');
            }
            if (Session::has('checkout.city')) {
                Session::forget('checkout.city');
            }
            if (Session::has('checkout.note')) {
                Session::forget('checkout.note');
            }
            return redirect()->route('member.products')->withErrors(['failurePayment_ERROR' => "Terjadi kesalahan! Silahkan menghubungi Lisahwan™ (082230308030)!"]);
        } elseif ($transactionStatus == 'refund') {
            if ($cart) {
                $cart->delete();
                // Hapus semua sesi yang terkait dengan couponStatus
                $activeCoupons = Session::get('activeCoupons', []);
                foreach ($activeCoupons as $couponId) {
                    if (Session::has('couponStatus_' . $couponId)) {
                        Session::forget('couponStatus_' . $couponId);
                    }
                }
                // Hapus sesi activeCoupons
                if (Session::has('activeCoupons')) {
                    Session::forget('activeCoupons');
                }
                // Hapus semua sesi yang terkait dengan arraycourierStatus
                $activeCouriersStatus = Session::get('arraycourierStatus', []);
                foreach ($activeCouriersStatus as $courierStatus) {
                    if (Session::has('courierStatus_' . $courierStatus)) {
                        Session::forget('courierStatus_' . $courierStatus);
                    }
                }
                // Hapus sesi arraycourierStatus
                if (Session::has('arraycourierStatus')) {
                    Session::forget('arraycourierStatus');
                }
                // Mendapatkan semua sesi yang terkait dengan arraycostStatus
                $activeCostStatus = Session::get('arraycostStatus', []);
                // Menghapus semua sesi yang terkait dengan arraycostStatus
                foreach ($activeCostStatus as $costStatus) {
                    if (Session::has($costStatus)) {
                        Session::forget($costStatus); // Hapus sesi berdasarkan kunci yang disimpan
                    }
                }
                // Hapus sesi arraycostStatus
                if (Session::has('arraycostStatus')) {
                    Session::forget('arraycostStatus');
                }
                // Hapus sesi originalPrice yang mungkin ada
                foreach ($cart->cart_detail as $cart_detail) {
                    if (Session::has('originalPrice_' . $cart_detail->id)) {
                        Session::forget('originalPrice_' . $cart_detail->id);
                    }
                }
            }
            if (Session::has('checkout.address_id')) {
                Session::forget('checkout.address_id');
            }
            if (Session::has('checkout.address')) {
                Session::forget('checkout.address');
            }
            if (Session::has('checkout.city')) {
                Session::forget('checkout.city');
            }
            if (Session::has('checkout.note')) {
                Session::forget('checkout.note');
            }
            return redirect()->route('member.products')->withErrors(['refundPayment_ERROR' => "Pembayaran anda di-refund! Silahkan menghubungi Lisahwan™ (082230308030)!"]);
        } elseif ($transactionStatus == 'partial_refund') {
            if ($cart) {
                $cart->delete();
                // Hapus semua sesi yang terkait dengan couponStatus
                $activeCoupons = Session::get('activeCoupons', []);
                foreach ($activeCoupons as $couponId) {
                    if (Session::has('couponStatus_' . $couponId)) {
                        Session::forget('couponStatus_' . $couponId);
                    }
                }
                // Hapus sesi activeCoupons
                if (Session::has('activeCoupons')) {
                    Session::forget('activeCoupons');
                }
                // Hapus semua sesi yang terkait dengan arraycourierStatus
                $activeCouriersStatus = Session::get('arraycourierStatus', []);
                foreach ($activeCouriersStatus as $courierStatus) {
                    if (Session::has('courierStatus_' . $courierStatus)) {
                        Session::forget('courierStatus_' . $courierStatus);
                    }
                }
                // Hapus sesi arraycourierStatus
                if (Session::has('arraycourierStatus')) {
                    Session::forget('arraycourierStatus');
                }
                // Mendapatkan semua sesi yang terkait dengan arraycostStatus
                $activeCostStatus = Session::get('arraycostStatus', []);
                // Menghapus semua sesi yang terkait dengan arraycostStatus
                foreach ($activeCostStatus as $costStatus) {
                    if (Session::has($costStatus)) {
                        Session::forget($costStatus); // Hapus sesi berdasarkan kunci yang disimpan
                    }
                }
                // Hapus sesi arraycostStatus
                if (Session::has('arraycostStatus')) {
                    Session::forget('arraycostStatus');
                }
                // Hapus sesi originalPrice yang mungkin ada
                foreach ($cart->cart_detail as $cart_detail) {
                    if (Session::has('originalPrice_' . $cart_detail->id)) {
                        Session::forget('originalPrice_' . $cart_detail->id);
                    }
                }
            }
            if (Session::has('checkout.address_id')) {
                Session::forget('checkout.address_id');
            }
            if (Session::has('checkout.address')) {
                Session::forget('checkout.address');
            }
            if (Session::has('checkout.city')) {
                Session::forget('checkout.city');
            }
            if (Session::has('checkout.note')) {
                Session::forget('checkout.note');
            }
            return redirect()->route('member.products')->withErrors(['partialRefundPayment_ERROR' => "Pembayaran anda di-refund! Silahkan menghubungi Lisahwan™ (082230308030)!"]);
        } elseif ($transactionStatus == 'authorize') {
            if ($cart) {
                $cart->delete();
                // Hapus semua sesi yang terkait dengan couponStatus
                $activeCoupons = Session::get('activeCoupons', []);
                foreach ($activeCoupons as $couponId) {
                    if (Session::has('couponStatus_' . $couponId)) {
                        Session::forget('couponStatus_' . $couponId);
                    }
                }
                // Hapus sesi activeCoupons
                if (Session::has('activeCoupons')) {
                    Session::forget('activeCoupons');
                }
                // Hapus semua sesi yang terkait dengan arraycourierStatus
                $activeCouriersStatus = Session::get('arraycourierStatus', []);
                foreach ($activeCouriersStatus as $courierStatus) {
                    if (Session::has('courierStatus_' . $courierStatus)) {
                        Session::forget('courierStatus_' . $courierStatus);
                    }
                }
                // Hapus sesi arraycourierStatus
                if (Session::has('arraycourierStatus')) {
                    Session::forget('arraycourierStatus');
                }
                // Mendapatkan semua sesi yang terkait dengan arraycostStatus
                $activeCostStatus = Session::get('arraycostStatus', []);
                // Menghapus semua sesi yang terkait dengan arraycostStatus
                foreach ($activeCostStatus as $costStatus) {
                    if (Session::has($costStatus)) {
                        Session::forget($costStatus); // Hapus sesi berdasarkan kunci yang disimpan
                    }
                }
                // Hapus sesi arraycostStatus
                if (Session::has('arraycostStatus')) {
                    Session::forget('arraycostStatus');
                }
                // Hapus sesi originalPrice yang mungkin ada
                foreach ($cart->cart_detail as $cart_detail) {
                    if (Session::has('originalPrice_' . $cart_detail->id)) {
                        Session::forget('originalPrice_' . $cart_detail->id);
                    }
                }
            }
            if (Session::has('checkout.address_id')) {
                Session::forget('checkout.address_id');
            }
            if (Session::has('checkout.address')) {
                Session::forget('checkout.address');
            }
            if (Session::has('checkout.city')) {
                Session::forget('checkout.city');
            }
            if (Session::has('checkout.note')) {
                Session::forget('checkout.note');
            }
            return redirect()->route('member.products')->withErrors(['authorizePayment_ERROR' => "Pembayaran anda di-authorize! Silahkan menghubungi Lisahwan™ (082230308030)!"]);
        } elseif (count($parameters) == 1 && $request->has('order_id')) {
            return redirect()->route('member.checkout')->withErrors(['expirePayment_ERROR'  => "Proses pembayaran anda sudah kedaluwarsa, mohon melakukan pembayaran ulang!"]);
        } else {
            return redirect()->route('member.checkout')->withErrors(['anotherPayment_ERROR'  => "Terjadi kesalahan, mohon melakukan pembayaran ulang!"]);
        }
    }

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
        $request->session()->put('checkout.address_id', $request->address_id);
        $request->session()->put('checkout.address', $request->address);
        $request->session()->put('checkout.city', $request->city);
        // $request->session()->put('checkout.province', $request->province);
        // $request->session()->put('checkout.postal_code', $request->postal_code);
        $request->session()->put('checkout.note', $request->note);

        $coupon = Coupon::where('title', $validatedData['coupon'])->first();

        $responseCities = Http::withHeaders([
            'key' => '1b3d1a91f7ab9a1c6dcc5543cb9192fb'
        ])->get('https://pro.rajaongkir.com/api/city');
        $cities = $responseCities['rajaongkir']['results'];

        $origin_id = null;
        foreach ($cities as $city) {
            if ($city['city_name'] == 'Surabaya') {
                $origin_id = $city['city_id'];
                break;
            }
        }

        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $cart_details = $cart->cart_detail;
        $courier = $cart->courier;
        $total_weight = $cart_details->sum('weight');

        $responseCost = Http::withHeaders([
            'key' => '1b3d1a91f7ab9a1c6dcc5543cb9192fb',
        ])->post('https://pro.rajaongkir.com/api/cost', [
            'origin' => $origin_id,
            'originType' => 'city',
            'destination' => $request->city,
            'destinationType' => 'city',
            'weight' => $total_weight,
            'courier' => $courier
        ]);
        $costs = $responseCost['rajaongkir'];

        if (!$coupon) {
            Session::put('costs', $costs);
            return redirect()->back()->withErrors([
                'incorrectCoupon_error' => 'Oops, kupon yang anda masukkan masih salah!'
            ]);
        }

        $user_coupon = UserCoupon::where('user_id', Auth::user()->id)->where('coupon_id', $coupon->id)->first();

        if ($user_coupon) {
            Session::put('costs', $costs);
            return redirect()->back()->withErrors([
                'alreadyAddCoupon_error' => "Oops, kupon {$coupon->title} sudah jadi milik anda!"
            ]);
        }

        UserCoupon::create([
            "user_id" => Auth::user()->id,
            "coupon_id" => $coupon->id,
            "quantity" => $coupon->initial_quantity
        ]);

        return back()->with([
            'correctCoupon_success' => "Selamat! Kupon {$coupon->title} jadi milik anda!",
            'costs' => $costs
        ]);
    }

    public function chooseCoupon(Request $request, $id)
    {
        // dd($request->courier);
        // Simpan data alamat ke session
        $request->session()->put('checkout.address_id', $request->address_id);
        $request->session()->put('checkout.address', $request->address);
        $request->session()->put('checkout.city', $request->city);
        // $request->session()->put('checkout.province', $request->province);
        // $request->session()->put('checkout.postal_code', $request->postal_code);
        $request->session()->put('checkout.note', $request->note);

        $coupon = Coupon::findOrFail($id);
        $user_coupon = $coupon->usercoupon->where('user_id', Auth::user()->id)->where("coupon_id", $id)->first();

        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $cart_details = $cart->cart_detail;

        $responseCities = Http::withHeaders([
            'key' => '1b3d1a91f7ab9a1c6dcc5543cb9192fb'
        ])->get('https://pro.rajaongkir.com/api/city');
        $cities = $responseCities['rajaongkir']['results'];

        $origin_id = null;
        foreach ($cities as $city) {
            if ($city['city_name'] == 'Surabaya') {
                $origin_id = $city['city_id'];
                break;
            }
        }

        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $cart_details = $cart->cart_detail;
        $courier = $cart->courier;
        $total_weight = $cart_details->sum('weight');

        $responseCost = Http::withHeaders([
            'key' => '1b3d1a91f7ab9a1c6dcc5543cb9192fb',
        ])->post('https://pro.rajaongkir.com/api/cost', [
            'origin' => $origin_id,
            'originType' => 'city',
            'destination' => $request->city,
            'destinationType' => 'city',
            'weight' => $total_weight,
            'courier' => $courier
        ]);
        $costs = $responseCost['rajaongkir'];

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

            return back()->with([
                'useCoupon_success' => "Kupon {$coupon->title} tidak jadi dipakai!",
                'costs' => $costs
            ]);
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

                return back()->with([
                    'useCoupon_success' => "Selamat! Anda mendapatkan potongan sebesar {$coupon->discount}%!",
                    'costs' => $costs
                ]);
            } else {
                Session::put('costs', $costs);
                return redirect()->back()->withErrors([
                    'couponExpired_error' => "Oops, kupon {$coupon->title} sudah kedaluwarsa!"
                ]);
            }
        }
    }

    public function activatePoint(Request $request)
    {
        // dd($request->city, $request->courier);
        // Simpan data alamat ke session
        $request->session()->put('checkout.address_id', $request->address_id);
        $request->session()->put('checkout.address', $request->address);
        $request->session()->put('checkout.city', $request->city);
        // $request->session()->put('checkout.province', $request->province);
        // $request->session()->put('checkout.postal_code', $request->postal_code);
        $request->session()->put('checkout.note', $request->note);

        $user = User::where('id', Auth::user()->id)->first();
        $point = Point::first();
        $reward = $user->reward * $point->money_per_poin;

        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $courier = $cart->courier;
        $sub_total = $cart->cart_detail->sum('price');
        $total_price = $sub_total + $cart->shipment_price;

        if ($reward >= $total_price) {
            $difference = $total_price;
        } else {
            $difference = abs($reward - $total_price);
        }

        $responseCities = Http::withHeaders([
            'key' => '1b3d1a91f7ab9a1c6dcc5543cb9192fb'
        ])->get('https://pro.rajaongkir.com/api/city');
        $cities = $responseCities['rajaongkir']['results'];

        $origin_id = null;
        foreach ($cities as $city) {
            if ($city['city_name'] == 'Surabaya') {
                $origin_id = $city['city_id'];
                break;
            }
        }

        $cart_details = $cart->cart_detail;
        $total_weight = $cart_details->sum('weight');

        $responseCost = Http::withHeaders([
            'key' => '1b3d1a91f7ab9a1c6dcc5543cb9192fb',
        ])->post('https://pro.rajaongkir.com/api/cost', [
            'origin' => $origin_id,
            'originType' => 'city',
            'destination' => $request->city,
            'destinationType' => 'city',
            'weight' => $total_weight,
            'courier' => $courier
        ]);
        $costs = $responseCost['rajaongkir'];

        if (Session::has('pointStatus')) {
            Session::forget('pointStatus');
            return back()->with([
                'activatePoint_success' => "Poin tidak jadi dipakai!",
                'costs' => $costs
            ]);
        } else {
            Session::put('pointStatus', true);
            return back()->with([
                'activatePoint_success', "Selamat! Anda mendapatkan potongan sebesar Rp. " . number_format($difference, 0, ',', '.') . "!",
                'costs' => $costs
            ]);
        }
    }

    public function checkShipmentPrice(Request $request)
    {
        // dd($request->courier);
        // Simpan data alamat ke session
        $request->session()->put('checkout.address_id', $request->address_id);
        $request->session()->put('checkout.address', $request->address);
        $request->session()->put('checkout.city', $request->city);
        $request->session()->put('checkout.note', $request->note);

        if (!$request->city) {
            return redirect()->back()->withErrors(['cityForgotten_error' => "Oops, anda lupa memilih kota tujuan!"]);
        } else {
            if (!$request->courier) {
                $courierStatus_lion = Session::get('courierStatus_lion');
                $courierStatus_sicepat = Session::get('courierStatus_sicepat');
                if ($courierStatus_lion) {
                    Session::forget('courierStatus_lion');
                }
                if ($courierStatus_sicepat) {
                    Session::forget('courierStatus_sicepat');
                }
                return redirect()->back()->withErrors(['courierForgotten_error' => "Oops, anda lupa memilih jasa pengiriman yang akan digunakan!"]);
            } else {
                $responseCities = Http::withHeaders([
                    'key' => '1b3d1a91f7ab9a1c6dcc5543cb9192fb'
                ])->get('https://pro.rajaongkir.com/api/city');
                $cities = $responseCities['rajaongkir']['results'];

                $origin_id = null;
                foreach ($cities as $city) {
                    if ($city['city_name'] == 'Surabaya') {
                        $origin_id = $city['city_id'];
                        break;
                    }
                }

                $cart = Cart::where('user_id', Auth::user()->id)->first();
                $cart->update([
                    'courier' => $request->courier
                ]);
                $cart_details = $cart->cart_detail;
                $total_weight = $cart_details->sum('weight');

                $responseCost = Http::withHeaders([
                    'key' => '1b3d1a91f7ab9a1c6dcc5543cb9192fb',
                ])->post('https://pro.rajaongkir.com/api/cost', [
                    'origin' => $origin_id,
                    'originType' => 'city',
                    'destination' => $request->city,
                    'destinationType' => 'city',
                    'weight' => $total_weight,
                    'courier' => $request->courier
                ]);
                $costs = $responseCost['rajaongkir'];

                Session::push('arraycourierStatus', $request->courier);
                Session::put('courierStatus_' . $request->courier, true);

                $activeCouriersStatus = Session::get('arraycourierStatus', []);
                foreach ($activeCouriersStatus as $courierStatus) {
                    if ($courierStatus != $request->courier) {
                        Session::put('arraycourierStatus', array_diff(Session::get('arraycourierStatus', []), [$courierStatus]));
                        Session::forget('courierStatus_' . $courierStatus);
                    }
                }

                return back()->with([
                    'costs' => $costs,
                    'courier' => $request->courier
                ]);
            }
        }
    }

    public function chooseShipmentPrice(Request $request, $id)
    {
        // Simpan data alamat ke session
        $request->session()->put('checkout.address_id', $request->address_id);
        $request->session()->put('checkout.address', $request->address);
        $request->session()->put('checkout.city', $request->city);
        $request->session()->put('checkout.note', $request->note);

        $responseCities = Http::withHeaders([
            'key' => '1b3d1a91f7ab9a1c6dcc5543cb9192fb'
        ])->get('https://pro.rajaongkir.com/api/city');
        $cities = $responseCities['rajaongkir']['results'];

        $origin_id = null;
        foreach ($cities as $city) {
            if ($city['city_name'] == 'Surabaya') {
                $origin_id = $city['city_id'];
                break;
            }
        }

        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $cart_details = $cart->cart_detail;
        $total_weight = $cart_details->sum('weight');

        $responseCost = Http::withHeaders([
            'key' => '1b3d1a91f7ab9a1c6dcc5543cb9192fb',
        ])->post('https://pro.rajaongkir.com/api/cost', [
            'origin' => $origin_id,
            'originType' => 'city',
            'destination' => $request->city,
            'destinationType' => 'city',
            'weight' => $total_weight,
            'courier' => $request->courier
        ]);
        $costs = $responseCost['rajaongkir'];

        $shipmentPrice = null;
        $serviceName = null;
        $serviceDescription = null;
        foreach ($costs['results'] as $cost) {
            foreach ($cost['costs'] as $index => $cost_detail) {
                $serviceName = $cost_detail['service'];
                $serviceDescription = $cost_detail['description'];
                if ($index == $id) {
                    foreach ($cost_detail['cost'] as $service) {
                        $shipmentPrice = $service['value'];
                        break;
                    }
                    break;
                }
            }
        }

        $cart->update([
            "shipment_price" => $shipmentPrice
        ]);

        $city = $request->city; // Dapatkan city dari request
        $sessionKey = 'costStatus_' . $id . '_' . $city . '_' . $request->courier; // Buat kunci unik untuk session

        Session::push('arraycostStatus', $sessionKey);
        Session::put($sessionKey, true);

        $activeCostStatus = Session::get('arraycostStatus', []);
        foreach ($activeCostStatus as $costStatus) {
            if ($costStatus != $sessionKey) {
                Session::put('arraycostStatus', array_diff($activeCostStatus, [$costStatus]));
                Session::forget($costStatus);
            }
        }

        return redirect()->route('member.checkout')->with([
            'chooseShipmentPrice_success', "Anda memilih {$serviceName} ({$serviceDescription})!",
            'costs' => $costs
        ]);
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
            $shipment_price = $cart->shipment_price;
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

            $responseCities = Http::withHeaders([
                'key' => '1b3d1a91f7ab9a1c6dcc5543cb9192fb'
            ])->get('https://pro.rajaongkir.com/api/city');
            $cities = $responseCities['rajaongkir']['results'];

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
                "point" => $point,
                "cities" => $cities
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
                // $orderDate = Carbon::parse($order->order_date);
                // $currentDate = Carbon::now();
                // $daysDifference = $currentDate->diffInDays($orderDate);

                // // Ambil estimasi pengiriman dari data order
                // // Asumsi bahwa $order->delivery_estimate berisi string seperti "1-2" atau "5"
                // $deliveryEstimate = $order->shipment_estimation;

                // // Konversi estimasi hari pengiriman menjadi jumlah hari maksimal
                // if (strpos($deliveryEstimate, '-') !== false) {
                //     $parts = explode('-', $deliveryEstimate);
                //     $estimateDays = (int)$parts[1];
                // } else {
                //     $estimateDays = (int)$deliveryEstimate;
                // }

                // if ($daysDifference > $estimateDays) {
                //     $arrivedDate = $orderDate->copy()->addDays($estimateDays);
                //     $order->update(['arrived_date' => $arrivedDate]);
                //     $order->update(['acceptbyCustomer_status' => 'Sudah']);
                // }

                $courier = '';
                $waybill =  $order->waybill;
                if($waybill != '') {
                    // dd($waybill);
                    if (stripos($order->shipment_service, 'JNE') !== false) {
                        $courier = 'jne';
                    } elseif (stripos($order->shipment_service, 'SiCepat') !== false) {
                        $courier = 'sicepat';
                    }

                    $responseWaybills = Http::withHeaders([
                        'key' => '1b3d1a91f7ab9a1c6dcc5543cb9192fb',
                    ])->post('https://pro.rajaongkir.com/api/waybill', [
                        'waybill' => $waybill,
                        'courier' => $courier
                    ]);
                    // dd($responseWaybills['rajaongkir']);
                    $waybills = $responseWaybills['rajaongkir']['result'];
                    if($waybills['delivery_status']['pod_date'] != "" || $waybills['delivery_status']['pod_date'] != null) {
                        $order->update(['arrived_date' => $waybills['delivery_status']['pod_date'] . ' ' . $waybills['delivery_status']['pod_time']]);
                    }
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
        // Simpan data alamat ke session
        $request->session()->put('checkout.address_id', $request->address_id);
        $request->session()->put('checkout.address', $request->address);
        $request->session()->put('checkout.city', $request->city);
        $request->session()->put('checkout.note', $request->note);

        $validatedData = $request->validate([
            'address_id' => 'required_without:address|integer',
            'address' => 'required_if:address_id,0|string|nullable|max:100',
            'destination_city' => 'required',
            // 'province' => 'required|string|max:50',
            // 'postal_code' => 'required|numeric',
            'note' => 'nullable|string|max:255',
            // 'payment_upload' => 'required|image|file|max:5000',
            'total_poin' => 'required|numeric',
            'reward_now' => 'numeric'
        ], [
            'address_id.required_without' => 'Alamat Pengiriman wajib diisi!',
            'address.required_if' => 'Alamat Pengiriman wajib diisi!',
            'address.max' => 'Maksimal :max karakter!',
            'destination_city.required' => 'Kota wajib diisi!',
            // 'city.string' => 'Kota wajib berupa karakter!',
            // 'city.max' => 'Maksimal :max karakter!',
            // 'province.required' => 'Provinsi wajib diisi!',
            // 'province.string' => 'Provinsi wajib berupa karakter!',
            // 'province.max' => 'Maksimal :max karakter!',
            // 'postal_code.required' => 'Kode Pos wajib diisi!',
            // 'postal_code.numeric' => 'Kode Pos wajib berupa angka!',
            'note.max' => 'Maksimal :max karakter!',
            // 'payment_upload.required' => 'Mohon upload bukti pembayaran anda!',
            // 'payment_upload.image' => 'File wajib berupa gambar!',
            // 'payment_upload.max' => 'Maksimal ukuran gambar 5MB!',
            'total_poin.required' => 'Total poin wajib diisi!',
            'total_poin.numeric' => 'Total poin wajib berupa angka!',
            'reward_now.numeric' => 'Total reward sekarang wajib berupa angka!',
        ]);

        if (!$request->courier) {
            return redirect()->back()->withErrors(['courierForgotten_error' => "Oops, anda lupa memilih jasa pengiriman yang akan digunakan!"]);
        }

        $order_date = now();

        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $cart_details = $cart->cart_detail;
        $total_weight = $cart_details->sum('weight');
        $shipment_price = $cart->shipment_price;

        $customer = User::where('id', Auth::user()->id)->first();
        $point = Point::first();

        $responseCities = Http::withHeaders([
            'key' => '1b3d1a91f7ab9a1c6dcc5543cb9192fb'
        ])->get('https://pro.rajaongkir.com/api/city');
        $cities = $responseCities['rajaongkir']['results'];

        $customer_city = null;
        $customer_province = null;
        $customer_postal_code = null;
        foreach ($cities as $city) {
            if ($city['city_id'] == $request->destination_city) {
                $customer_city = $city['city_name'];
                $customer_province = $city['province'];
                $customer_postal_code = $city['postal_code'];
                break;
            }
        }

        $origin_id = null;
        foreach ($cities as $city) {
            if ($city['city_name'] == 'Surabaya') {
                $origin_id = $city['city_id'];
                break;
            }
        }

        $responseCost = Http::withHeaders([
            'key' => '1b3d1a91f7ab9a1c6dcc5543cb9192fb',
        ])->post('https://pro.rajaongkir.com/api/cost', [
            'origin' => $origin_id,
            'originType' => 'city',
            'destination' => $request->destination_city,
            'destinationType' => 'city',
            'weight' => $total_weight,
            'courier' => $request->courier
        ]);
        $costs = $responseCost['rajaongkir'];

        $courierName = null;
        $serviceName = null;
        $shipment_estimation = null;
        $shipment_price_check = null;
        foreach ($costs['results'] as $cost) {
            if ($cost['code'] == $request->courier) {
                $courierName = $cost['name'];
                foreach ($cost['costs'] as $index => $cost_detail) {
                    if ($request->service == $cost_detail['service']) {
                        $serviceName = $cost_detail['service'];
                        foreach ($cost_detail['cost'] as $cost_value) {
                            if ($request->service == $cost_detail['service']) {
                                $shipment_price_check = $cost_value['value'];
                                $shipment_estimation = $cost_value['etd'];
                                break; // Keluar dari loop paling dalam
                            }
                        }
                        break; // Keluar dari loop tengah
                    }
                }
                break; // Keluar dari loop terluar
            }
        }

        // dd($shipment_price_check, $cart->shipment_price);
        if ($shipment_price_check != $shipment_price) {
            Session::put('costs', $costs);
            return redirect()->back()->withErrors(['courierForgotten_error' => "Oops, anda lupa memilih jasa pengiriman yang akan digunakan!"]);
        }

        $shipment_service = $courierName . ', ' . $serviceName;

        if (Session::has('pointStatus')) {
            Session::forget('pointStatus');
            $total_price_beforeReward = $cart_details->sum('price') + $shipment_price;
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
            $total_price = $cart_details->sum('price') + $shipment_price;
        }
        $customer->update([
            'reward' => $customer->reward + $validatedData['total_poin']
        ]);

        // if ($request->file('payment_upload')) {
        //     $validatedData['payment'] = $request->file('payment_upload')->store('bukti_transfer', ['disk' => 'public']);
        // }

        $midtrans_order_id = rand();
        if ($validatedData['address_id']) {
            $address = Address::find($validatedData['address_id']);
            if ($validatedData['note']) {
                $order = Order::create([
                    'user_id' => Auth::user()->id,
                    'address_id' => $validatedData['address_id'],
                    'midtrans_order_id' => $midtrans_order_id,
                    'order_date' => $order_date,
                    'total_price' => $total_price,
                    'total_weight' => $total_weight,
                    // 'payment' => $validatedData['payment'],
                    'note' => $validatedData['note'],
                    'shipment_service' => $shipment_service,
                    'shipment_estimation' => $shipment_estimation,
                ]);
            } else {
                $order = Order::create([
                    'user_id' => Auth::user()->id,
                    'address_id' => $validatedData['address_id'],
                    'midtrans_order_id' => $midtrans_order_id,
                    'order_date' => $order_date,
                    'total_price' => $total_price,
                    'total_weight' => $total_weight,
                    // 'payment' => $validatedData['payment'],
                    'shipment_service' => $shipment_service,
                    'shipment_estimation' => $shipment_estimation,
                ]);
            }
        } else {
            $address = Address::create([
                'user_id' => Auth::user()->id,
                'address' => $validatedData['address'],
                'midtrans_order_id' => $midtrans_order_id,
                'city' => $customer_city,
                'city_id' => $request->city,
                'province' => $customer_province,
                'postal_code' => $customer_postal_code
            ]);
            if ($validatedData['note']) {
                $order = Order::create([
                    'user_id' => Auth::user()->id,
                    'address_id' => $address->id,
                    'midtrans_order_id' => $midtrans_order_id,
                    'order_date' => $order_date,
                    'total_price' => $total_price,
                    'total_weight' => $total_weight,
                    // 'payment' => $validatedData['payment'],
                    'note' => $validatedData['note'],
                    'shipment_service' => $shipment_service,
                    'shipment_estimation' => $shipment_estimation,
                ]);
            } else {
                $order = Order::create([
                    'user_id' => Auth::user()->id,
                    'address_id' => $address->id,
                    'midtrans_order_id' => $midtrans_order_id,
                    'order_date' => $order_date,
                    'total_price' => $total_price,
                    'total_weight' => $total_weight,
                    // 'payment' => $validatedData['payment'],
                    'shipment_service' => $shipment_service,
                    'shipment_estimation' => $shipment_estimation,
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

        // Mempersiapkan item_details dinamis
        $item_details = [];
        foreach ($cart_details as $cart_detail) {
            $item_details[] = [
                'id' => $cart_detail->product_id,
                'price' => $cart_detail->product->price,
                'quantity' => $cart_detail->quantity,
                'name' => $cart_detail->product->name, // Asumsi Anda memiliki relasi produk
            ];
        }

        // Tambahkan biaya pengiriman sebagai item terpisah
        $item_details[] = [
            'id' => 'SHIPPING_COST',
            'price' => $shipment_price,
            'quantity' => 1,
            'name' => 'Shipping Cost'
        ];

        // Tambahkan item diskon berdasarkan poin jika ada pointStatus
        if (Session::has('pointStatus')) {
            Session::forget('pointStatus');
            $item_details[] = [
                'id' => 'POINT_DISCOUNT',
                'price' => -$reward_now, // Nilai diskon negatif
                'quantity' => 1,
                'name' => 'Point Discount'
            ];
        }

        // Siapkan parameter untuk Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $order->midtrans_order_id,
                'gross_amount' => $total_price,
            ],
            'item_details' => $item_details,
            'customer_details' => [
                'first_name' => $customer->name,
                'last_name' => "",
                'email' => $customer->email,
                'phone' => $customer->phone_number,
                'billing_address' => [
                    'first_name' => $customer->name,
                    'last_name' => "",
                    'email' => $customer->email,
                    'phone' => $customer->phone_number,
                    'address' => $address->address,
                    'city' => $address->city,
                    'postal_code' => $address->postal_code,
                    'country_code' => ""
                ],
                'shipping_address' => [
                    'first_name' => $customer->name,
                    'last_name' => "",
                    'email' => $customer->email,
                    'phone' => $customer->phone_number,
                    'address' => $address->address,
                    'city' => $address->city,
                    'postal_code' => $address->postal_code,
                    'country_code' => ""
                ]
            ],
        ];
        try {
            $paymentUrl = Snap::createTransaction($params)->redirect_url;
            return redirect($paymentUrl);
        } catch (\Exception $e) {
            Session::put('costs', $costs);
            return back()->withErrors([
                'paymentUrl_ERROR' => 'Error saat melakukan proses pembayaran! Silahkan menghubungi Lisahwan™ (082230308030)!'
            ]);
            // return redirect()->route('products')->with('order_success', 'Pemesanan anda berhasil! <br><a href="' . route('member.orderhistory') . '" class="inline-flex items-center font-bold text-yellow-500 hover:underline">Check Status Pesanan <svg class="ml-1 w-4 h-4 text-yellow-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10"> <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M1 5h12m0 0L9 1m4 4L9 9" /> </svg></a>');
        }
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
