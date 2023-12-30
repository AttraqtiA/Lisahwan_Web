<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller; // tambah ini buat yg folder per role

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $users = User::where('name', 'like', '%' . $request->search . '%')->orWhere('email', 'like', '%' . $request->search . '%')->orWhere('phone_number', 'like', '%' . $request->search . '%')->orWhere('profile_picture', 'like', '%' . $request->search . '%')->paginate(10)->withQueryString();
        } else {
            $users = User::paginate(10);
        }

        return view('admin.user_list', [
            "active_4" => "text-yellow-500",
            "users" => $users,
        ]);
    }
}
