<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\outlet;
use App\Models\product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // $table->bigInteger("name");
    // $table->bigInteger("price");
    // $table->string("image", 250);
    // $table->text("desc");
    // $table->foreign("outlet_id")->references("id")->on("outlets")
    // $table->foreign("category_id")->references("id")->on("categories")
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $id = Auth::user()->id;
            $data = product::where('user_id', $id)->with('category:id,name', 'outlet:id,name')
                ->paginate(16);
            return view("FrontEnd.Product.index", compact('data'));
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
        $id = Auth::user()->id;
        $category = category::all();
        $outlet = outlet::where("user_id", $id)->get();
        return view("FrontEnd.Product.create", compact('category', 'outlet'));
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
                'name' => 'required|unique:products|max:250',
                'desc' => 'required',
                'price' => 'required|integer',
                'image' =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'category_id' => 'required',
                'outlet_id' => 'required'
            ]);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            $data = product::create([
                'name' => $request->name,
                'desc' => $request->desc,
                'price' => $request->price,
                'image' =>  $imageName,
                'category_id' => $request->category_id,
                'outlet_id' => $request->outlet_id,
                'user_id' => Auth::user()->id
            ]);
            return back()->with("success", "Berhasil Menambah Product {$request->name}");
        } catch (\Throwable $th) {
            return back()->withInput()->withErrors(["msg" => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data = product::where('id', $id)->with('category:id,name', 'outlet:id,name')->first();
            $data == null && throw new Exception('404');
            Auth::user()->id !== $data->user_id && throw new Exception('401');
            return view('FrontEnd.Product.show', compact('data'));
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data = product::where('id', $id)->with('category:id,name', 'outlet:id,name')->first();
            $data == null && throw new Exception('404');
            Auth::user()->id !== $data->user_id && throw new Exception('401');
            $category = category::all();
            $outlet = outlet::where("user_id", Auth::user()->id)->get();
            return view('FrontEnd.Product.edit', compact('data','category','outlet'));
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
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $find = product::find($id);
            if($find == null) throw new Exception("Produk ini tidak ada");
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:250|unique:products,name,'.$id,
                'desc' => 'required',
                'price' => 'required|integer',
                'image' =>  'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'category_id' => 'required',
                'outlet_id' => 'required'
            ]);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            if($request->image !== null){
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
            } else{
                $imageName = $find->image;
            }
            $data = [
                'name' => $request->name,
                'desc' => $request->desc,
                'price' => $request->price,
                'image' =>  $imageName,
                'category_id' => $request->category_id,
                'outlet_id' => $request->outlet_id,
                'user_id' => Auth::user()->id
            ];
            $find->update($data);
            return back()->with("success", "Berhasil Update Product {$request->name}");
        } catch (\Throwable $th) {
            return back()->withInput()->withErrors(["msg" => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = product::find($id);
            if ($data == null) throw new Exception("Data tidak ditemukan");
            $data->delete();
            return back()->with("success", "Berhasil Hapus Product");
        } catch (\Throwable $th) {
            return back()->withInput()->withErrors(["msg" => $th->getMessage()]);
        }
        
    }
}
