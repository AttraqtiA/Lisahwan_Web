<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;

use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    public function clearSession(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login');
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'string', 'email', 'max:150'],
            'password' => ['required', 'string', 'min:8'],
            'remember' => ['nullable', 'filled'], // Add validation for remember
        ], [
            'email.required' => 'Email wajib diisi!',
            'email.string' => 'Email wajib berupa karakter!',
            'email.email' => 'Format email anda masih salah!',
            'email.max' => 'Email maksimal terdiri dari 150 karakter!',
            'password.required' => 'Password wajib diisi!',
            'password.string' => 'Password wajib berupa karakter!',
            'password.min' => 'Password minimal terdiri dari 8 karakter!'
        ]);
        Session::put('last_email', $validatedData['email']);

        // Check if remember checkbox is checked
        $remember = $request->has('remember');
        // dd($remember);

        // Attempt to authenticate the user with email and password
        if (Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password'], 'is_active' => '1'], $remember)) {
            // Authentication successful
            $this->isLogin(Auth::id());

            Session::forget('last_email');

            // Redirect based on user's role
            $user = Auth::user();
            if ($user->role_id == 1) {
                return redirect()->route('owner.admin');
            } elseif ($user->role_id == 2) {
                return redirect()->route('admin.admin');
            } elseif ($user->role_id == 3) {
                return redirect()->route('products');
            } else {
                Auth::logout();
                return redirect()->route('login')->withErrors(['login_error' => 'Role tidak valid!']);
            }
        }

        // If authentication with email and password fails, check if email exists
        $user = User::where('email', $validatedData['email'])->first();

        if (!$user) {
            // Email not found in database
            return redirect()->route('login')->withErrors(['email_error' => 'Email tidak ditemukan!']);
        }

        // Email found, but password is incorrect
        return redirect()->route('login')->withErrors(['password_error' => 'Password salah!']);
    }

    private function isLogin(int $id)
    {
        $user = User::findOrFail($id);
        return $user->update([
            'is_login' => '1'
        ]);
    }

    public function logout(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $user->update(['is_login' => '0']);

        setcookie('id', '', time() - 3600);
        setcookie('key', '', time() - 3600);

        Auth::logout();

        // Invalidasi sesi
        $request->session()->invalidate();
        // Regenerasi token CSRF
        $request->session()->regenerateToken();

        return redirect('login');
    }
    // https://www.youtube.com/watch?v=jqshjXab_1A
}
