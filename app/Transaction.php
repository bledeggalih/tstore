<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['user_id', 'clothes_id','quantity','check_out'];

    protected $table = 'transaction';

    public function clothes(){
    	return $this->belongsTo(Clothes::class);
    }    

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
