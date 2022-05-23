<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stores;
use App\Clothes;
use App\User;
Use App\Category;
use Auth;
use Storage;

class StoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->route = 'store';
        $this->Stores = new Stores();
        $this->User = new User();
        $this->Category = new Category();
        $this->Clothes = new Clothes();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function view()
    {
        $data['store'] = $this->Stores->where('user_id',auth()->user()->id)->first();
        if($data['store']){
            $data['clothes']= Clothes::where('store_id','=',$data['store']->id)->get();
        }
        // dd ($data);
        $user = auth()->user();
        // $datas = Clothes::where('store_id','=',$data['store']->id)->paginate(10);
        return view("store.viewStore", $data, compact('user'));
    }
    public function add(){
        $data['store'] = $this->Stores->where('user_id',auth()->user()->id)->first();
        if($data['store']){
            return redirect()->route($this->route.'.viewStore');
        }
        return view($this->route.'.addStore');
    }
    public function store(Request $request){
        // return $request;
        $validatedData = $request->validate([
            'name'=>'required|string|min:5',
            'image'=>'required|mimes:png,jpg,jpeg',
            'address'=>'required|string|min:10',
            'description' => 'required|string|min:20'
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        
        $request->file('image')->storeAs('public/',$request->image->getClientOriginalName());

        $validatedData['image'] = $request->image->getClientOriginalName();
        
        $this->Stores->create($validatedData);

        return redirect()->route('viewStore');
    }

    public function edit(Request $req){
        $data['category'] = $this->Category->get();
        //$user = auth()->user();
        $data['user'] = $this->User->where('user_id', $req->user_id);
        $data['data'] = $this->Stores->findOrFail($req->store_id);
        return view($this->route.'.editStore', $data);
    }

    public function update(Request $request){
        $data['store'] = $this->Stores->where('user_id',auth()->user()->id)->first();
        $user = auth()->user();
        // // dd ($data);
        // $user = auth()->user();

        $data['store'] = $this->Stores->get();
        // dd($data);
        $Stores = $this->Stores->findOrFail($request->id);

        $validatedData = $request->validate([
            'name'=>'required|string|min:5',
            'image'=>'required|mimes:png,jpg,jpeg',
            'address'=>'required|string|min:10',
            'description' => 'required|string|min:20'
        ]);
        //bikin img
        $request->file('image')->storeAs('public/', $request->image->getClientOriginalName());
        $validatedData['image'] = $request->image->getClientOriginalName();

        $Stores->update($validatedData);

        return redirect()->route('viewStore');
    }

    public function delete($id, Request $request)
    {
        $this->Stores->destroy($id);
        return redirect()->route('viewStore');
    }
}
