<?php

namespace App\Http\Controllers;

use App\Events\EmployeeEvent;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Message;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employee', ['employees' => $employees]);
    }
    public function create()
    {
        return view('createEmployee');
    }
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required',
                'phone' => 'required',
                'image' => 'required'
            ]
        );
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = date('Y-m-d') . '_' . time() . '.' . $extension;
            $file->move('image_upload/', $filename);
            $data['image'] = 'image_upload/' . $filename;
        }

        $employee = Employee::create($data);
        broadcast(new EmployeeEvent($employee));
        return back();
    }
}
