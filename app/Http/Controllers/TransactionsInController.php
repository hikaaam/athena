<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\supplier;
use App\Models\transactions_in;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransactionsInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $category = category::all();
        $supplier = supplier::where('user_id', $id)->get();
        $transaction = transactions_in::where('user_id', $id)->with('supplier')->paginate(16);
        return view('FrontEnd.Transaction_in.index', compact('category', 'supplier', 'transaction'));
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
        try {
            $validator =  Validator::make($request->all(), [
                "name" => "required|string|max:250",
                "unit" => "required",
                "price" => "required|integer|min:100",
                "qty" => "required|integer|min:1",
                "supplier_id" => "required"
            ]);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            $id = Auth::user()->id;
            transactions_in::create([
                "user_id" => $id,
                "name" => $request->name,
                "unit" => $request->unit,
                "price" => $request->price,
                "qty" => $request->qty,
                "supplier_id" => $request->supplier_id
            ]);
            return back()->with("success", "berhasil menambahkan barang");
        } catch (\Throwable $th) {
            return back()->withInput()->withErrors(['msg' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transactions_in  $transactions_in
     * @return \Illuminate\Http\Response
     */
    public function show(transactions_in $transactions_in)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\transactions_in  $transactions_in
     * @return \Illuminate\Http\Response
     */
    public function edit(transactions_in $transactions_in)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\transactions_in  $transactions_in
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transactions_in $transactions_in)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transactions_in  $transactions_in
     * @return \Illuminate\Http\Response
     */
    public function destroy(transactions_in $transactions_in)
    {
        //
    }
}
