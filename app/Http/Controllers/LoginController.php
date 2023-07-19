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

    public function check_user_level(){
        $current_user = Auth::user();
        if(!$current_user){
            return response()->json([
                'status' => 'error',
                'message' => 'User does not exist',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'level' => $current_user->user_level,
        ]);

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
