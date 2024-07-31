<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="post" action="{{route('import')}}" enctype="multipart/form-data">
                @csrf
                <label for="import_file">Select a file:</label>
                <input type="file" id="import_file" accept=".csv" name="import_file"><br><br>
                @error('import_file')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
                <button type="submit" style="background-color: #04AA6D; border: none; color: white; padding: 10px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px;">Import</button>
            </form>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                   <div class="container mt-2">
                        <div class="row">
                            <div class="col-lg-12 margin-tb">
                                <div class="pull-left">             
                                    <h2>Employees Lists</h2>
                                </div>
                                <div class="pull-right mb-2">
                                    <a class="btn btn-success" href="{{ route('employees.create') }}"> Create Employee</a>
                                </div>
                            </div>
                        </div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <table class="table table-bordered" id="example">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b">ID</th>
                                    <th class="py-2 px-4 border-b">NAME</th>
                                    <th class="py-2 px-4 border-b">CONTACT NO</th>
                                    <th class="py-2 px-4 border-b">EMAIL</th>
                                    <th class="py-2 px-4 border-b">DATE.OF.BIRTH
                                    <th class="py-2 px-4 border-b">ADDRESS</th>
                                    <th class="py-2 px-4 border-b">EMPLOYEE NO</th>
                                    <th class="py-2 px-4 border-b">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sno = 1;
                                ?>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{$sno++}}</td>
                                        <td>{{$employee->name}}</td>
                                        <td>{{$employee->contact_number}}</td>
                                        <td>{{$employee->email}}</td>
                                        <td>{{$employee->d_o_b}}</td>
                                        <td>{{$employee->address}}</td>
                                        <td>EMP00{{$employee->id}}</td>
                                        <td>
                                            <form action="{{ route('employees.destroy',$employee->id) }}" method="Post">
                                                <a class="btn btn-primary" href="{{ route('employees.edit',$employee->id) }}">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>