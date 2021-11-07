<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transactions_in extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'transactions_in';
    public function supplier(){
        return $this->belongsTo(Supplier::class,"supplier_id");
    }
}
