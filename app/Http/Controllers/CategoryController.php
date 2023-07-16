<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\QuoteModel;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(Request $req){
        if($req->input('search') == true){
            $search = $req->input('search');
            $categories = CategoryModel::where('name', 'like', '%' . $search . '%')->get();
            return view('categories', ['categories' => $categories]);
        }else{
            $categories = CategoryModel::all();
            return view('categories', ['categories'=>$categories]);
        }
    }

    public function test_input(){
       if(Auth::check()){
        print "User is Logged In";
       }else{
        print "User is not Logged In";
       }
    }

}
