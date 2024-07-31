<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mt-2">
                        <div class="row">
                            <div class="col-lg-12 margin-tb">
                                <div class="pull-left">
                                    <!-- <h2>Edit Employee</h2> -->
                                </div>
                                <div class="pull-right">
                                    <a class="btn btn-primary" href="{{ route('employees.index') }}">
                                        Back</a>
                                </div>
                            </div>
                        </div>
                        @if(session('status'))
                        <div class="alert alert-success mb-1 mt-1">
                            {{ session('status') }}
                        </div>
                        @endif
                        <form action="{{ route('employees.update',$employee->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Employee Name:</strong>
                                        <input type="text" name="name" value="{{ $employee->name }}" class="form-control"
                                            placeholder="Employee name">
                                        @error('name')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Contact Number:</strong>
                                        <input type="text" name="contact_number" class="form-control"
                                            value="{{ $employee->contact_number }}">
                                        @error('contact_number')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Employee Email:</strong>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ $employee->email }}">
                                        @error('email')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Date of Birth:</strong>
                                        <input type="date" name="d_o_b" class="form-control"
                                            value="{{ $employee->d_o_b }}">
                                        @error('d_o_b')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Employee Address:</strong>
                                        <input type="text" name="address" value="{{ $employee->address }}" class="form-control"
                                            placeholder="address">
                                        @error('address')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" style="background-color: #04AA6D; border: none; color: white; padding: 10px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px;" class="btn btn-primary ml-3">Submit</button>
                            </div>
                        </form>
                    </div>        
                </div>
            </div>
        </div>
    </div>
</x-app-layout>