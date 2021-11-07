<?php

namespace App\Http\Controllers;

use App\Models\category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = category::all();
        return view('FrontEnd.Category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('FrontEnd.Category.create');
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
                "name" => "required|string|max:250",
                "desc" => "required"
            ]);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            category::create($request->all());
            return back()->with("success", "berhasil menambahkan category");
        } catch (\Throwable $th) {
            return back()->withInput()->withErrors(["msg", $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = category::find($id);
        if ($data == null) {
            abort(404);
        }
        return view('FrontEnd.Category.edit',compact("data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required|string|max:250",
                "desc" => "required"
            ]);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            category::find($id)->update($request->all());
            return back()->with("success", "berhasil update category");
        } catch (\Throwable $th) {
            return back()->withInput()->withErrors(["msg", $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $cat = category::find($id);
            if ($cat == null) {
                throw new Exception("Category tidak ada");
            }
            $cat->delete();
            return back()->with("success", "berhasil hapus category");
        } catch (\Throwable $th) {
            return back()->withInput()->withErrors(["msg", $th->getMessage()]);
        }
    }
}
