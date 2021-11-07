<?php

namespace App\Exports;

use App\Models\transaction;
use App\Models\transaction_details;
use Maatwebsite\Excel\Concerns\FromCollection;

class produk implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    function __construct($id,$uuid)
    {
        $this->id = $id;
        $this->uuid = $uuid;
    }
    public function collection()
    {
        $transactions = transaction_details::where("product_id",$this->id)
                ->join('transactions','transactions.id','=','transaction_details.transaction_id')
                ->where('transactions.user_id',$this->uuid)->get();
            // ->whereRaw('')
        return $transactions;
    }
}
