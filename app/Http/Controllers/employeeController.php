<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee;

class employeeController extends Controller
{
    //
    public function index()
    {
        $employee = employee::all()->toArray();
        return array_reverse($employee);      
    }
    public function store(Request $request)
    {
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
}
