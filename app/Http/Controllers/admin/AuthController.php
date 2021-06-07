<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function login()
    {
        return view('admin.auth.login');
    }

    public function authenticate(AuthLoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.manga.index'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect(route('login'));
    }

    protected function loggedOut(Request $request)
    {
        //
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
