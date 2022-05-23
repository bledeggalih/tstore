<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clothes;
use App\Category;
use App\Store;
use App\Cart;
use App\Transaction;
use App\Transaction_detail;
use Auth;
use Storage;

class Transaction_detailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->route = 'transaction_detail';
        $this->Transaction = new Transaction();        
        $this->Cart = new Cart();
        $this->Clothes = new Clothes();
        $this->Transaction_detail = new Transaction_detail();
    }
    public function view(){
    	if(auth()->user()->role != 'admin'){
            return abort(404);
        }


 		$user = auth()->user()->get();
        $dataTrans['dataTrans'] = $this->Transaction->get();
        $data['data'] = $this->Transaction_detail->where('user_id', auth()->user()->id)->get();


        //validasiin si user
        //ambil data si
        //$data['data'] = $this->Transaction_detail->get(); //ambil row dari transaction_detail
        return view('transaction'.'.viewTransaction', $data);
    }


}
