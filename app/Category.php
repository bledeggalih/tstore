<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'image'];

    protected $table = 'categories';
    
    public function clothes(){
    	$this->hasMany(Clothes::class);
    }
}
