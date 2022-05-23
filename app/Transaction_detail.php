<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction_detail extends Model
{
    protected $fillable = [
        'transaction_id', 'user_id', 'clothes_id', 'quantity','subTotal','grandTotal'
    ];

    protected $table = 'transaction_detail';

    public function clothes(){
        return $this->belongsTo(Clothes::class);
    }    

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function Transaction(){
        return $this->belongsTo(Transaction::class);
    }
}
