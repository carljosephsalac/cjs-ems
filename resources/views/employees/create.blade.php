@extends('layouts.app')

@section('content')
    <section class="flex items-center justify-center w-full sm:w-fit xl:w-[500px]">
        <div class="relative flex justify-center w-full px-5 py-3 bg-white rounded-lg shadow-md jq-form-container">
            <form class="w-full" action="{{ route('employees.store') }}" method="POST" id="employee-form">
                @csrf
                <div class="grid grid-cols-1 gap-1 sm:grid-cols-2 sm:gap-3">
                    <x-input name="employee_id" error="employee_id" type="number">Employee ID</x-input>
                    <x-input name="fname" error="fname" type="text">First Name</x-input>
                    <x-input name="lname" error="lname" type="text">Last Name</x-input>
                    <x-input name="birthdate" error="birthdate" type="date">Birthdate</x-input>
                    <x-input name="age" placeholder="Auto calculate" readonly :age="true">
                        Age (auto)
                    </x-input>
                    <x-input name="salary" error="salary" type="number" step="any">Salary</x-input>
                </div>
                <x-input name="address" error="address" type="text">Address</x-input>
                <div class="flex flex-wrap justify-center gap-3 my-3">
                    <button class="text-white btn btn-primary btn-sm" type="button" disabled>
                        Create
                    </button>
                    <button class="text-white btn btn-success btn-sm" type="submit">
                        Save
                    </button>
                    <button class="text-white btn btn-info btn-sm" type="button" disabled>
                        Update
                    </button>
                    <button class="text-white btn btn-error btn-sm" type="button" disabled>
                        Destroy
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
