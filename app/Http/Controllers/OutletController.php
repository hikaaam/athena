<?php

namespace App\Http\Controllers;

use App\Models\outlet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OutletController extends Controller
{
    // Schema::create('outlets', function (Blueprint $table) {
    //     $table->id();
    //     $table->unsignedBigInteger("user_id");
    //     $table->foreign("user_id")->references("id")
    //     ->on("users")->onUpdate("cascade");
    //     $table->string("name",250);
    //     $table->text("address");
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
            $data = outlet::where('user_id', $id)
                ->paginate(16);
            return view("FrontEnd.Outlet.index", compact('data'));
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
        return view("FrontEnd.Outlet.create");
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
                'address' => 'required'
            ]);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            outlet::create([
                "name" => $request->name,
                "address" => $request->address,
                "user_id" => Auth::user()->id
            ]);
            return back()->with("success", "Berhasil menambahkan outlet");
        } catch (\Throwable $th) {
            return back()->withInput()->withErrors(["msg" => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = outlet::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data = outlet::find($id);
            $data == null && throw new Exception('404');
            Auth::user()->id !== $data->user_id && throw new Exception('401');
            return view("FrontEnd.Outlet.edit", compact('data'));
        } catch (\Throwable $th) {
            if ($th->getMessage() == '401') {
                abort(401);
            } else if ($th->getMessage() == '404') {
                abort(404);
            } else{
                return back()->withErrors(["msg"=>$th->getMessage()]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:250',
                'address' => 'required'
            ]);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            outlet::find($id)->update([
                "name" => $request->name,
                "address" => $request->address,
                "user_id" => Auth::user()->id
            ]);
            return back()->with("success", "Berhasil update outlet");
        } catch (\Throwable $th) {
            return back()->withInput()->withErrors(["msg" => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = outlet::find($id);
            if ($data == null) throw new Exception("Data tidak ditemukan");
            $data->delete();
            return back()->with("success", "Berhasil Hapus Product");
        } catch (\Throwable $th) {
            return back()->withInput()->withErrors(["msg" => $th->getMessage()]);
        }
    }
}
