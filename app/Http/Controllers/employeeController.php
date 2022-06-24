<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee;
use Carbon\Carbon;

class employeeController extends Controller
{
    // Define image upload path
    const UPLOAD_EMP_IMAGE_PATH  = '/public/assets/images/employee/';

    // get all employees data
    public function index()
    {
        return employee::orderBy('id', 'desc')->paginate(5);
    }

    // create new employee
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'phone_number' => 'required|size:10',
            'address' => 'required',
            'image' => 'mimes:jpg,png'
        ]);
        $employee = new employee([
            'empId' => random_int(10000, 99999),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'phone_number' => $request->input('phone_number'),
            'dob' => $request->input('dob'),
        ]);
        
        // Upload employee profile image
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $emp_image = $this->upload_media($image, employee::UPLOAD_EMP_IMAGE_PATH);
            $employee->image = $emp_image;
        }
        $employee->save();
        return response()->json('employee created!');
    }

    // Get employee details by id
    public function show($id)
    {
        $employee = employee::find($id);
        return response()->json($employee);
    }

    // Update employee details 
    public function update($id, Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,'.$id,
            'phone_number' => 'required|size:10',
            'address' => 'required',
            'image' => 'mimes:jpg,png'
        ]);

        $update = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'dob' => $request->dob,
            'phone_number' => $request->phone_number,
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $emp_image = $this->upload_media($image, employee::UPLOAD_EMP_IMAGE_PATH);
            $update['image'] = $emp_image;
        }

        $employee = employee::find($id);
        $employee->update($update);
        return response()->json('employee updated!');
    }

    // Delete employee data
    public function destroy($id)
    {
        $employee = employee::find($id);
        $employee->delete();
        return response()->json('employee deleted!');
    }

    // Search employee detail using name and email
    public function search(Request $request)
    {
        $employee = employee::where('name', 'LIKE','%'. $request->keywords .'%')->orWhere('email','LIKE','%'.$request->keywords.'%')->get();
        return response()->json($employee);
         
    }


    /*Function for upload media*/
    public static function upload_media($media, $upload_media_path)
    {
        $current_timestamp = Carbon::now()->timestamp; // Produces something like 1552296328
        $media_name = $current_timestamp . '_' . $media->getClientOriginalName();
        for ($i = 2; ; $i++) {
            if (file_exists(base_path() . $upload_media_path . $media_name)) {
                $media_name = $i . '_' . $media_name;
            } else {
                break;
            }
        }
        $media->move(base_path() . '/' . $upload_media_path, $media_name);
        return $media_name;
    }

}
