<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('register', ['title' => 'Register']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // dd($data);
    // dd($request->input('email'));
    // dump($data);
    
    // return redirect('/login');
    public function store(RegisterRequest $request) : JsonResponse
    {
        $data = $request->validated();
        
        $data['id'] = Str::uuid();
        $data['password'] = Hash::make($data['password']);
        try {
            User::create($data);
            return response()->json([
                    'title' => "Berhasil!", 'text' => 'Akun kamu telah ditambahkan', 'icon' => "success", 'redirect' => route('login'),
                ]);
        } catch (Exception $error) {
            return response()->json([
            'title' => "Error",
            'text' => 'Terjadi kesalahan pada server',
            'icon' => "error",
        ], 500);
        }
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
