<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Management System</title>
    <link rel="icon" type="image/x-icon" href="{{ Vite::asset('resources/images/employee.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('jquery.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
</head>

<body>
    <div class="flex flex-col bg-gray-200 xl:h-screen">
        <nav class="fixed z-10 shadow-md navbar bg-base-100">
            <div class="flex-1">
                <a class="text-xl btn btn-ghost">
                    <span class="hidden sm:inline">Employee Management System</span>
                    <span class="inline sm:hidden">EMS</span>
                </a>
            </div>
            <div class="flex-none">
                <ul class="px-1 menu menu-horizontal">
                    <li>
                        <details>
                            <summary>
                                <span class="sm:inline">{{ Auth::user()->fname }}</span>
                            </summary>
                            <ul class="w-full p-2 rounded-t-none bg-base-100">
                                <li class="flex justify-center">
                                    <form action="{{ route('auth.logout') }}" method="POST"
                                        class="flex justify-center px-0 text-center">
                                        @csrf
                                        <button class="w-full" type="submit">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </details>
                    </li>
                </ul>
            </div>
        </nav>

        <main
            class="flex flex-col xl:flex-row justify-center px-3 md:px-5 lg:px-8 flex-grow xl:pt-[68px] pt-[160px] items-center gap-20 pb-10 min-h-screen">
            <section class="flex items-center justify-center w-full sm:w-fit xl:w-[500px]">
                <div
                    class="relative flex justify-center w-full px-5 py-3 bg-white rounded-lg shadow-md jq-form-container">
                    <form class="w-full"
                        action="{{ old('employee-id') ? route('update', ['currentEmployee' => old('employee_id')]) : '' }}"
                        method="POST" id="employee-form">
                        @csrf
                        <input type="hidden" id="method" name="_method"> {{-- spoofing, same as @method() --}}
                        <div class="grid grid-cols-1 gap-1 sm:grid-cols-2 sm:gap-3">
                            <x-input name="employee_id" type="number">
                                Employee ID
                            </x-input>
                            <x-input name="fname" type="text">
                                First Name
                            </x-input>
                            <x-input name="lname" type="text">
                                Last Name
                            </x-input>
                            <x-input name="birthdate" type="date">
                                Birthdate
                            </x-input>
                            <x-input name="age" placeholder="Auto calculate" readonly>
                                Age (auto)
                            </x-input>
                            <x-input name="salary" type="number" step="any">
                                Salary
                            </x-input>
                        </div>
                        <x-input name="address" type="text">
                            Address
                        </x-input>
                        {{-- container for currentEmployee id --}}
                        <input type="hidden" name="employee-id" id="employee-id" value="{{ old('employee-id') }}">
                        <div class="flex flex-wrap justify-between gap-3 my-3">
                            <button class="text-white btn btn-primary btn-sm" type="button" id="create-btn">
                                Create
                            </button>
                            <div class="flex flex-wrap justify-center gap-3 sm:gap-5">
                                <button class="text-white btn btn-success btn-sm" id="save-btn" type="button"
                                    disabled>
                                    Save
                                </button>
                                <button class="text-white btn btn-info btn-sm" type="button" id="update-btn"
                                    {{ $errors->any() ? '' : 'disabled' }}>
                                    Update
                                </button>
                                <button class="text-white btn btn-error btn-sm" type="button" id="destroy-btn"
                                    disabled>
                                    Destroy
                                </button>
                            </div>
                        </div>
                    </form>
                    <form
                        action="{{ old('employee-id') ? route('update', ['currentEmployee' => old('employee_id')]) : '' }}"
                        method="POST" id="delete-form">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="employee-id" id="employee-id" value="{{ old('employee-id') }}">
                    </form>
                </div>
            </section>

            <section class="flex items-center justify-center flex-grow w-full xl:w-[700px]">
                <div
                    class="relative flex justify-center w-full py-2 bg-white rounded-lg shadow-md jq-table-container h-fit ">
                    <x-alert></x-alert>
                    <div class="max-h-[600px] overflow-x-auto overflow-y-auto w-full">
                        <table class="table text-center no-wrap-table table-xs xl:table-md">
                            <thead class="sticky top-0 bg-white">
                                <tr>
                                    <th class="pt-1">Employee ID</th>
                                    <th class="pt-1">First Name</th>
                                    <th class="pt-1">Last Name</th>
                                    <th class="pt-1">Birthdate</th>
                                    <th class="pt-1">Age</th>
                                    <th class="pt-1">Salary</th>
                                    <th class="pt-1">Address</th>
                                    <th class="pt-1">Edit</th>
                                    <th class="pt-1">Delete</th>
                                </tr>
                            </thead>
                            <tbody id="jq-tbody">
                                @foreach ($employees as $employee)
                                    <tr data-id="{{ $employee->id }}">
                                        <th class="whitespace-nowrap">{{ $employee->employee_id }}</th>
                                        <td class="whitespace-nowrap">{{ $employee->fname }}</td>
                                        <td class="whitespace-nowrap">{{ $employee->lname }}</td>
                                        <td class="whitespace-nowrap">{{ $employee->birthdate }}</td>
                                        <td class="whitespace-nowrap">{{ $employee->age }}</td>
                                        <td class="whitespace-nowrap">{{ $employee->salary }}</td>
                                        <td class="whitespace-nowrap">{{ $employee->address }}</td>
                                        <td>
                                            <button class="text-white btn btn-info btn-sm" type="button"
                                                id="edit-btn" data-id="{{ $employee->id }}">
                                                Edit
                                            </button>
                                        </td>
                                        <td>
                                            <button class="text-white btn btn-error btn-sm" type="button"
                                                id="delete-btn" data-id="{{ $employee->id }}">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </main>
        <!--
            These hidden divs are used to ensure that Tailwind CSS includes the alert classes
            in the final build, even when they are dynamically added via JavaScript.
            Do not remove these divs as they are necessary for proper styling of dynamic alerts.
        -->
        <div class="hidden alert-success"></div>
        <div class="hidden alert-info"></div>
        <div class="hidden alert-error"></div>
    </div>

    @include('home-jquery')
</body>

</html>
