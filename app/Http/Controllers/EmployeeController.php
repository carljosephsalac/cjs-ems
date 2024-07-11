<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function showHome(Employee $currentEmployee = null)
    {
        $employees = Employee::select('id', 'employee_id', 'fname', 'lname', 'birthdate', 'age', 'address', 'salary')->get();

        return view('home', compact('employees', 'currentEmployee'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|numeric|unique:employees,employee_id',
            'fname' => 'required|string',
            'lname' => 'required|string',
            'birthdate' => 'required|date',
            'address' => 'required|string',
            'salary' => 'required|max:999999.99|decimal:1,2'
        ]);

        $validatedData['age'] = Carbon::parse($request->birthdate)->age;

        Employee::create($validatedData);

        return redirect()->route('showHome')->with('created', 'Created Successfully');
    }

    public function edit(Employee $currentEmployee)
    {
        $employees = Employee::select('id', 'employee_id', 'fname', 'lname', 'birthdate', 'age', 'address', 'salary')->get();

        return view('home', compact('currentEmployee', 'employees'));
    }

    public function update(Request $request, Employee $currentEmployee = null)
    {
        // dd($currentEmployee->toArray());
        $validatedData = $request->validate([
            'employee_id' => 'required|numeric|unique:employees,employee_id,' . $currentEmployee->id,
            'fname' => 'required|string',
            'lname' => 'required|string',
            'birthdate' => 'required|date',
            'address' => 'required|string',
            'salary' => 'required|max:999999.99|decimal:1,2'
        ]);

        $validatedData['age'] = Carbon::parse($request->birthdate)->age;

        $currentEmployee->update($validatedData);

        return redirect()->route('showHome')->with('updated', 'Updated Successfully');
    }

    public function delete(Employee $currentEmployee)
    {
        $employees = Employee::select('id', 'employee_id', 'fname', 'lname', 'birthdate', 'age', 'address', 'salary')->get();

        return view('home', compact('currentEmployee', 'employees'));
    }

    public function destroy(Employee $currentEmployee)
    {
        $currentEmployee->delete();

        return redirect()->route('showHome')->with('deleted', 'Deleted Successfully');
    }
}