<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction_details extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product(){
        return $this->belongsTo(product::class,"product_id");
    }

    public function transaction(){
        return $this->hasMany(transaction::class,"id","transaction_id");
    }
    
}
