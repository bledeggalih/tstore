<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clothes extends Model
{
    protected $fillable = ['store_id', 'category_id', 'name', 'price', 'stock', 'description', 'image'];

    protected $table = 'clothes';

    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function store(){
    	return $this->belongsTo(Stores::class);
    }

    public function category(){
    	return $this->belongsTo(Category::class);
    }
}


