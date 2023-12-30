<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // tambah ini buat yg folder per role
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;

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
