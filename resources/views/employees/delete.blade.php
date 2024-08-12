@extends('layouts.app')

@section('content')
    <section class="flex items-center justify-center w-full sm:w-fit xl:w-[500px]">
        <div class="relative flex justify-center w-full px-5 py-3 bg-white rounded-lg shadow-md jq-form-container">
            <div role="alert" class="absolute flex w-auto alert xl:-top-24 -top-20 alert-warning jq-warning">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-current shrink-0" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span class="text-sm">Are you sure you want to delete {{ $employee->fname }} info?</span>
                <div>
                    <form action="{{ route('employees.index') }}" method="GET">
                        <button type="submit" class="btn btn-sm jq-no-btn">No</button>
                    </form>
                </div>
            </div>

            <form class="w-full" action="{{ route('employees.destroy', $employee) }}" method="POST" id="employee-form">
                @csrf
                @method('delete')
                <div class="grid grid-cols-1 gap-1 sm:grid-cols-2 sm:gap-3">
                    <x-input name="employee_id" error="employee_id" type="number" data="{{ $employee->employee_id }}"
                        readonly>
                        Employee ID
                    </x-input>
                    <x-input name="fname" error="fname" type="text" data="{{ $employee->fname }}" readonly>
                        First Name
                    </x-input>
                    <x-input name="lname" error="lname" type="text" data="{{ $employee->lname }}" readonly>
                        Last Name
                    </x-input>
                    <x-input name="birthdate" error="birthdate" type="date" data="{{ $employee->birthdate }}" readonly>
                        Birthdate
                    </x-input>
                    <x-input name="age" placeholder="Auto calculate" readonly :age="true">
                        Age (auto)
                    </x-input>
                    <x-input name="salary" error="salary" type="number" step="any" data="{{ $employee->salary }}"
                        readonly>Salary
                    </x-input>
                </div>
                <x-input name="address" error="address" type="text" data="{{ $employee->address }}" readonly>
                    Address
                </x-input>
                <div class="flex flex-wrap justify-center gap-3 my-3">
                    <button class="text-white btn btn-primary btn-sm" type="submit" form="create-form">
                        Create
                    </button>
                    <button class="text-white btn btn-success btn-sm" type="button" disabled>
                        Save
                    </button>
                    <button class="text-white btn btn-info btn-sm" type="button" disabled>
                        Update
                    </button>
                    <button class="text-white btn btn-error btn-sm" type="submit">
                        Destroy
                    </button>
                </div>
            </form>
        </div>
        <form action="{{ route('employees.create') }}" method="GET" id="create-form" class="hidden"></form>
    </section>
@endsection
