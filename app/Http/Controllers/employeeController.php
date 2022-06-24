<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee;

class employeeController extends Controller
{
    //
    public function index()
    {
        return employee::orderBy('id', 'desc')->paginate(3);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $employee = new employee([
            'empId' => random_int(10000, 99999),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'phone_number' => $request->input('phone'),
            'dob' => $request->input('dob'),
            'image'=> null
        ]);
        $employee->save();
        return response()->json('employee created!');
    }
    public function show($id)
    {
        $employee = employee::find($id);
        return response()->json($employee);
    }
    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,'.$id,
            'phone' => 'required',
            'address' => 'required',
        ]);

        $employee = employee::find($id);
        $employee->update($request->all());
        return response()->json('employee updated!');
    }
    public function destroy($id)
    {
        $employee = employee::find($id);
        $employee->delete();
        return response()->json('employee deleted!');
    }

    public function search(Request $request)
    {
        $employee = employee::where('name', 'LIKE','%'. $request->keywords .'%')->orWhere('email','LIKE','%'.$request->keywords.'%')->get();
        return response()->json($employee);
         
    }
}
