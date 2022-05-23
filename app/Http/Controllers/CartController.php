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

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->route = 'cart';
        $this->Transaction = new Transaction();        
        $this->Cart = new Cart();
        $this->Clothes = new Clothes();
        $this->Transaction_detail = new Transaction_detail();
    }

    public function view()
    {	
        $data['data'] = $this->Cart->with('clothes')->
        where([['user_id', auth()->user()->id], ['checked_out', '0']])->get();
        $data['grandTotal'] = 0;
        if($data['data']->first()){
	        foreach($data['data'] as $item){
	        	$data['grandTotal'] += $item->quantity * $item->clothes->price;
	        }
	    }
        // dd($data);
        return view($this->route.'.viewCart', $data);
    }

    public function checkout(Request $request)
    {
        //nandain di cart kalo si cart itu udah di checkout apa blom
        // $cloth = $this->Clothes->with();
        // $validatedData['subTotal'] = $request->subTotal;
        // dd($cloth);
        // $data = Clothes::get('price');
        // $datas = Cart::get('quantity');
        // dd($datas);
        // $data = $request->subTotal;
        // dd($data);

        // $data['data'] = $this->Cart->with('clothes')->
        // where([['user_id', auth()->user()->id], ['checked_out', '0']])->get();        
        
        // $data['grandTotal'] = 0;
        // if($data['data']->first()){
        //     foreach($data['data'] as $item){
        //         $data['grandTotal'] += $item->quantity * $item->clothes->price;
        //     }
        // }
        // $dataCart = $this->Cart->get();
        // $datas['datas'] = $this->Cart->with('clothes')->
        // where([['user_id', auth()->user()->id], ['checked_out', '0']])->get();    
        // $datas['subTotal'] = 0;
        //     if($datas['datas']->first()){
        //         $datas['subTotal'] += $dataCart->quantity * $datas->clothes->price;
        //     }
        
        // dd($data['subTotal']);

        // $data['grandTotal'] = $this->Cart->where->update(['subTotal' => $grandTotal]);
        

        // $calculateData = $request->clothes->stock - $request->quantity;

    	$this->Cart->where([
    	['user_id', auth()->user()->id],
    	['checked_out', '0']
    	])->update(['checked_out' => '1']);

        // $this->Clothes->where([
        //     ['user_id', auth()->user->id],
        // ])->update(['stock'=> $calculateData]);

        //buat DB transaction dari lemparan data si cart
        $datas1 = Cart::get();
        foreach($datas1 as $data1){
            Transaction::insert(['user_id' => $data1->user_id]);
        }
        //buat DB transaction_detail dari lemparan data si cart
        $datas2 = Cart::Get();
        foreach($datas2 as $data2){
            Transaction_detail::insert(['user_id' => $data2->user_id, 'clothes_id'=>$data2->clothes_id,'quantity'=>$data2->quantity,'created_at'=>$data2->created_at,'updated_at'=>$data2->updated_at]);
        }

        // $calculateData = Clothes::
        // $this->Clothes->where([
        //      ['clothes_id', $request->clothes->id],
        // ])->update(['stock'=> $calculateData]);


        //delete cart yang udah dioper datanya terus didelete yang udah di tandain tadi
        $this->Cart->where([
        ['user_id', auth()->user()->id],
        ['checked_out', '1']
        ])->delete();

        //puseeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeenggggggggggggggggggggggggg    	
    	return redirect()->route('viewCart');
    }

    public function store(Request $request)
    {
        // $stock = \App\Clothes::find($request)
        // $qty = $stock;
        // dd($qty);
        // dd($request->stock);
    	$validatedData = $request->validate([
            'clothes_id' => 'required',
            'quantity' => 'required|min:1|max:'.$request->stock,
        ]); 
        // dd($validatedData);
    	$validatedData['user_id'] = auth()->user()->id;
        //$validatedData['checked_out'] = 0;
    	$this->Cart->create($validatedData);

    	return redirect()->route('viewCart');
    }

    public function transaction()
    {
        // kalo bukan admin di gagalin
        if(auth()->user()->role != 'admin'){
            return abort(404);
        }
        $data['data'] = $this->Cart->where('checked_out', '1')->get();
        return view('transaction'.'.viewTransaction', $data);
    }

    public function update($id, Request $request)
    { 	
    	$Cart = $this->Cart->findOrFail($id);
    	$validatedData = $request->validate([
            'quantity' => 'required'
        ]);
    	$Cart->update($validatedData);   
        return redirect()->route('viewCart');
    }

    public function delete($id)
    {
     	$this->Cart->destroy($id);   
        return redirect()->route('viewCart');
    }
}
