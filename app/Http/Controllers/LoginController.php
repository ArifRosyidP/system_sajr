<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login', ['title' => 'Login']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function authenticate(Request $request)
    {
        
        $check = User::where('email', '=', $request['email'] )->first();
        $credentials = $request->validate(['email'=>['required'],'password'=>['required'],]);
        if(Auth::attemptWhen($credentials)){
            $request->session()->regenerate();
            if(Auth::user()->role == "admin"){
                $request->session()->regenerate();
                return redirect()->intended('/')->with([
                    'alert' => [
                        'title' => 'Login Berhasil',
                        'text' => 'Selamat Datang Admin',
                        'icon' => 'success'
                    ]
                ]);
            }else{
                $request->session()->regenerate();
                return redirect()->intended('setup/klien')->
                with([
                    'alert' => [
                        'title' => 'Login Berhasil',
                        'text' => 'Selamat Datang',
                        'icon' => 'success'
                    ]
                ]);
            }
        }
        if ($check === null) {
            return back()->with([
                    'alert' => [
                        'title' => 'Login Gagal',
                        'text' => 'Email atau password salah',
                        'icon' => 'warning'
                    ]
                ]);
        } 
        // elseif ($check->id_status == 6) {
        //     return back()->with('Login Warning', 'Akun dengan kode dosen '.$request['kode_dosen'].
        //     ' telah didaftarkan, mohon tunggu verifikasi admin');
        // } 
        else{
            return back()->with([
                    'alert' => [
                        'title' => 'Login Gagal',
                        'text' => 'Email atau password salah',
                        'icon' => 'warning'
                    ]
                ]);
        }
    
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
