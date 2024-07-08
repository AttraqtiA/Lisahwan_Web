<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePointRequest;
use App\Http\Requests\UpdatePointRequest;

class PointController extends Controller
{
    public function setPoint(Request $request)
    {
        $validatedData = $request->validate([
            "percentage_from_totalprice" => "required|numeric|between:0,100",
            "money_per_poin" => "required|numeric|min:0",
        ], [
            'percentage_from_totalprice.required' => 'Persentase wajib diisi!',
            'percentage_from_totalprice.numeric' => 'Persentase wajib berupa angka!',
            'percentage_from_totalprice.between' => 'Persentase wajib berada dalam rentang 0 sampai 100!',
            'money_per_poin.required' => 'Jumlah uang wajib diisi!',
            'money_per_poin.numeric' => 'Jumlah uang wajib berupa angka!',
            'money_per_poin.min' => 'Jumlah uang minimal 0!',
        ]);

        $check_point = Point::all();
        if ($check_point->isEmpty()) {
            if ($validatedData['percentage_from_totalprice'] == 0 && $validatedData['money_per_poin'] == 0) {
                // Jika keduanya adalah 0
                return redirect()->back()->withErrors(['forgotAll_error' => 'Persentase dan jumlah uang tidak boleh 0!']);
            } else if ($validatedData['percentage_from_totalprice'] == 0) {
                // Jika hanya persentase yang 0
                return redirect()->back()->withErrors(['forgotPercentage_error' => 'Persentase tidak boleh 0!']);
            } else if ($validatedData['money_per_poin'] == 0) {
                // Jika hanya jumlah uang yang 0
                return redirect()->back()->withErrors(['forgotMoney_error' => 'Jumlah uang tidak boleh 0!']);
            } else {
                // Jika tidak ada yang 0, buat poin
                Point::create([
                    'percentage_from_totalprice' => $validatedData['percentage_from_totalprice'],
                    'money_per_poin' => $validatedData['money_per_poin']
                ]);
                return back()->with('setPoint_success', 'Sistem Point berhasil diterapkan!');
            }
        } else {
            return redirect()->back()->withErrors(['alreadySetPoint_error' => 'Sistem Point sudah diterapkan!']);
        }
    }

    public function editPoint(Request $request)
    {
        $validatedData = $request->validate([
            "percentage_from_totalprice" => "required|numeric|between:0,100",
            "money_per_poin" => "required|numeric|min:0",
        ], [
            'percentage_from_totalprice.required' => 'Persentase wajib diisi!',
            'percentage_from_totalprice.numeric' => 'Persentase wajib berupa angka!',
            'percentage_from_totalprice.between' => 'Persentase wajib berada dalam rentang 0 sampai 100!',
            'money_per_poin.required' => 'Jumlah uang wajib diisi!',
            'money_per_poin.numeric' => 'Jumlah uang wajib berupa angka!',
            'money_per_poin.min' => 'Jumlah uang minimal 0!',
        ]);

        $point = Point::first();

        if ($validatedData['percentage_from_totalprice'] == 0 && $validatedData['money_per_poin'] == 0) {
            $point->delete();
            return back()->with('unsetPoint_success', 'Sistem Point tidak diterapkan!');
        } else {
            $point->update([
                'percentage_from_totalprice' => $validatedData['percentage_from_totalprice'],
                'money_per_poin' => $validatedData['money_per_poin']
            ]);
            return back()->with('setPoint_success', 'Sistem Point berhasil diterapkan!');
        }
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
    public function store(StorePointRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Point $point)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Point $point)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePointRequest $request, Point $point)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Point $point)
    {
        //
    }
}
