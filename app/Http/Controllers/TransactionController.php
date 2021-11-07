<?php

namespace App\Http\Controllers;

use App\Models\outlet;
use App\Models\product;
use App\Models\transaction;
use App\Models\transaction_details;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    // Schema::create('transactions', function (Blueprint $table) {
    //     $table->id();
    //     $table->string("buyer_name", 250);
    //     $table->enum("status", [0, 1])->default(0);
    //     $table->unsignedBigInteger("outlet_id");
    //     $table->foreign("outlet_id")->references("id")
    //         ->on("outlets")->onUpdate("cascade");
    //     $table->timestamps();
    // });
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $id = Auth::user()->id;
            $transaction = transaction::where('user_id', $id)->where('status', '0')->orderBy('id', 'desc')->get();
            $outlets = outlet::where('user_id', $id)->get();
            return view('FrontEnd.Transaction.index', compact('transaction', 'outlets'));
        } catch (\Throwable $th) {
            return back()->withErrors(['msg' => $th->getMessage()]);
        }
    }

    public function get()
    {
        try {
            $id = Auth::user()->id;
            $transaction = transaction::where('user_id', $id)->with('outlet:id,name')->orderBy('id', 'desc')
                ->paginate(20);
            return view('FrontEnd.Transaction.View.index',compact('transaction'));
        } catch (\Throwable $th) {
            return back()->withErrors(['msg' => $th->getMessage()]);
        }
    }


    public function getDetail($id)
    {
        try {
            $head = transaction::find($id)->with('outlet:id,name')->first();
            $transaction = transaction_details::where("transaction_id",$id)
                            ->with('product')->get();
            return view('FrontEnd.Transaction.View.detail',compact('transaction','head'));
        } catch (\Throwable $th) {
            return back()->withErrors(['msg' => $th->getMessage()]);
        }
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
                "outlet_id" => "required|integer",
                "buyer_name" => "required|max:250"
            ]);
            if ($validator->fails()) throw new Exception($validator->errors()->first());
            $id = Auth::user()->id;
            $data = transaction::create([
                "outlet_id" => $request->outlet_id,
                "buyer_name" => $request->buyer_name,
                "status" => "0",
                "user_id" => $id
            ]);
            return redirect()->route('prefix.newtransaction.show', [$data->id]);
        } catch (\Throwable $th) {
            return back()->withErrors(['msg' => $th->getMessage()]);
        }
    }

    public function save(Request $request)
    {
        try {
            $validator =  Validator::make($request->all(), [
                "product_id" => "required|integer",
                "transaction_id" => "required|integer",
                "price" => "required|integer",
                "qty" => "required|integer"
            ]);
            if ($validator->fails()) throw new Exception($validator->errors()->first());

            $transdetail = transaction_details::where("transaction_id", $request->transaction_id)
                ->where("product_id", $request->product_id)->first();
            if ($request->qty < 1) {
                throw new Error("qty tidak boleh kurang dari 1");
            }
            if ($transdetail) {
                $old = $transdetail->qty;
                $new = $request->qty + $old;
                transaction_details::find($transdetail->id)->update(["qty" => $new]);
            } else {
                $data = transaction_details::create([
                    "product_id" => $request->product_id,
                    "transaction_id" => $request->transaction_id,
                    "price" => $request->price,
                    "qty" => $request->qty
                ]);
            }
            return redirect()->route('prefix.newtransaction.show', [$request->transaction_id]);
        } catch (\Throwable $th) {
            return back()->withErrors(['msg' => $th->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            $data = transaction_details::find($id);
            $data->delete();
            return redirect()->route('prefix.newtransaction.show', [$data->transaction_id])->with("success", "Berhasil hapus transaksi");
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            // Alert::error('Error Title', 'Error Message');
            return back();
        }
    }

    public function accept($id)
    {
        try {
            $data = transaction_details::where("transaction_id", $id)->get();
            if (count($data) < 1) throw new Error("Tidak boleh membayar order kosong");
            transaction::find($id)->update(['status' => '1']);
            return redirect("/")->with("success", "Pembayaran Berhasil");
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return back()->withErrors(['msg' => $th->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public static function show($id)
    {
        $cart = transaction::where('id', $id)->with('details.product:id,name', 'outlet:id,name')->where('status', '0')->get();
        $products = product::where('user_id', Auth::user()->id)->where('outlet_id', $cart[0]->outlet_id)->get();
        return view('FrontEnd.Transaction.New.index', compact('cart', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = transaction::find($id)->delete();
            $id = Auth::user()->id;
            $transaction = transaction::where('user_id', $id)->where('status', '0')->orderBy('id', 'desc')->get();
            $outlets = outlet::where('user_id', $id)->get();
            return view('FrontEnd.Transaction.index', compact('transaction', 'outlets'))->with("success", "Berhasil Hapus Transaksi");
        } catch (\Throwable $th) {
            return back()->withErrors(['msg' => $th->getMessage()]);
        }
    }
}
