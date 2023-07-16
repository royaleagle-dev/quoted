<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuoteModel;

class ManagementController extends Controller
{
    //accessed by web-admins, and registered users
    public function insert(Request $req){
        if($req->method() == 'POST'){
            $validated = $req->validate([
                'quote_author' => 'required|max:255',
                'quote_text' => 'required',
                'quote_category' => 'required',
            ]);

            $quote = new QuoteModel;
            $quote->fill([
                'quote_text' => $req->input('quote_text'),
                'quote_author' => $req->input('quote_author'),
                'category_id' => $req->input('quote_category'),
            ]);
            $quote->save();
            return redirect('/quotes');

        }else if($req->method() == 'GET'){
            //pass
            return view('administrator.insert');
        }

    }

    //accessed by web-admins, and registered users
    public function update(Request $req, $id=false){
        if($req->method() == 'POST' && $id == false){
            $validadte = $req->validate([
                'quote_author' => 'required|max:255',
                'quote_text' => 'required',
                'quote_id' => 'numeric|required',
            ]);
            $quote = QuoteModel::find($req->input('quote_id'));
            if(is_object($quote)){
                $quote->quote_text = $req->input('quote_text');
                $quote->quote_author = $req->input('quote_author');
                $quote->save();
                return redirect('/');
            }else{
                return view("administrator.no_record", ["id" => $req->input('quote_id')]);
            }

        }else if($req->method() == 'GET'){
            $quote = QuoteModel::find($id);
            if(is_object($quote)){
                return view ("administrator.update", ['quote'=>$quote]);
            }else{
                return view ("administrator.no_record", ["id" => $id]);
            }
        }
    }

    //accessed by web-admins, and registered users
    public function remove(Request $req){
        $id = $req->input("id");
        $quote = QuoteModel::find($id)->delete();
        return response()->json(['status'=>'success', 'record_id' => $id]);
    }

    //accessed only by web-admins
    public function add_category(Request $req){
        if($req->method == 'POST'){
            //input data
        }else{
            //display forms
        }
    }
}
