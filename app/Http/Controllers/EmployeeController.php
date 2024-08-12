<?php

namespace App\Http\Controllers;

use Log;
use Carbon\Carbon;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index(Employee $currentEmployee)
    {
        $employees = Employee::select('id', 'employee_id', 'fname', 'lname', 'birthdate', 'age', 'address', 'salary')->get();
        return view('home', compact('employees', 'currentEmployee'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|numeric|unique:employees,employee_id',
            'fname' => 'required|string',
            'lname' => 'required|string',
            'birthdate' => 'required|date',
            'address' => 'required|string',
            'salary' => 'required|max:999999.99|decimal:1,2'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $validatedData = $validator->validated();
            $validatedData['age'] = Carbon::parse($request->birthdate)->age;
            $employee = Employee::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Created Successfully',
                'employee' => $employee
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create employee: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the employee.'
            ], 500);
        }
    }

    public function edit(Employee $currentEmployee)
    {
        return response()->json($currentEmployee);
    }

    // public function update(Request $request, Employee $currentEmployee)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'employee_id' => 'required|numeric|unique:employees,employee_id,' . $currentEmployee->id,
    //         'fname' => 'required|string',
    //         'lname' => 'required|string',
    //         'birthdate' => 'required|date',
    //         'address' => 'required|string',
    //         'salary' => 'required|max:999999.99|decimal:1,2'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'errors' => $validator->errors()
    //         ], 422);
    //     }

    //     try {
    //         $validatedData = $request->all();
    //         $validatedData['age'] = Carbon::parse($request->birthdate)->age;
    //         $currentEmployee->update($validatedData);

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Updated Successfully',
    //             'currentEmployee' => $currentEmployee
    //         ]);
    //     } catch (\Exception $e) {
    //         Log::error('Failed to update employee: ' . $e->getMessage());

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'An error occurred while updating the employee.'
    //         ], 500);
    //     }
    // }

    public function update(Request $request, Employee $currentEmployee)
    {
        $validated = $request->validate([
            'employee_id' => 'required|numeric|unique:employees,employee_id,' . $currentEmployee->id,
            'fname' => 'required|string',
            'lname' => 'required|string',
            'birthdate' => 'required|date',
            'address' => 'required|string',
            'salary' => 'required|max:999999.99|decimal:1,2'
        ]);

        // session(['currentEmployee' => $currentEmployee]);

        session(['old_updated_at' => $currentEmployee->updated_at]);

        $currentEmployee->update($validated);

        if (session('old_updated_at')->eq($currentEmployee->updated_at)) {
            return redirect()->route('index')->with('no', 'No changes were made');
        } else {
            return redirect()->route('index')->with('updated', 'Updated Successfully');
        }


    }

    public function delete(Employee $currentEmployee)
    {
        return response()->json($currentEmployee);
    }

    // public function destroy(Employee $currentEmployee)
    // {
    //     try {
    //         $currentEmployee->delete();
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Deleted Successfully'
    //         ]);
    //     } catch (\Exception $e) {
    //         Log::error('Failed to delete employee: ' . $e->getMessage());

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'An error occurred while deleting the employee.'
    //         ], 500);
    //     }
    // }

    public function destroy(Employee $currentEmployee)
    {
        $currentEmployee->delete();

        return redirect()->route('index')->with('deleted', 'Deleted Successfully');
    }
}
