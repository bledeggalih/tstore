<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clothes;
use App\Category;
use App\Stores;
use App\Cart;
use App\Transaction;
use Auth;
use Storage;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->route = 'transaction';
        $this->Cart = new Cart();
        $this->Clothes = new Clothes();
        // $this->Stores = new Stores();
        $this->Transaction = new Transaction();
    }
    //view si trasaction
    public function view(){
    	if(auth()->user()->role != 'admin'){
            return abort(404);
        }
        // $data['data'] = $this->Auth()->user()->get();
        $user = auth()->user()->get();
        // $data['store'] = $this->Stores->get();
        // $data = Transaction::get();
        // foreach($data as $datas){

        // }
        $data['data'] = $this->Transaction->get();
        //$detail['detail'] = $this->Transaction->where('user_id'== $data->user->id)->get();
        return view($this->route.'.viewTransaction', $data);
    }
}