<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Coupon;
use App\Models\UserCoupon;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;

class CouponController extends Controller
{
    public function setCoupon(Request $request)
    {
        $validatedData = $request->validate([
            "title" => "required|string|max:20",
            "starting_time" => "required|date|after:today",
            "ending_time" => "required|date|after:starting_time",
            "discount" => "required|numeric|between:1,100",
            "quantity" => "required|numeric|min:1",
        ], [
            'title.required' => 'Nama kupon wajib diisi!',
            'title.string' => 'Nama kupon wajib berupa karakter!',
            'title.max' => 'Nama kupon maksimal 20 karakter!',
            'starting_time.required' => 'Tanggal mulai wajib diisi!',
            'starting_time.date' => 'Tanggal mulai wajib sesuai dengan format tanggal!',
            'starting_time.after' => 'Tanggal mulai tidak boleh sebelum hari ini!',
            'ending_time.required' => 'Tanggal berakhir wajib diisi!',
            'ending_time.date' => 'Tanggal berakhir wajib sesuai dengan format tanggal!',
            'ending_time.after' => 'Tanggal berakhir tidak boleh sebelum tanggal mulai!',
            'discount.required' => 'Diskon wajib diisi!',
            'discount.numeric' => 'Diskon wajib berupa angka!',
            'discount.between' => 'Diskon wajib berada dalam rentang 1 sampai 100!',
            'quantity.required' => 'Jumlah kupon wajib diisi!',
            'quantity.numeric' => 'Jumlah kupon wajib berupa angka!',
            'quantity.min' => 'Jumlah kupon minimal 1!',
        ]);

        $coupon = Coupon::create([
            'title' => $validatedData['title'],
            'starting_time' => $validatedData['starting_time'],
            'ending_time' => $validatedData['ending_time'],
            'discount' => $validatedData['discount'],
            'initial_quantity' => $validatedData['quantity']
        ]);

        return back()->with('setCoupon_success', 'Sistem Kupon berhasil diterapkan!');
    }

    public function editCoupon(Request $request, $id)
    {
        $validatedData = $request->validate([
            "title" => "required|string|max:20",
            "starting_time" => "required|date|after:today",
            "ending_time" => "required|date|after:starting_time",
            "discount" => "required|numeric|min:1,100",
            "quantity" => "required|numeric|min:1",
        ], [
            'title.required' => 'Nama kupon wajib diisi!',
            'title.string' => 'Nama kupon wajib berupa karakter!',
            'title.max' => 'Nama kupon maksimal 20 karakter!',
            'starting_time.required' => 'Tanggal mulai wajib diisi!',
            'starting_time.date' => 'Tanggal mulai wajib sesuai dengan format tanggal!',
            'starting_time.after' => 'Tanggal mulai tidak boleh sebelum hari ini!',
            'ending_time.required' => 'Tanggal berakhir wajib diisi!',
            'ending_time.date' => 'Tanggal berakhir wajib sesuai dengan format tanggal!',
            'ending_time.after' => 'Tanggal berakhir tidak boleh sebelum tanggal mulai!',
            'discount.required' => 'Diskon wajib diisi!',
            'discount.numeric' => 'Diskon wajib berupa angka!',
            'discount.between' => 'Diskon wajib berada dalam rentang 1 sampai 100!',
            'quantity.required' => 'Jumlah kupon wajib diisi!',
            'quantity.numeric' => 'Jumlah kupon wajib berupa angka!',
            'quantity.min' => 'Jumlah kupon minimal 1!',
        ]);

        $coupon = Coupon::find($id);

        $coupon->update([
            'title' => $validatedData['title'],
            'starting_time' => $validatedData['starting_time'],
            'ending_time' => $validatedData['ending_time'],
            'discount' => $validatedData['discount'],
            'initial_quantity' => $validatedData['quantity']
        ]);

        $user_coupons = UserCoupon::where('coupon_id', $id)->get();

        foreach ($user_coupons as $user_coupon) {
            $user_coupon->update([
                "quantity" => $validatedData['quantity']
            ]);
        }

        return back()->with('setCoupon_success', "Kupon {$coupon->title} berhasil diperbarui!");
    }

    public function deleteCoupon($id)
    {
        $coupon = Coupon::find($id);
        $coupon_name = $coupon->title;
        $coupon->delete();
        return back()->with('deleteCoupon_success', "Kupon {$coupon_name} berhasil dihapus!");
    }

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
    public function store(StoreCouponRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        //
    }
}
