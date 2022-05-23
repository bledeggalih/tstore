<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'clothes_id', 'quantity', 'checked_out','subTotal'];

    protected $table = 'cart';

    public function clothes(){
    	return $this->belongsTo(Clothes::class);
    }    

    public function user(){
    	return $this->belongsTo(User::class);
    }

}
