<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function details(){
        return $this->hasMany(transaction_details::class,"transaction_id");
    }
    
    public function outlet(){
        return $this->belongsTo(outlet::class,"outlet_id");
    }

}
