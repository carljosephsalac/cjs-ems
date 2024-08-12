@extends('layouts.app')

@section('content')
    <section class="flex items-center justify-center w-full sm:w-fit xl:w-[500px]">
        <div class="relative flex justify-center w-full px-5 py-3 bg-white rounded-lg shadow-md jq-form-container">
            <form class="w-full" action="{{ route('employees.update', $employee) }}" method="POST" id="employee-form">
                @csrf
                @method('patch')
                <div class="grid grid-cols-1 gap-1 sm:grid-cols-2 sm:gap-3">
                    <x-input name="employee_id" error="employee_id" type="number" data="{{ $employee->employee_id }}">
                        Employee ID
                    </x-input>
                    <x-input name="fname" error="fname" type="text" data="{{ $employee->fname }}">
                        First Name
                    </x-input>
                    <x-input name="lname" error="lname" type="text" data="{{ $employee->lname }}">
                        Last Name
                    </x-input>
                    <x-input name="birthdate" error="birthdate" type="date" data="{{ $employee->birthdate }}">
                        Birthdate
                    </x-input>
                    <x-input name="age" placeholder="Auto calculate" readonly :age="true">
                        Age (auto)
                    </x-input>
                    <x-input name="salary" error="salary" type="number" step="any"
                        data="{{ $employee->salary }}">Salary
                    </x-input>
                </div>
                <x-input name="address" error="address" type="text" data="{{ $employee->address }}">
                    Address
                </x-input>
                <div class="flex flex-wrap justify-center gap-3 my-3">
                    <button class="text-white btn btn-primary btn-sm" type="submit" form="create-form">
                        Create
                    </button>
                    <button class="text-white btn btn-success btn-sm" type="button" disabled>
                        Save
                    </button>
                    <button class="text-white btn btn-info btn-sm" type="submit">
                        Update
                    </button>
                    <button class="text-white btn btn-error btn-sm" type="button" disabled>
                        Destroy
                    </button>
                </div>
            </form>
        </div>
        <form action="{{ route('employees.create') }}" method="GET" id="create-form" class="hidden"></form>
    </section>
@endsection
