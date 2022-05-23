<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    protected $fillable = [
        'name', 'address', 'description','image','user_id'
    ];

    protected $table = "stores";
}
