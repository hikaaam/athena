<?php

namespace App\Exports;

use App\Models\transactions_in;
use Maatwebsite\Excel\Concerns\FromCollection;

class pembelian implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    function __construct($id)
    {
        $this->id = $id;
    }
    public function collection()
    {
        return transactions_in::where("user_id",$this->id)->get();
    }
}
