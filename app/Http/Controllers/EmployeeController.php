<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employee.index', compact('employees'));
    }
    public function create() 
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'contact_number' => 'required|digits:10|unique:employees,contact_number',
            'email' => 'required|email|unique:employees,email',
            'd_o_b' => 'required',
            'address' => 'required'        
        ]);
        Employee::create($request->post());

        return redirect()->route('employees.index')->with('success','Employee has been created successfully.');
    }
    // public function show(Employee $employee)
    // {
    //     die('show');
    //     return view('employee.show', compact('employee'));
    // }
    public function edit(Employee $employee)
    {
        return view('employee.edit', compact('employee'));
    }
    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'name' => 'required',
            'contact_number' => [
            'required','digits:10',
            Rule::unique('employees', 'contact_number')->ignore($employee->id)],
            'email' => ['required', 'email',
            Rule::unique('employees', 'email')->ignore($employee->id)],
            'd_o_b' => 'required',
            'address' => 'required'
        ]);

        $employee->fill($request->post())->save();
        return redirect()->route('employees.index')->with('success','Employee detail has been updated successfully');
    }
    
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success','Employee has been deleted successfully');
    }

    public function import(Request $request, Employee $employee)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:csv,txt',
        ]);
// Handle the CSV upload
        if ($request->hasFile('import_file')) {
            $file = $request->file('import_file');
            $path = $file->getRealPath();

    // Open and read the CSV file
            if (($handle = fopen($path, 'r')) !== false) {
                // Get the header row (if your CSV has a header
                // Loop through the CSV rows
                while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                    // $data = array_combine($header, $row); // Combine header with row values
                    DB::table('employees')->insert([
                        'name'              => $row[0],
                        'contact_number'    => $row[1],
                        'email'             => $row[2],
                        'd_o_b'             => date('Y-m-d', strtotime($row[3])),
                        'address'           => $row[4],
                    ]);
                }
            fclose($handle);
        }
        return Redirect::route('employees.index')->with('success', 'CSV file uploaded and data inserted successfully!');     
    }
        return Redirect::back()->with('error', 'Please upload a valid CSV file.');
    }

    public function api_employees(Request $request, Employee $employee) 
    {
        $employees = Employee::all();
        return response()->json($employees);
    }
    
    public function getEmployee(Request $request) {
        $query = $request->input('q');

        if (!$query) {
            return response()->json(['error' => 'Search parameter is required'], 400);
        }

        // Search employees by ID, contact number, or email
        $employees = Employee::where('id', $query)
            ->orWhere('contact_number', $query)
            ->orWhere('email', $query)
            ->get();

        if ($employees->isEmpty()) {
            return response()->json(['message' => 'No employees found'], 404);
        }

        return response()->json($employees);
    }
}