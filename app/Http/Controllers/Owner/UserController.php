<?php

namespace App\Http\Controllers\Owner;

use Carbon\Carbon;

use App\Models\User;
use App\Models\Point;
use App\Models\Coupon;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // tambah ini buat yg folder per role

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Filter pengguna berdasarkan pencarian
        if ($request->has('search')) {
            $users = User::where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('phone_number', 'like', '%' . $request->search . '%')
                ->orWhere('profile_picture', 'like', '%' . $request->search . '%')
                ->paginate(10)->withQueryString();
        } else {
            $users = User::paginate(10);
        }

        $point = Point::first();

        // Waktu sekarang
        $now = Carbon::now();

        // // Hapus kupon yang sudah kedaluwarsa
        // Coupon::where('ending_time', '<', $now)->delete();

        // Ambil kupon yang masih valid
        $coupons = Coupon::where('ending_time', '>=', $now)->get();

        return view('admin.user_list', [
            "TabTitle" => "Daftar Seluruh Pengguna",
            "active_4" => "text-yellow-500",
            "users" => $users,
            "point" => $point,
            "coupons" => $coupons
        ]);
    }
}
