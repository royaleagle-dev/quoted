<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuoteModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
    public function index(){        
        return view('index');
    }

    public function categories(){
        //pass here.
    }

    public function test(){
        print_r (Auth::user());
    }

    public function random(){
        //pass
    }

    public function list(Request $req){
        if($req->input('search') == true){
            $search = $req->input('search');
            $quotes = QuoteModel::where('quote_text', 'like', '%' . $search . '%')->get();
            return view('quotes', ['quotes' => $quotes]);

        }else{
            $data = [
                'quotes' => QuoteModel::all(),
            ];
            return view('quotes', $data);
        }
    }

    public function quotesFilter(Request $req){
        
        $filter_date = $req->input('date_sort');
        $filter_author = $req->input('author_sort');
        $filter_text = $req->input('text_sort');

        $quotes = QuoteModel::all();

        switch($filter_date){
            case 'DATE_ASC':
                $quotes = $quotes->sortBy('created_at');
                break;
            case 'DATE_DSC':
                $quotes = $quotes->sortByDesc('created_at');
                break;
            case 'DATE_N':
                $quotes = $quotes;
                break;
        }

        switch($filter_author){
            case 'AUTHOR_ASC':
                $quotes = $quotes->sortBy('quote_author');
                break;
            case 'AUTHOR_DSC':
                $quotes = $quotes->sortByDesc('quote_author');
                break;
            case 'AUTHOR_N':
                $quotes = $quotes;
                break;
        }

        switch($filter_text){
            case 'TEXT_ASC':
                $quotes = $quotes->sortBy('quote_text');
                break;
            case 'TEXT_DSC':
                $quotes = $quotes->sortByDesc('quote_text');
                break;
            case 'TEXT_N':
                $quotes = $quotes;
                break;
        }

        $data=[
            'quotes' => $quotes,
        ];
        return view('quotes', $data);
    }

}
