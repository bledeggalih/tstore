<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clothes;
use App\Category;
use App\Cart;
use App\Stores;
use auth;
use Storage;

class ClothesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->route = 'clothes';
        $this->Clothes = new Clothes();
        $this->Category = new Category();
        $this->Cart = new Cart();
        $this->Stores = new Stores();
    }

    public function viewDetail($id){
        //view berdasar si clothes_id
        $data['data'] = $this->Clothes->where('id',$id )->with('store','category')->first();
        return view($this->route.".detailClothes", $data);
    }

    //core buat searchbar si category di viewClothes
    //jadi dia ngesearch berdasarkan si store name atau si cloth name
    public function search($name, Request $request){
        if(auth()->user()->role == 'admin'){
            $data['admin']=true;}else{$data['admin']=false;
        }
        $category_id = $this->Category->where('name',$name)->pluck('id')->first();
        if(isset($request->search)){
            $search = $request->search;
            $data['data'] = $this->Clothes->with('store','category')->where('category_id',$category_id)
            ->where('name','LIKE',"%{$search}%")->orWhereHas('store',function($fill) use($search){$fill->where('name','LIKE',"%{$search}%");})->paginate(10);
            $data['data']->appends(['search'=> $search]);
        }else{
            $data['data']=$this->Clothes->with('store','category')->where('category_id',$category_id)->paginate(10);
        }
        // dd($data);
        $data['category'] = $this->Category->get();
        $data['store'] = $this->Stores->where('user_id', auth()->user()->id)->first();
        return view($this->route.'.pageClothes',$data);
    }

    //view buat si /viewClothes
    public function view()
    {
       	$data['store'] = $this->Stores->where('user_id', auth()->user()->id)->first();
        return view($this->route.'.view', $data);
    }
    //method si addClothes
    public function add()
    {
    	$data['category'] = $this->Category->get();
    	$data['store'] = $this->Stores->where('user_id', auth()->user()->id)->first();
        return view($this->route.'.addClothes', $data);
    }

    //lemparan si method search
    public function page(Request $req){
        //nyari data clothes yang nama nya sama kyk di method search, batas data 10 page perhalaman
        $clothes = Clothes::where('name','LIKE',"%$req->searchData%")->paginate(10);
        $data = ['clothes' => $clothes];
        $data['category'] = $this->Category->get();
        return view($this->route.".pageClothes", $data);
    }
    //create data si clohes, method ini buat si tombol add item
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:5',
            'category_id' => 'required',
            'price' => 'required|numeric|min:20000',
            'stock' => 'required|numeric|min:1',
            'description' => 'required|string|min:20',
            'store_id' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg'
        ]);
        $request->file('image')->storeAs('public/', $request->image->getClientOriginalName()); 
        $validatedData['image'] = $request->image->getClientOriginalName();
        // dd($validatedData);
        $this->Clothes->create($validatedData);

        return redirect()->route('viewStore');    
    }

    //method buat edit si clothes
    public function edit(Request $req)
    {
        $data['category'] = $this->Category->get();
        $data['stores'] = $this->Stores->where('user_id', $req->store_id);
        $data['data'] = $this->Clothes->findOrFail($req->clothes_id); //cari berdasarkan id si clothes
        return view($this->route.'.editClothes', $data);
    }

    //method update si data clothes
    public function update(Request $request)
    {
        $Clothes = $this->Clothes->findOrFail($request->id);
        $validatedData = $request->validate([
            'name' => 'required|string|min:5',
            'category_id' => 'required',
            'price' => 'required|numeric|min:20000',
            'stock' => 'required|numeric|min:1',
            'description' => 'required|string|min:20',
            'store_id' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg'
        ]);
        $request->file('image')->storeAs('public/', $request->image->getClientOriginalName());
        $validatedData['image'] = $request->image->getClientOriginalName();
        $Clothes->update($validatedData);

        return redirect()->route('viewStore');
    }
    //method delete si clothes
    public function delete($id)
    {
        $this->Clothes->destroy($id);
        return redirect()->route('viewStore');
    }
}
