<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Stores;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->route = 'home';
        $this->Category = new Category();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }

    public function view()
    {
        //view si home page
        $data['data'] = Category::all();
        if(Auth::user()!==null){
            if(auth()->user()->role == 'admin'){ $data['admin'] = true; }else{ $data['admin'] = false; } 
        
        }
        return view('home', $data);
    }
}
