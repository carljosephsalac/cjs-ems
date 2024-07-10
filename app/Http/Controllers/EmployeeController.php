<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function showHome()
    {
        $employees = Employee::select('employee_id', 'fname', 'lname', 'birthdate', 'age', 'address', 'salary')->get();
        dd($employees->toArray());
        return view('home', compact('employees'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|numeric|unique:employees,employee_id',
            'fname' => 'required|string',
            'lname' => 'required|string',
            'birthdate' => 'required|date',
            'address' => 'required|string',
            'salary' => 'required|max:99999.99|decimal:1,2'
        ]);

        $validatedData['age'] = Carbon::parse($request->birthdate)->age;

        Employee::create($validatedData);

        return redirect()->route('showHome')->with('created', 'Created Successfully');
    }

    public function edit(Employee $employee)
    {
        $employees = Employee::select('employee_id', 'fname', 'lname', 'birthdate', 'age', 'address', 'salary')->get();

        return view('home', compact('employee', 'employess'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|numeric|unique:employees,employee_id',
            'fname' => 'required|string',
            'lname' => 'required|string',
            'birthdate' => 'required|date',
            'address' => 'required|string',
            'salary' => 'required|max:99999.99|decimal:1,2'
        ]);

        $validatedData['age'] = Carbon::parse($request->birthdate)->age;

        $employee->update($validatedData);

        return redirect()->route('showHome')->with('updated', 'Updated Successfully');
    }

    public function delete(Employee $employee)
    {
        $employees = Employee::select('employee_id', 'fname', 'lname', 'birthdate', 'age', 'address', 'salary')->get();

        return view('home', compact('employee', 'employess'));
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('showHome')->with('deleted', 'Deleted Successfully');
    }
}