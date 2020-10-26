<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use App\Models\Employee;
use DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee=Employee::all();
        return response()->json($employee);
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
        $validateData=$request->validate([
           'name' => 'required',
           'email' => 'required',
           'phone' => 'required'
        ]);
        if($request->photo){
        $fileNameWithExt=$request->file('photo')->getClientOriginalName();
        $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
        $extension=$request->file('photo')->getClientOriginalExtension();
        $fileNameToStore=$fileName.'_'.time().'.'.$extension;
        $path=$request->file('photo')->storeAS('public/photos/');
        
        $employee=new Employee();
        $employee->name=$request->name;
        $employee->email=$request->email;
        $employee->phone=$request->phone;
        $employee->sallary=$request->sallary;
        $employee->address=$request->address;
        $employee->nid=$request->nid;
        $employee->joining_date=$request->joining_date;
        $employee->photo=$fileNameToStore;
        $employee->save();
        }else{
            $employee=new Employee();
            $employee->name=$request->name;
            $employee->email=$request->email;
            $employee->phone=$request->phone;
            $employee->sallary=$request->sallary;
            $employee->address=$request->address;
            $employee->nid=$request->nid;
            $employee->joining_date=$request->joining_date;
            $employee->save();

        }
           
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $employee=DB::table('employees')->where('id',$id)->first();
       return response()->json($employee);
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
        $validateData=$request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required'
         ]);
            $employee=Employee::find($id);
            $employee->name=$request->name;
            $employee->email=$request->email;
            $employee->phone=$request->phone;
            $employee->sallary=$request->sallary;
            $employee->address=$request->address;
            $employee->nid=$request->nid;
            $employee->joining_date=$request->joining_date;
            $employee->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $employee=Employee::find($id);
       $photo=$employee->photo;
       if($photo){
           unlink($photo);
       }
       $employee->delete();
    }
}
