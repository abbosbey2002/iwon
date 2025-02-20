<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function loginPage()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        try {
            $credentials = $request->validated();

            if ($this->authService->attemptLogin($credentials)) {
                $request->session()->regenerate();

                return redirect()->route('dashboard');
            }

            return back()
                ->withInput()
                ->withErrors(['email' => 'Invalid credentials']);
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'An error occurred during login']);
        }
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }
}
