<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return response()->json($suppliers);
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
        $request->validate([
            'name'     => 'required|unique:suppliers',
            'email'    => 'required|unique:suppliers|max:255',
            'phone'    => 'required|unique:suppliers',
        ]);

        if($request->photo){ // photo found
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $extension = explode("/", $sub)[1];
            
            $name = time().".".$extension;
            $img = Image::make($request->photo)->resize(240, 400);
            $upload_path = "backend/supplier/";
            $image_url = $upload_path.$name;
            $img->save($image_url);
        }else{
            $image_url = "";
        }

        $supplier           = new Supplier();
        $supplier->name     = $request->input('name');
        $supplier->email    = $request->input('email');
        $supplier->phone    = $request->input('phone');
        $supplier->address  = $request->input('address');
        $supplier->photo    = $image_url;
        $supplier->shopname = $request->input('shopname');
        $supplier->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = DB::table('suppliers')->where('id', $id)->first();
        return response()->json($supplier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $supplier = DB::table('suppliers')->where('id', $id)->first();
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|max:255',
            'phone'    => 'required',
        ]);

        if($request->newphoto){ // photo found
            $position = strpos($request->newphoto, ';');
            $sub = substr($request->newphoto, 0, $position);
            $extension = explode("/", $sub)[1];
            
            $name = time().".".$extension;
            $img = Image::make($request->newphoto)->resize(240, 400);
            $upload_path = "backend/supplier/";
            $image_url = $upload_path.$name;
            $img->save($image_url);

            // old image unlink
            if($supplier->photo){
                unlink($supplier->photo);
            }
        }else{
            $image_url = $supplier->photo;
        }

        $supplier           = Supplier::find($id);
        $supplier->name     = $request->input('name');
        $supplier->email    = $request->input('email');
        $supplier->phone    = $request->input('phone');
        $supplier->address  = $request->input('address');
        $supplier->photo    = $image_url;
        $supplier->shopname = $request->input('shopname');
        $supplier->save();




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = DB::table('suppliers')->where('id', $id)->first();
        $photo = $supplier->photo;
        if($photo){
            unlink($photo);
            DB::table('suppliers')->where('id', $id)->delete();
        }else{
            DB::table('suppliers')->where('id', $id)->delete();
        }
    }
}
