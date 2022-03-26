<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'name'     => 'required|unique:employees',
            'email'    => 'required|unique:employees|max:255',
            'phone'    => 'required|unique:employees',
        ]);

        if($request->photo){ // photo found
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $extension = explode("/", $sub)[1];
            
            $name = time().".".$extension;
            $img = Image::make($request->photo)->resize(240, 400);
            $upload_path = "backend/employee/";
            $image_url = $upload_path.$name;
            $img->save($image_url);
        }else{
            $image_url = "";
        }

        $employee               = new Employee();
        $employee->name         = $request->input('name');
        $employee->email        = $request->input('email');
        $employee->phone        = $request->input('phone');
        $employee->address      = $request->input('address');
        $employee->salary       = $request->input('salary');
        $employee->photo        = $image_url;
        $employee->nid        = $request->input('nid');
        $employee->joining_date = $request->input('joining_date');
        $employee->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employees = DB::table('employees')->where('id', $id)->first();
        return response()->json($employees);
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
        $employee = DB::table('employees')->where('id', $id)->first();
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
            $upload_path = "backend/employee/";
            $image_url = $upload_path.$name;
            $img->save($image_url);

            // old image unlink
            if($employee->photo){
                unlink($employee->photo);
            }
        }else{
            $image_url = $employee->photo;
        }

        $employee               = Employee::find($id);
        $employee->name         = $request->input('name');
        $employee->email        = $request->input('email');
        $employee->phone        = $request->input('phone');
        $employee->address      = $request->input('address');
        $employee->salary       = $request->input('salary');
        $employee->photo        = $image_url;
        $employee->nid          = $request->input('nid');
        $employee->joining_date = $request->input('joining_date');
        $employee->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = DB::table('employees')->where('id', $id)->first();
        $photo = $employee->photo;
        if($photo){
            unlink($photo);
            DB::table('employees')->where('id', $id)->delete();
        }else{
            DB::table('employees')->where('id', $id)->delete();
        }
    }
}
