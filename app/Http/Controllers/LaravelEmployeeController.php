<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Employee;

class LaravelEmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('employees.create', compact('employees'));
    }

    public function store(Request $request)
    {
       $validated = $request->validate([
        'employee_id' => 'required|numeric|unique:employees,employee_id',
        'fname' => 'required|string',
        'lname' => 'required|string',
        'birthdate' => 'required|date',
        'address' => 'required|string',
        'salary' => 'required|max:999999.99|decimal:1,2'
       ]);

       $validated['age'] = Carbon::parse($request->birthdate)->age;

       Employee::create($validated);

       return redirect()->route('employees.index')->with('created', 'Created Successfully');
    }

    public function edit(Employee $employee)
    {
        $employees = Employee::all();
        return view('employees.edit', compact('employee', 'employees'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'employee_id' => 'required|numeric|unique:employees,employee_id,' . $employee->id,
            'fname' => 'required|string',
            'lname' => 'required|string',
            'birthdate' => 'required|date',
            'address' => 'required|string',
            'salary' => 'required|max:999999.99|decimal:1,2'
        ]);

        session(['old_updated_at' => $employee->updated_at]);

        $employee->update($validated);

        if (session('old_updated_at')->eq($employee->updated_at)) {
            return redirect()->route('employees.index')->with('no', 'No changes were made');
        } else {
            return redirect()->route('employees.index')->with('updated', 'Updated Successfully');
        }


    }

    public function delete(Employee $employee)
    {
        $employees = Employee::all();
        return view('employees.delete', compact('employee', 'employees'));
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')->with('deleted', 'Deleted Successfully');
    }
}