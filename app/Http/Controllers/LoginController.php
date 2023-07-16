<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function logout(Request $req){
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect('quotes');
    }

    public function login(Request $req){

        $credentials = $req->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)){
            $req->session()->regenerate();
            return response()->json([
                'status' => 'success',
                'message' => 'Authentication successful, Redirecting in 3s',
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Invalid Credentials',
        ]);

    }
}
