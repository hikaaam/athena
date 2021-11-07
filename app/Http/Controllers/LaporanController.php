<?php

namespace App\Http\Controllers;

use App\Exports\pembelian;
use App\Exports\penjualan;
use App\Exports\produk;
use App\Models\product;
use App\Models\transaction;
use App\Models\transaction_details;
use App\Models\transactions_in;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('FrontEnd.Laporan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $uuid = Auth::user()->id;
        switch ($id) {
            case 'penjualan':
                $data = transaction::where("user_id", $uuid)->get();
                return view('FrontEnd.Laporan.penjualan', compact('data'));
            case 'penjualancetak':
                $data = new penjualan($uuid);
                return Excel::download($data, "penjualan.xlsx");
            case 'penjualanproduk':
                $data = product::where("user_id", $uuid)->get();
                return view('FrontEnd.Laporan.penjualanproduk', compact('data'));
            case 'pembeliancetak':
                $data = new pembelian($uuid);
                return Excel::download($data, "pembelian.xlsx");
            default:
                $data = transactions_in::where("user_id", $uuid)->get();
                return view('FrontEnd.Laporan.pembelian', compact('data'));
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = transaction_details::with('transaction')->where('product_id', $id)->get();
        return view('FrontEnd.Laporan.cetakproduk', compact('data'));
    }

    public function cetak($id){
        $uuid = Auth::user()->id;
        $data = new produk($id,$uuid);
        return Excel::download($data, "laporanpenjualanproduk.xlsx");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
