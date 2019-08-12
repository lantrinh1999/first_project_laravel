<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return view('login');
    }

    public function logout()
    {
        $this->middleware('auth');
        Auth::logout();

        return redirect()->route('admin.login');
    }

    // /đăng nhập
    public function postLogin(LoginRequest $request)
    {
        if (empty($request)) {
            return redirect()->route('admin.login');
        }
        if (!empty($request)) {
            $data = $request->only(['email', 'password']);
            $check = Auth::attempt($data);
        }
        if ($check == true) {
            return redirect()->route('admin.home')->with('success', 'Đăng nhập thành công');
        }
    }
}
