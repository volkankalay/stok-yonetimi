<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * AuthController
 */
class AuthController extends Controller
{
    /**
     * @return View
     */
    public function login(): View
    {
        return view('auth.login');
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function logMeIn(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only([
            'email',
            'password',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Geçersiz giriş bilgileri',
        ])->onlyInput('email');
    }

    /**
     * @return View
     */
    public function register(): View
    {
        return view('auth.register');
    }

    /**
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function registerMe(RegisterRequest $request): RedirectResponse
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        if (!empty($user)) {
            Auth::attempt($request->only(['email', 'password']), true);
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['email' => 'Geçersiz giriş bilgileri']); // Hata ile birlikte geri dön
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('home');
    }

    /**
     * @return View
     */
    public function dashboard(): View
    {
        $stores = DB::table('stores')->selectRaw('*')
            ->whereNull('deleted_at')
            ->where('owner_id', Auth::id())
            ->get();

        return view('auth.dashboard', compact('stores'));
    }

    /**
     * @param Request $request
     * @return View
     */
    public function self(Request $request): View
    {
        return view('auth.self');
    }
}
