<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $owner = [ // set syarat buat dapetin rolenya
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => 1,
            'is_active' => '1'
        ];
        $admin = [
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => 2,
            'is_active' => '1'
        ];
        $member = [
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => 3,
            'is_active' => '1'
        ];

        if (Auth::attempt($owner)) {
            $this->isLogin(Auth::id());
            return redirect()->route('owner.admin'); // bisa buat ke halaman khusus admin aja
        } else if (Auth::attempt($admin)) {
            $this->isLogin(Auth::id());
            return redirect()->route('admin.admin'); // TIDAK PERLU SLASH / soalnya udah ->name('home') di routes/web.php, mau ke student_list udh kuset sih
        } else if (Auth::attempt($member)) {
            $this->isLogin(Auth::id());
            return redirect()->route('products');
        }

        return redirect()->route('login')->with('error', 'Email atau password salah!');
    }

    private function isLogin(int $id) { // private
        $user = User::findOrFail($id);
        return $user->update([
            'is_login' => '1'
        ]);
    }

    public function logout(Request $request) { // yg ini public yaaa jan lupa
        // nama logout itu jangan diubah soalnya ngikutin templatenya aja
        $user = User::findOrFail(Auth::id());
        $user->update([
            'is_login' => '0'
        ]);

        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('login');
    }

    // https://www.youtube.com/watch?v=jqshjXab_1A
}
