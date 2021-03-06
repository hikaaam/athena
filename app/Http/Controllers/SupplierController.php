<?php

namespace App\Http\Controllers;

use App\Models\supplier;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{

    // Schema::create('suppliers', function (Blueprint $table) {
    //     $table->id();
    //     $table->string("name", 250)->unique();
    //     $table->string("phone", 14);
    //     $table->text("address")->nullable();
    //     $table->softDeletes($column = 'deleted_at', $precision = 0);
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
            $data = supplier::where("user_id", $id)->paginate(16);
            return view('FrontEnd.Supplier.index', compact('data'));
        } catch (\Throwable $th) {
            return back()->withErrors(["msg" => $th->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('FrontEnd.Supplier.create');
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
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:250',
                'phone' => 'required|numeric|digits_between:12,13',
            ]);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            $data = supplier::create([
                "name" => $request->name,
                "phone" => $request->phone,
                "user_id" => Auth::user()->id
            ]);
            return back()->with("success", "berhasil menambah supplier");
        } catch (\Throwable $th) {
            return back()->withInput()->withErrors(["msg" => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $data = supplier::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data = supplier::find($id);
            $data == null && throw new Exception('404');
            Auth::user()->id !== $data->user_id && throw new Exception('401');
            return view("FrontEnd.Supplier.edit", compact('data'));
        } catch (\Throwable $th) {
            if ($th->getMessage() == '401') {
                abort(401);
            } else if ($th->getMessage() == '404') {
                abort(404);
            } else {
                return back()->withErrors(["msg" => $th->getMessage()]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:250',
                'phone' => 'required|numeric|digits_between:12,13',
            ]);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            $data = supplier::find($id)->update([
                "name" => $request->name,
                "phone" => $request->phone,
                "user_id" => Auth::user()->id
            ]);
            return back()->with("success", "berhasil menambah supplier");
        } catch (\Throwable $th) {
            return back()->withInput()->withErrors(["msg" => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = supplier::find($id);
            if ($data == null) {
                throw new Exception("supplier ini tidak ada");
            }
            $data->delete();
            return back()->with("success", "berhasil menghapus supplier");
        } catch (\Throwable $th) {
            return back()->withInput()->withErrors(["msg" => $th->getMessage()]);
        }
    }
}
