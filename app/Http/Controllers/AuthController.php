<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;
use Carbon\Carbon;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login'); // sesuaikan nama file
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::where('username', $credentials['username'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            return redirect()->intended('/dashboard'); // ubah sesuai tujuan login
        }

        return back()->withErrors(['username' => 'Username atau password salah.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function sendVerificationCode(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->with('error', 'Email tidak terdaftar dalam sistem');
        }
        
        $verificationCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiresAt = Carbon::now()->addMinutes(15);
        
        $user->update([
            'verification_code' => $verificationCode,
            'verification_code_expires_at' => $expiresAt
        ]);
        
        try {
            Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));
            return redirect()->route('password.verify')->with([
                'email' => $user->email,
                'success' => 'Kode verifikasi telah dikirim ke email Anda'
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim kode verifikasi: '.$e->getMessage());
        }
    }

    public function showVerifyForm()
    {
        if (!session('email')) {
            return redirect()->route('login');
        }
        
        return view('verify-code', ['email' => session('email')]);
    }

    public function verifyCodeAndResetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'verification_code' => 'required|digits:6',
        'password' => 'required|min:6|confirmed',
    ], [
        'password.confirmed' => 'Password baru dan konfirmasi password tidak sesuai'
    ]);

    $user = User::where('email', $request->email)
        ->where('verification_code', $request->verification_code)
        ->where('verification_code_expires_at', '>', Carbon::now())
        ->first();

    if (!$user) {
        return response()->json([
            'status' => 'error',
            'message' => 'Kode verifikasi salah atau sudah kadaluarsa'
        ], 422);
    }

    $user->update([
        'password' => Hash::make($request->password),
        'verification_code' => null,
        'verification_code_expires_at' => null
    ]);

    $request->session()->forget('email');

    return response()->json([
        'status' => 'success', 
        'message' => 'Password berhasil direset! Silakan login dengan password baru Anda.',
        'redirect' => route('login')
    ]);
}
}
