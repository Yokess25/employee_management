<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <body> 
        <div>
            <h1>Employee Details</h1>
            <div>
                <strong>Name:</strong> {{ $employee->name }}
            </div>
            <div>
                <strong>Contact Number:</strong> {{ $employee->contact_number }}
            </div>
            <div>
                <strong>Email:</strong> {{ $employee->email }}
            </div>
            <div>
                <strong>Date of Birth:</strong> {{ $employee->d_o_b }}
            </div>
            <div>
                <strong>Address:</strong> {{ $employee->address }}
            </div>
            <div>
                <strong>Employee Register Number:</strong> {{ $employee->employee_reg_no }}
            </div>
            <div>
                <a href="{{ route('index') }}">Back to List</a>
                <a href="{{ route('edit', ['employee' => $employee]) }}">Edit</a>
                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </div>
        </div>
    </body>
</html>
