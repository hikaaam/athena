<?php

namespace App\Exports;

use App\Models\transaction;
use Maatwebsite\Excel\Concerns\FromCollection;

class penjualan implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $id;

    function __construct($id)
    {
        $this->id = $id;
    }
    public function collection()
    {
        return transaction::where("user_id",$this->id)->get();
    }
}
