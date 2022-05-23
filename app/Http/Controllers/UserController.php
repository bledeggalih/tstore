<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Storage;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->route = 'auth';

        $this->User = new User();
    }

    public function profile()
    {
    	$data['data'] = $this->User->findOrFail(auth()->user()->id);
    	return view($this->route.'.profileUser', $data);
    }

    public function update(Request $request)
    {	
    	$user = $this->User->findOrFail(auth()->user()->id);
    	$validatedData = $request->validate([
            'name' => ['required', 'alpha', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'old_password' => ['required', function($attribute, $value, $fail){
            	if(!\Hash::check($value, auth()->user()->password)){
            		return $fail(__('The current password is incorrect.'));
            	}
            }],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'gender' => ['required'],
            'address' => ['required','min:10', 'string']
        ]);
    	$validatedData['password'] = Hash::make($validatedData['password']);
        $user->update($validatedData);
    	return redirect()->route('profileUser');
    }
}
