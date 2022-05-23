<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Auth;
use Storage;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->route = 'category';
        
        $this->Category = new Category();
    }

    public function view()
    {
        $data['data'] = $this->Category->get(); // ambil semua 
        if(auth()->user()->role == 'admin'){ $data['admin'] = true; }else{ $data['admin'] = false; } //cek kalo admin
        return view($this->route.'.viewCategory', $data);
    }

    public function add()
    {
        if(auth()->user()->role != 'admin'){
            return abort(404);
        }
        return view($this->route.'.addCategory');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:5',
            'image' => 'required|mimes:png,jpg,jpeg',
        ]);

        $request->file('image')->storeAs('public/', $request->image->getClientOriginalName()); 
        $validatedData['image'] = $request->image->getClientOriginalName();
        
        $this->Category->create($validatedData);

        return redirect()->route('viewCategory');    
    }

    public function edit($id)
    {
        $data['data'] = $this->Category->findOrFail($id); //cari berdasarkan id
        return view($this->route.'.editCategory', $data);
    }

    public function update($id, Request $request)
    {
        $Category = $this->Category->findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|min:5',
            'image' => 'mimes:png,jpg,jpeg',
        ]);

        $request->file('image')->storeAs('public/', $request->image->getClientOriginalName());
        $validatedData['image'] = $request->image->getClientOriginalName();
        $Category->update($validatedData);

        return redirect()->route('viewCategory');

    }

    public function delete($id)
    {
        return $id;
        $this->Category->destroy($id);
        return redirect()->route($this->route.'.viewCategory');
    }

}
