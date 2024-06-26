<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        // dd(Auth::attempt($credentials));
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role == 'sdmk') {
                return redirect()->intended('/sdmk');
            }
            else if(Auth::user()->role == 'admin'){
                return redirect()->intended('/admin');
            }
            else{
                return redirect()->intended('/');
            }
        }

        return back()->with('masuk', 'Gagal masuk ke akun Anda, silakan coba lagi!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->intended('/');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required'],
            'email' => ['required', 'email:rfc,dns', 'unique:users'],
            'password' => ['required', 'max:45'],
            'password_confirmation' => ['required', 'same:password']

        ]);
        // dd($validated);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        if ($user) {
            event(new Registered($user));
            auth()->login($user);

            return redirect()->intended('/')->with('daftar', 'Pendaftaran akun berhasil');
        }

        return back()->with('daftar', 'Pendaftaran akun gagal! Silakan coba lagi');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
