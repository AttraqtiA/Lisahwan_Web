<?php

namespace App\Http\Controllers\Owner;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Address;
use App\Models\Product;
use App\Models\CartDetail;
use App\Models\Production;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller; // tambah ini buat yg folder per role

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Order::where(function ($query) {
            $query->where('acceptbyAdmin_status', 'pending')
                ->orWhere('acceptbyAdmin_status', 'unpaid')
                ->orWhere('acceptbyAdmin_status', 'expire')
                ->orWhere('acceptbyAdmin_status', 'cancel')
                ->orWhere('acceptbyAdmin_status', 'refund')
                ->orWhere('acceptbyAdmin_status', 'partial_refund');
        })
            ->where('created_at', '<', Carbon::now()->subHours(24))
            ->delete();

        // Waktu sekarang
        $now = Carbon::now();

        // Hapus kupon yang sudah kedaluwarsa
        Coupon::where('ending_time', '<', $now)->delete();

        $ordersQuery = Order::query();

        // Initialize $parsedDate to null
        $parsedDate = null;

        if ($request->has('search')) {
            $searchTerm = $request->search;

            // Attempt to parse the search term as a date
            try {
                // Parse the search term to find date range or month-year
                $parsedDate = Carbon::parse($searchTerm, config('app.timezone'));

                // Format the parsed date for comparison with database date fields
                $formattedDate = $parsedDate->format('Y-m-d');

                $ordersQuery->where(function ($query) use ($formattedDate, $parsedDate) {
                    // Check if search term is a full date
                    if ($parsedDate->day != 1 && $parsedDate->month != 1) {
                        $query->whereDate('order_date', $formattedDate)
                            ->orWhereDate('shipment_date', $formattedDate)
                            ->orWhereDate('arrived_date', $formattedDate);
                    } else {
                        // Check if search term is a month-year
                        $query->where(DB::raw('DATE_FORMAT(order_date, "%Y-%m")'), $formattedDate)
                            ->orWhere(DB::raw('DATE_FORMAT(shipment_date, "%Y-%m")'), $formattedDate)
                            ->orWhere(DB::raw('DATE_FORMAT(arrived_date, "%Y-%m")'), $formattedDate);

                        // Check if search term is a month only
                        $query->orWhere(DB::raw('DATE_FORMAT(order_date, "%M")'), 'like', '%' . $parsedDate->format('F') . '%')
                            ->orWhere(DB::raw('DATE_FORMAT(shipment_date, "%M")'), 'like', '%' . $parsedDate->format('F') . '%')
                            ->orWhere(DB::raw('DATE_FORMAT(arrived_date, "%M")'), 'like', '%' . $parsedDate->format('F') . '%');

                        // Check if search term is a year only
                        $query->orWhere(DB::raw('YEAR(order_date)'), 'like', '%' . $parsedDate->format('Y') . '%')
                            ->orWhere(DB::raw('YEAR(shipment_date)'), 'like', '%' . $parsedDate->format('Y') . '%')
                            ->orWhere(DB::raw('YEAR(arrived_date)'), 'like', '%' . $parsedDate->format('Y') . '%');
                    }
                });
            } catch (\Exception $e) {
                // Handle non-date search term (search in other fields)
                $ordersQuery->where(function ($query) use ($searchTerm) {
                    $query->orWhere('is_print', 'like', '%' . $searchTerm . '%')
                        ->orWhere('shipment_status', 'like', '%' . $searchTerm)
                        ->orWhere('acceptbyAdmin_status', 'like', '%' . $searchTerm . '%')
                        ->orWhere('acceptbyCustomer_status', 'like', '%' . $searchTerm . '%')
                        ->orWhere('total_price', 'like', '%' . $searchTerm . '%')
                        ->orWhere('note', 'like', '%' . $searchTerm . '%');

                    $query->orWhereHas('user', function ($userQuery) use ($searchTerm) {
                        $userQuery->where('name', 'like', '%' . $searchTerm . '%')
                            ->orWhere('phone_number', 'like', '%' . $searchTerm . '%');
                    });

                    $query->orWhereHas('address', function ($addressQuery) use ($searchTerm) {
                        $addressQuery->where('address', 'like', '%' . $searchTerm . '%');
                    });
                });
            }
        }

        // Query orders by date criteria
        $orders = $ordersQuery->where(function ($query) {
            $query->whereDate('order_date', Carbon::today())
                ->orWhereDate('order_date', Carbon::yesterday());
        })->orderBy('created_at', 'desc')->paginate(10);

        // Initialize order number for pagination
        $orderNumber = $orders->firstItem();

        // Count total orders
        $totalOrders = $ordersQuery->count();

        // Fetch user cart details
        $cart_user = Cart::where('user_id', Auth::user()->id)->first();
        $carts = $cart_user ? $cart_user->cart_detail : null;

        foreach ($orders as $order) {
            $courier = '';
            $waybill =  $order->waybill;
            if ($waybill != '') {
                if (stripos($order->shipment_service, 'Lion') !== false) {
                    $courier = 'lion';
                } elseif (stripos($order->shipment_service, 'AnterAja') !== false) {
                    $courier = 'anteraja';
                }

                $responseWaybills = Http::withHeaders([
                    'key' => '1b3d1a91f7ab9a1c6dcc5543cb9192fb',
                ])->post('https://pro.rajaongkir.com/api/waybill', [
                    'waybill' => $waybill,
                    'courier' => $courier
                ]);

                // Memeriksa apakah respons dari API valid
                $responseJson = $responseWaybills->json();

                if (isset($responseJson['rajaongkir']['status']['code']) && $responseJson['rajaongkir']['status']['code'] !== 200) {
                    return redirect()->back()->withErrors([
                        'waybillNotValid_error' => 'Nomor resi tidak valid atau informasi pengiriman tidak ditemukan!'
                    ]);
                }

                $waybills = $responseWaybills['rajaongkir']['result'];

                if (!empty($waybills['summary']['status'])) {
                    $order->update([
                        'shipment_status' => $waybills['summary']['status']
                    ]);
                }

                if (!empty($waybills['details']['waybill_date']) && !empty($waybills['details']['waybill_time'])) {
                    $order->update([
                        'shipment_date' => $waybills['details']['waybill_date'] . ' ' . $waybills['details']['waybill_time'],
                    ]);
                }

                if (!empty($waybills['delivery_status']['pod_date']) && !empty($waybills['delivery_status']['pod_time'])) {
                    $order->update([
                        'arrived_date' => $waybills['delivery_status']['pod_date'] . ' ' . $waybills['delivery_status']['pod_time'],
                        'acceptbyCustomer_status' => 'sudah'
                    ]);
                }
            }
        }

        return view('admin.admin_dashboard', [
            "TabTitle" => "Daftar Order Hari ini dan Kemarin",
            "active_1" => "text-yellow-500",
            "orders" => $orders,
            "orderNumber" => $orderNumber,
            "totalOrders" => $totalOrders,
            'carts' =>  $carts
        ]);
    }



    // ====================================== CASHIER MANAGEMENT SYSTEM ======================================
    public function showAllProducts()
    {
        // Fetch user cart details
        $cart_user = Cart::where('user_id', Auth::user()->id)->first();
        $carts = $cart_user ? $cart_user->cart_detail : null;
        return view('admin.products_order', [
            "TabTitle" => "Daftar Produk Lisahwan",
            "active_5" => "text-yellow-500",
            "pageTitle" => '<mark class="px-2 text-yellow-500 bg-gray-900 rounded">Produk</mark> Lisahwan',
            'pageDescription' => 'Jelajahi camilan terbaik di <span class="underline underline-offset-2 decoration-4 decoration-yellow-500">Lisahwan</span> dan pilih favorit Anda sekarang!',
            "products" => Product::all(),
            "carts" => $carts
        ]);
    }

    public function addProduct(Request $request, $id)
    {
        $last_quantity = 0;
        if (Session::has('last_quantity_' . $id)) {
            $last_quantity = Session::get('last_quantity_' . $id);
        }
        // dd($last_quantity);

        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $product = Product::find($id);

        $validatedData = $request->validate([
            "quantity" => "required|not_in:0",
        ], [
            'quantity.required' => 'Oops! Anda lupa mengisikan jumlah pesanan!',
            'quantity.not_in' => 'Oops! Anda lupa mengisikan jumlah pesanan!'
        ]);

        $total_price = $validatedData['quantity'] * $product->price;
        $total_weight = $product->weight * $validatedData['quantity'];

        $quantity_final = $validatedData['quantity'] - $last_quantity;

        if ($quantity_final <= $product->stock) {
            Session::put('last_quantity_' . $id, $request->quantity);
            if (!$cart) {
                $cart_new = Cart::create([
                    'user_id' => Auth::user()->id
                ]);
                CartDetail::create([
                    'cart_id' => $cart_new->id,
                    'product_id' => $id,
                    'quantity' => $validatedData['quantity'],
                    'price' => $total_price,
                    'weight' => $total_weight
                ]);
                $product->update([
                    'stock' =>  $product->stock - $validatedData['quantity']
                ]);
                Production::create([
                    'date' => now(),
                    'product_id' => $id,
                    'quantity' => $validatedData['quantity'],
                    'type' => 'kurang'
                ]);
            } else {
                $cart_detail = $cart->cart_detail;
                $check_product = $cart_detail->where('product_id', $id)->first();

                if ($check_product) {
                    if ($check_product->quantity < $validatedData['quantity']) {
                        $total_quantity =  -1 * ($check_product->quantity - $validatedData['quantity']);
                        $product->update([
                            'stock' =>  $product->stock - $total_quantity
                        ]);
                        Production::create([
                            'date' => now(),
                            'product_id' => $id,
                            'quantity' => $total_quantity,
                            'type' => 'kurang'
                        ]);
                    } else {
                        $total_quantity =  $check_product->quantity - $validatedData['quantity'];
                        $product->update([
                            'stock' =>  $product->stock + $total_quantity
                        ]);
                        Production::create([
                            'date' => now(),
                            'product_id' => $id,
                            'quantity' => $total_quantity,
                            'type' => 'tambah'
                        ]);
                    }
                    $check_product->update([
                        'quantity' => $validatedData['quantity'],
                        'price' => $total_price,
                        'weight' => $total_weight
                    ]);
                } else {
                    CartDetail::create([
                        'cart_id' => $cart->id,
                        'product_id' => $id,
                        'quantity' => $validatedData['quantity'],
                        'price' => $total_price,
                        'weight' => $total_weight
                    ]);
                    $product->update([
                        'stock' =>  $product->stock - $validatedData['quantity']
                    ]);
                    Production::create([
                        'date' => now(),
                        'product_id' => $id,
                        'quantity' => $validatedData['quantity'],
                        'type' => 'kurang'
                    ]);
                }
            }
            return redirect()->route('owner.products')->with('addCart_success', 'Pesanan ditambahkan ke keranjang!');
        } else {
            return back()->with('over_quantity', 'Mohon maaf, pesanan anda melebihi stok!');
        }
    }

    public function showCarts()
    {
        $cart_user = Cart::where('user_id', Auth::user()->id)->first();
        if (empty($cart_user)) {
            $carts = null;
        } else {
            $carts = $cart_user->cart_detail;
        }
        return view(
            'admin.carts',
            [
                "TabTitle" => "Keranjang",
                "active_6" => "text-yellow-500",
                "pageTitle" => '<mark class="px-2 text-yellow-500 bg-gray-900 rounded">Keranjang</mark> Belanjaan',
                'pageDescription' => 'Setiap produk Lisahwan <span class="underline underline-offset-2 decoration-4 decoration-yellow-500">Lisahwan</span> telah dibuat  spesial untuk anda!',
                "carts" => $carts,
            ]
        );
    }

    public function editProduct(Request $request, $id)
    {
        $cart_detail = CartDetail::where('id', $id)->first();
        $last_quantity = 0;
        if (Session::has('last_quantity_' . $cart_detail->product->id)) {
            $last_quantity = Session::get('last_quantity_' . $cart_detail->product->id);
        }

        $validatedData = $request->validate([
            "quantity" => "required|not_in:0"
        ], [
            'quantity.required' => 'Oops! Anda lupa mengisikan jumlah pesanan!',
            'quantity.not_in' => 'Oops! Anda lupa mengisikan jumlah pesanan!'
        ]);

        $total_price = $validatedData['quantity'] * $cart_detail->product->price;
        $total_weight = $cart_detail->product->weight * $validatedData['quantity'];

        $quantity_final = $validatedData['quantity'] - $last_quantity;

        if ($quantity_final <= $cart_detail->product->stock) {
            Session::put('last_quantity_' . $cart_detail->product->id, $request->quantity);
            $quantity_difference = $validatedData['quantity'] - $cart_detail->quantity;
            $product = $cart_detail->product;
            $product->update([
                'stock' => $cart_detail->product->stock - $quantity_difference
            ]);
            // $production = Production::where('product_id', $product->id)->first();
            if ($validatedData['quantity'] < $cart_detail->quantity) {
                Production::create([
                    'date' => now(),
                    'product_id' => $product->id,
                    'quantity' => abs($quantity_difference),
                    'type' => 'tambah'
                ]);
            } else {
                Production::create([
                    'date' => now(),
                    'product_id' => $product->id,
                    'quantity' => abs($quantity_difference),
                    'type' => 'kurang'
                ]);
            }
            $cart_detail->update([
                'quantity' => $validatedData['quantity'],
                'price' => $total_price,
                'weight' => $total_weight
            ]);
            return back()->with('updateCart_success', 'Pesanan berhasil diperbarui!');
        } else {
            return back()->with('over_quantity', 'Mohon maaf, pesanan anda melebihi stok!');
        }
    }

    public function deleteProduct($id)
    {
        $cartDetail = CartDetail::find($id);
        $productId = $cartDetail->product->id;
        Session::forget('last_quantity_' . $productId);
        if ($cartDetail) {
            // Temukan Cart yang sesuai dengan relasi
            $cart = $cartDetail->cart;

            // Update stock produk yang dihapus
            $cartDetail->product->update([
                'stock' => $cartDetail->product->stock + $cartDetail->quantity
            ]);

            // Hapus CartDetail
            $cartDetail->delete();

            Production::create([
                'date' => now(),
                'product_id' => $productId,
                'quantity' => $cartDetail->quantity,
                'type' => 'tambah'
            ]);

            // Periksa apakah setelah menghapus CartDetail, tidak ada lagi cart_detail dalam keranjang
            if ($cart && $cart->cart_detail->isEmpty()) {
                // Jika tidak ada cart_detail, hapus juga keranjangnya
                $cart->delete();
            }
            return back()->with('deleteCart_success', 'Pesanan berhasil dihapus!');
        }
    }

    public function checkout(Request $request)
    {
        $validatedData = [];

        if ($request->has('cash_payment')) {
            // Pembayaran tunai
            $validatedData['payment'] = $request->cash_payment;
        } elseif ($request->hasFile('payment_upload')) {
            // Pembayaran dengan upload bukti
            $validatedData = $request->validate([
                'payment_upload' => 'image|file|max:5000',
            ], [
                'payment_upload.image' => 'File wajib berupa gambar!',
                'payment_upload.max' => 'Maksimal ukuran gambar 5MB!',
            ]);

            $validatedData['payment'] = $request->file('payment_upload')->store('bukti_transfer', ['disk' => 'public']);
        } else {
            // Jika tidak ada cash_payment atau payment_upload
            return redirect()->back()->withErrors(['payment_upload.required' => 'Mohon upload bukti pembayaran anda!']);
        }

        $order_date = now();

        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $cart_details = $cart->cart_detail;

        if (Session::has('final_price') && Session::has('discountStatus')) {
            Session::forget('final_price');
            Session::forget('discountStatus');
            $final_price = $cart_details->sum('price') - ($cart_details->sum('price') * (5 / 100));
            $total_price = $final_price;
        } else {
            $total_price = $cart_details->sum('price');
        }

        $total_weight = $cart_details->sum('weight');

        $address = Address::create([
            'user_id' => Auth::user()->id,
            'address' => "Jalan Jemur Andayani XIII. No. 6",
            'city' => "Surabaya",
            'province' => "Jawa Timur",
            'postal_code' => 60237
        ]);

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'address_id' => $address->id,
            'order_date' => $order_date,
            'shipment_date' => $order_date,
            'arrived_date' => $order_date,
            'total_price' => $total_price,
            'total_weight' => $total_weight,
            'payment' => $validatedData['payment'],
            'note' => "Transaksi dilakukan oleh " . Auth::user()->name,
            'acceptbyAdmin_status' => "paid",
            'acceptbyCustomer_status' => "sudah",
            'shipment_status' => "sudah"
        ]);

        foreach ($cart_details as $cart_detail) {
            $productId = $cart_detail->product->id;
            Session::forget('last_quantity_' . $productId);
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $cart_detail->product_id,
                'quantity' => $cart_detail->quantity,
                'price' => $cart_detail->price,
                'weight' => $cart_detail->weight
            ]);
        }

        $cart->delete();

        return redirect()->route('owner.products')->with('order_success', 'Pesanan anda berhasil! <br><a href="' . route('owner.admin') . '" class="inline-flex items-center font-bold text-yellow-500 hover:underline">Check Detail Pesanan <svg class="ml-1 w-4 h-4 text-yellow-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10"> <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M1 5h12m0 0L9 1m4 4L9 9" /> </svg></a>');
    }

    public function generateReceipt_CART($id)
    {
        $cart = Cart::where('user_id', $id)->first();
        $cart_details = $cart->cart_detail;
        if (Session::has('final_price') && Session::has('discountStatus')) {
            $final_price = $cart_details->sum('price') - ($cart_details->sum('price') * (5 / 100));
        } else {
            $final_price = 0;
        }

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8', 'format' => [58, 210],
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
            'margin_header' => 0,
            'margin_footer' => 0,
            'orientation' => 'P'
        ]);

        $mpdf->WriteHTML(view("admin.receiptCart", [
            'cart' => $cart,
            'final_price' => $final_price,
        ]));

        $mpdf->Output();
    }

    public function generateReceipt_ORDER($id)
    {
        $order = Order::where('id', $id)->first();
        $order_details = $order->order_detail;
        if ($order_details->sum('price') != $order->total_price) {
            $final_price = $order_details->sum('price') - ($order_details->sum('price') * (5 / 100));
            $before_discount_price = $order_details->sum('price');
        } else {
            $final_price = 0;
            $before_discount_price = 0;
        }

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8', 'format' => [58, 210],
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
            'margin_header' => 0,
            'margin_footer' => 0,
            'orientation' => 'P'
        ]);

        $mpdf->WriteHTML(view("admin.receiptOrder", [
            'order' => $order,
            'final_price' => $final_price,
            'before_discount_price' => $before_discount_price,
        ]));

        $mpdf->Output();
    }

    public function generateShipmentLabel($id)
    {
        $order = Order::where('id', $id)->first();

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8', 'format' => 'A6',
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
            'margin_header' => 0,
            'margin_footer' => 0,
            'orientation' => 'L'
        ]);

        $mpdf->WriteHTML(view("admin.shipmentLabel", ['order' => $order]));

        $mpdf->Output();
    }
    // ========================================================================================================



    public function history(Request $request)
    {
        Order::where(function ($query) {
            $query->where('acceptbyAdmin_status', 'pending')
                ->orWhere('acceptbyAdmin_status', 'unpaid')
                ->orWhere('acceptbyAdmin_status', 'expire')
                ->orWhere('acceptbyAdmin_status', 'cancel')
                ->orWhere('acceptbyAdmin_status', 'refund')
                ->orWhere('acceptbyAdmin_status', 'partial_refund');
        })
            ->where('created_at', '<', Carbon::now()->subHours(24))
            ->delete();

        $ordersQuery = Order::query();

        // Initialize $parsedDate to null
        $parsedDate = null;

        if ($request->has('search')) {
            $searchTerm = $request->search;

            // Attempt to parse the search term as a date
            try {
                // Parse the search term to find date range or month-year
                $parsedDate = Carbon::parse($searchTerm, config('app.timezone'));

                // Format the parsed date for comparison with database date fields
                $formattedDate = $parsedDate->format('Y-m-d');

                $ordersQuery->where(function ($query) use ($formattedDate, $parsedDate) {
                    // Check if search term is a full date
                    if ($parsedDate->day != 1 && $parsedDate->month != 1) {
                        $query->whereDate('order_date', $formattedDate)
                            ->orWhereDate('shipment_date', $formattedDate)
                            ->orWhereDate('arrived_date', $formattedDate);
                    } else {
                        // Check if search term is a month-year
                        $query->where(DB::raw('DATE_FORMAT(order_date, "%Y-%m")'), $formattedDate)
                            ->orWhere(DB::raw('DATE_FORMAT(shipment_date, "%Y-%m")'), $formattedDate)
                            ->orWhere(DB::raw('DATE_FORMAT(arrived_date, "%Y-%m")'), $formattedDate);

                        // Check if search term is a month only
                        $query->orWhere(DB::raw('DATE_FORMAT(order_date, "%M")'), 'like', '%' . $parsedDate->format('F') . '%')
                            ->orWhere(DB::raw('DATE_FORMAT(shipment_date, "%M")'), 'like', '%' . $parsedDate->format('F') . '%')
                            ->orWhere(DB::raw('DATE_FORMAT(arrived_date, "%M")'), 'like', '%' . $parsedDate->format('F') . '%');

                        // Check if search term is a year only
                        $query->orWhere(DB::raw('YEAR(order_date)'), 'like', '%' . $parsedDate->format('Y') . '%')
                            ->orWhere(DB::raw('YEAR(shipment_date)'), 'like', '%' . $parsedDate->format('Y') . '%')
                            ->orWhere(DB::raw('YEAR(arrived_date)'), 'like', '%' . $parsedDate->format('Y') . '%');
                    }
                });
            } catch (\Exception $e) {
                // Handle non-date search term (search in other fields)
                $ordersQuery->where(function ($query) use ($searchTerm) {
                    $query->orWhere('is_print', 'like', '%' . $searchTerm . '%')
                        ->orWhere('shipment_status', 'like', '%' . $searchTerm)
                        ->orWhere('acceptbyAdmin_status', 'like', '%' . $searchTerm . '%')
                        ->orWhere('acceptbyCustomer_status', 'like', '%' . $searchTerm . '%')
                        ->orWhere('total_price', 'like', '%' . $searchTerm . '%')
                        ->orWhere('note', 'like', '%' . $searchTerm . '%');

                    $query->orWhereHas('user', function ($userQuery) use ($searchTerm) {
                        $userQuery->where('name', 'like', '%' . $searchTerm . '%')
                            ->orWhere('phone_number', 'like', '%' . $searchTerm . '%');
                    });

                    $query->orWhereHas('address', function ($addressQuery) use ($searchTerm) {
                        $addressQuery->where('address', 'like', '%' . $searchTerm . '%');
                    });
                });
            }
        }

        // Query orders by date criteria
        $orders = $ordersQuery->orderBy('created_at', 'desc')->paginate(10);

        // Initialize order number for pagination
        $orderNumber = $orders->firstItem();

        // Count total orders
        $totalOrders = $ordersQuery->count();

        // Fetch user cart details
        $cart_user = Cart::where('user_id', Auth::user()->id)->first();
        $carts = $cart_user ? $cart_user->cart_detail : null;

        foreach ($orders as $order) {
            $courier = '';
            $waybill =  $order->waybill;
            if ($waybill) {
                if (stripos($order->shipment_service, 'Lion') !== false) {
                    $courier = 'lion';
                } elseif (stripos($order->shipment_service, 'AnterAja') !== false) {
                    $courier = 'anteraja';
                }

                $responseWaybills = Http::withHeaders([
                    'key' => '1b3d1a91f7ab9a1c6dcc5543cb9192fb',
                ])->post('https://pro.rajaongkir.com/api/waybill', [
                    'waybill' => $waybill,
                    'courier' => $courier
                ]);

                // Memeriksa apakah respons dari API valid
                $responseJson = $responseWaybills->json();

                if (isset($responseJson['rajaongkir']['status']['code']) && $responseJson['rajaongkir']['status']['code'] !== 200) {
                    return redirect()->back()->withErrors([
                        'waybillNotValid_error' => 'Nomor resi tidak valid atau informasi pengiriman tidak ditemukan!'
                    ]);
                }

                $waybills = $responseWaybills['rajaongkir']['result'];

                if (!empty($waybills['summary']['status'])) {
                    $order->update([
                        'shipment_status' => $waybills['summary']['status']
                    ]);
                }

                if (!empty($waybills['details']['waybill_date']) && !empty($waybills['details']['waybill_time'])) {
                    $order->update([
                        'shipment_date' => $waybills['details']['waybill_date'] . ' ' . $waybills['details']['waybill_time'],
                    ]);
                }

                if (!empty($waybills['delivery_status']['pod_date']) && !empty($waybills['delivery_status']['pod_time'])) {
                    $order->update([
                        'arrived_date' => $waybills['delivery_status']['pod_date'] . ' ' . $waybills['delivery_status']['pod_time'],
                        'acceptbyCustomer_status' => 'sudah'
                    ]);
                }
            }
        }

        return view('admin.order_history', [
            "TabTitle" => "Daftar Seluruh Order",
            "active_2" => "text-yellow-500",
            "orders" => $orders,
            "orderNumber" => $orderNumber,
            "totalOrders" => $totalOrders,
            'carts' => $carts
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
    public function updateToday(Request $request, Order $order)
    {
        // $validatedData = $request->validate([
        //     'acceptbyAdmin_status' => 'required',
        //     'shipment_status' => 'required',
        //     'shipment_date' => 'required|date_format:Y-m-d\TH:i',
        //     'arrived_date' => 'required|date_format:Y-m-d\TH:i'
        // ], [
        //     'acceptbyAdmin_status.required' => 'Status penerimaan oleh Admin wajib diisi!',
        //     'shipment_status.required' => 'Status pengiriman wajib diisi!',
        //     'shipment_date.required' => 'Tanggal pengiriman wajib diisi!',
        //     'shipment_date.date_format' => 'Format tanggal pengiriman tidak valid!',
        //     'arrived_date.required' => 'Tanggal sampai wajib diisi!',
        //     'arrived_date.date_format' => 'Format tanggal sampai tidak valid!'
        // ]);

        // $order->update([
        //     'acceptbyAdmin_status' => $validatedData['acceptbyAdmin_status'],
        //     'shipment_status' => $validatedData['shipment_status'],
        //     'shipment_date' => $validatedData['shipment_date'],
        //     'arrived_date' => $validatedData['arrived_date']
        // ]);

        $validatedData = $request->validate([
            'waybill' => 'required|string',
        ], [
            'waybill.required' => 'Nomor resi pengiriman wajib diisi!',
            'waybill.string' => 'Nomor resi pengiriman wajib berupa karakter!'
        ]);

        $courier = '';
        $waybill =  $validatedData['waybill'];
        if (stripos($order->shipment_service, 'Lion') !== false) {
            $courier = 'lion';
        } elseif (stripos($order->shipment_service, 'AnterAja') !== false) {
            $courier = 'anteraja';
        }

        $responseWaybills = Http::withHeaders([
            'key' => '1b3d1a91f7ab9a1c6dcc5543cb9192fb',
        ])->post('https://pro.rajaongkir.com/api/waybill', [
            'waybill' => $waybill,
            'courier' => $courier
        ]);

        // Memeriksa apakah respons dari API valid
        $responseJson = $responseWaybills->json();

        if (isset($responseJson['rajaongkir']['status']['code']) && $responseJson['rajaongkir']['status']['code'] !== 200) {
            return redirect()->back()->withErrors([
                'waybillNotValid_error' => 'Nomor resi tidak valid atau informasi pengiriman tidak ditemukan!'
            ]);
        }

        $waybills = $responseWaybills['rajaongkir']['result'];

        if (!empty($waybills['summary']['status'])) {
            $order->update([
                'waybill' => $validatedData['waybill'],
                'shipment_status' => $waybills['summary']['status']
            ]);
        }

        if (!empty($waybills['details']['waybill_date']) && !empty($waybills['details']['waybill_time'])) {
            $order->update([
                'shipment_date' => $waybills['details']['waybill_date'] . ' ' . $waybills['details']['waybill_time']
            ]);
        }

        return redirect()->route('owner.admin')->with('updateOrderStatus_success', 'Status order berhasil diperbarui!');
    }

    public function updateHistory(Request $request, Order $order)
    {
        // $validatedData = $request->validate([
        //     'acceptbyAdmin_status' => 'required',
        //     'shipment_status' => 'required',
        //     'shipment_date' => 'required|date_format:Y-m-d\TH:i',
        //     'arrived_date' => 'required|date_format:Y-m-d\TH:i'
        // ], [
        //     'acceptbyAdmin_status.required' => 'Status penerimaan oleh Admin wajib diisi!',
        //     'shipment_status.required' => 'Status pengiriman wajib diisi!',
        //     'shipment_date.required' => 'Tanggal pengiriman wajib diisi!',
        //     'shipment_date.date_format' => 'Format tanggal pengiriman tidak valid!',
        //     'arrived_date.required' => 'Tanggal sampai wajib diisi!',
        //     'arrived_date.date_format' => 'Format tanggal sampai tidak valid!'
        // ]);

        // $order->update([
        //     'acceptbyAdmin_status' => $validatedData['acceptbyAdmin_status'],
        //     'shipment_status' => $validatedData['shipment_status'],
        //     'shipment_date' => $validatedData['shipment_date'],
        //     'arrived_date' => $validatedData['arrived_date']
        // ]);

        $validatedData = $request->validate([
            'waybill' => 'required|string',
        ], [
            'waybill.required' => 'Nomor resi pengiriman wajib diisi!',
            'waybill.string' => 'Nomor resi pengiriman wajib berupa karakter!'
        ]);

        $courier = '';
        $waybill = $validatedData['waybill'];

        if (stripos($order->shipment_service, 'Lion') !== false) {
            $courier = 'lion';
        } elseif (stripos($order->shipment_service, 'AnterAja') !== false) {
            $courier = 'anteraja';
        }

        $responseWaybills = Http::withHeaders([
            'key' => '1b3d1a91f7ab9a1c6dcc5543cb9192fb',
        ])->post('https://pro.rajaongkir.com/api/waybill', [
            'waybill' => $waybill,
            'courier' => $courier
        ]);

        // Memeriksa apakah respons dari API valid
        $responseJson = $responseWaybills->json();

        if (isset($responseJson['rajaongkir']['status']['code']) && $responseJson['rajaongkir']['status']['code'] !== 200) {
            return redirect()->back()->withErrors([
                'waybillNotValid_error' => 'Nomor resi tidak valid atau informasi pengiriman tidak ditemukan!'
            ]);
        }

        $waybills = $responseJson['rajaongkir']['result'];

        if (!empty($waybills['summary']['status'])) {
            $order->update([
                'waybill' => $validatedData['waybill'],
                'shipment_status' => $waybills['summary']['status']
            ]);
        }

        if (!empty($waybills['details']['waybill_date']) && !empty($waybills['details']['waybill_time'])) {
            $order->update([
                'shipment_date' => $waybills['details']['waybill_date'] . ' ' . $waybills['details']['waybill_time']
            ]);
        }

        return redirect()->route('owner.order_history')->with('updateOrderStatus_success', 'Status order berhasil diperbarui!');
    }

    public function activateDiscount()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $cart_details = $cart->cart_detail;

        if (Session::has('discountStatus')) {
            Session::forget('discountStatus');
            Session::forget('final_price');
            return back()->with([
                'unactivateDiscount_success' => "Diskon tidak jadi dipakai!"
            ]);
        } else {
            $final_price = $cart_details->sum('price') - ($cart_details->sum('price') * (5 / 100));
            Session::put('discountStatus', true);
            Session::put('final_price', $final_price);
            return back()->with([
                'activateDiscount_success' => "Diskon sebesar 5% berhasil dipakai!"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
