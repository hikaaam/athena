<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function category(){
        return $this->belongsTo(category::class,"category_id");
    }

    public function outlet(){
        return $this->belongsTo(outlet::class,"outlet_id");
    }
}
