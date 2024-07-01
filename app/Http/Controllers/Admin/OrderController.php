<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\CartDetail;
use App\Models\Production;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller; // tambah ini buat yg folder per role

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ordersQuery = Order::query();

        if ($request->has('search')) {
            $searchTerm = $request->search;

            $ordersQuery->where(function ($query) use ($searchTerm) {
                $query->where('order_date', 'like', '%' . $searchTerm . '%')
                    ->orWhere('shipment_date', 'like', '%' . $searchTerm . '%')
                    ->orWhere('arrived_date', 'like', '%' . $searchTerm . '%')
                    ->orWhere('is_print', 'like', '%' . $searchTerm . '%')
                    ->orWhere('shipment_status', 'like', '%' . $searchTerm . '%')
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

        $orders = $ordersQuery->where(function ($query) {
            $query->whereDate('order_date', Carbon::today())
                ->orWhereDate('order_date', Carbon::yesterday());
        })->paginate(10);

        // Menginisialisasi variabel nomor urut
        $orderNumber = $orders->firstItem();

        return view('admin.admin_dashboard', [
            "active_1" => "text-yellow-500",
            "orders" => $orders,
            "orderNumber" => $orderNumber,
        ]);
    }

    // ====================================== CASHIER MANAGEMENT SYSTEM ======================================
    public function showAllProducts()
    {
        $cart_user = Cart::where('user_id', Auth::user()->id)->first();
        if (empty($cart_user)) {
            $carts = null;
        } else {
            $carts = $cart_user->cart_detail;
        }
        return view('admin.products_order', [
            "TabTitle" => "Daftar Produk Lisahwan",
            "active_3" => "text-yellow-500",
            "pageTitle" => '<mark class="px-2 text-yellow-500 bg-gray-900 rounded">Produk</mark> Lisahwan',
            'pageDescription' => 'Jelajahi camilan terbaik di <span class="underline underline-offset-2 decoration-4 decoration-yellow-500">Lisahwan</span> dan pilih favorit Anda sekarang!',
            "products" => Product::all(),
            "carts" => $carts
        ]);
    }

    public function addProduct(Request $request, $id)
    {
        var_dump($request->all());
        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $product = Product::find($id);

        $validatedData = $request->validate([
            "quantity" => "required|not_in:0",
        ], [
            'quantity.required' => 'Oops! Anda lupa mengisikan jumlah pemesanan!',
            'quantity.not_in' => 'Oops! Anda lupa mengisikan jumlah pemesanan!'
        ]);

        $total_price = $validatedData['quantity'] * $product->price;

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
                    'price' => $total_price,
                    'weight' => $total_weight
                ]);
            } else {
                $cart_detail = $cart->cart_detail;
                $check_product = $cart_detail->where('product_id', $id)->first();

                if ($check_product) {
                    $check_product->update([
                        'quantity' => $check_product->quantity + $validatedData['quantity'],
                        'price' => $check_product->price + $total_price,
                        'weight' => $check_product->weight + $total_weight
                    ]);
                } else {
                    CartDetail::create([
                        'cart_id' => $cart->id,
                        'product_id' => $id,
                        'quantity' => $validatedData['quantity'],
                        'price' => $total_price,
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
            return redirect()->route('admin.products')->with('addCart_success', 'Pesanan ditambahkan ke keranjang!');
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
                "active_4" => "text-yellow-500",
                "pageTitle" => '<mark class="px-2 text-yellow-500 bg-gray-900 rounded">Keranjang</mark> Belanjaan',
                'pageDescription' => 'Setiap produk Lisahwan <span class="underline underline-offset-2 decoration-4 decoration-yellow-500">Lisahwan</span> telah dibuat  spesial untuk anda!',
                "carts" => $carts,
            ]
        );
    }
    // ========================================================================================================

    public function history(Request $request)
    {
        $ordersQuery = Order::query();

        if ($request->has('search')) {
            $searchTerm = $request->search;

            $ordersQuery->where(function ($query) use ($searchTerm) {
                $query->where('order_date', 'like', '%' . $searchTerm . '%')
                    ->orWhere('shipment_date', 'like', '%' . $searchTerm . '%')
                    ->orWhere('arrived_date', 'like', '%' . $searchTerm . '%')
                    ->orWhere('is_print', 'like', '%' . $searchTerm . '%')
                    ->orWhere('shipment_status', 'like', '%' . $searchTerm . '%')
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

        $orders = $ordersQuery->paginate(10);

        // Menginisialisasi variabel nomor urut
        $orderNumber = $orders->firstItem();

        return view('admin.order_history', [
            "active_2" => "text-yellow-500",
            "orders" => $orders,
            "orderNumber" => $orderNumber,
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

        $validatedData = $request->validate([ // TANPA ORDER DATE YAA
            'acceptbyAdmin_status' => 'required',
            'shipment_status' => 'required',
            'acceptbyCustomer_status' => 'required',
            'shipment_date' => 'nullable|date_format:Y-m-d\TH:i',
            'arrived_date' => 'nullable|date_format:Y-m-d\TH:i',
            'note' => 'nullable',
            'is_print' => 'required',
        ]);

        $order->update([
            'acceptbyAdmin_status' => $validatedData['acceptbyAdmin_status'],
            'shipment_status' => $validatedData['shipment_status'],
            'acceptbyCustomer_status' => $validatedData['acceptbyCustomer_status'],
            'shipment_date' => $validatedData['shipment_date'],
            'arrived_date' => $validatedData['arrived_date'],
            'note' => $validatedData['note'],
            'is_print' => $validatedData['is_print'],
        ]);


        return redirect()->route('admin.admin');
    }

    public function updateHistory(Request $request, Order $order)
    {
        $validatedData = $request->validate([ // TANPA ORDER DATE YAA
            'acceptbyAdmin_status' => 'required',
            'shipment_status' => 'required',
            'acceptbyCustomer_status' => 'required',
            'shipment_date' => 'nullable|date_format:Y-m-d\TH:i',
            'arrived_date' => 'nullable|date_format:Y-m-d\TH:i',
            'note' => 'nullable',
            'is_print' => 'required',
        ]);

        $order->update([
            'acceptbyAdmin_status' => $validatedData['acceptbyAdmin_status'],
            'shipment_status' => $validatedData['shipment_status'],
            'acceptbyCustomer_status' => $validatedData['acceptbyCustomer_status'],
            'shipment_date' => $validatedData['shipment_date'],
            'arrived_date' => $validatedData['arrived_date'],
            'note' => $validatedData['note'],
            'is_print' => $validatedData['is_print'],
        ]);


        return redirect()->route('admin.order_history');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
