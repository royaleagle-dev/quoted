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

    //super admin access only
    public function add(Request $req){        
        $validate = $req->validate([
            'category' => ['max:255', 'required'],
            'description' => 'required',
        ]);
        if(CategoryModel::insert([
            'name' => $req->input('category'),
            'description' => $req->input('description'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ])){
            return response()->json(['status' => 'success', 'message' => 'Category Added Successfully']);
        }else{
            return response()->json(['status' => 'error', 'message'=>'An Error Occured, Please Try Again']);
        };
    }

    public function delete(Request $req){
        $validate = $req->validate([
            'id' => ['required'],
        ]);
        $category = CategoryModel::find($req->input('id'));
        print_r($category);
        if($category->delete()){
            return response()->json(['status'=>'success', 'message'=>'Successfully Deleted']);
        }else{
            return response()->json(['status'=>'error', 'message'=>'An Error occured, Category cannot be deleted']);
        }
    }
    

}
