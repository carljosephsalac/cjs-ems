@extends('layouts.app')

@section('content')
    <section class="flex items-center justify-center w-full sm:w-fit xl:w-[500px]">
        <div class="relative flex justify-center w-full px-5 py-3 bg-white rounded-lg shadow-md jq-form-container">
            <form class="w-full" action="{{ route('employees.create') }}" method="get" id="employee-form">
                <div class="grid grid-cols-1 gap-1 sm:grid-cols-2 sm:gap-3">
                    <x-input type="number" disabled>Employee ID</x-input>
                    <x-input type="text" disabled>First Name</x-input>
                    <x-input type="text" disabled>Last Name</x-input>
                    <x-input type="date" disabled>Birthdate</x-input>
                    <x-input placeholder="Auto calculate" :disabled="false" readonly :age="true">
                        Age (auto)
                    </x-input>
                    <x-input type="number" disabled step="any">Salary</x-input>
                </div>
                <x-input type="text" disabled>Address</x-input>

                <div class="flex flex-wrap justify-center gap-3 my-3">
                    <button class="text-white btn btn-primary btn-sm" type="submit" id="create-btn">
                        Create
                    </button>
                    <button class="text-white btn btn-success btn-sm" id="save-btn" type="button" disabled>
                        Save
                    </button>
                    <button class="text-white btn btn-info btn-sm" type="button" id="update-btn" disabled>
                        Update
                    </button>
                    <button class="text-white btn btn-error btn-sm" type="button" id="destroy-btn" disabled>
                        Destroy
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
