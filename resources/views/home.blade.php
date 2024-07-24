<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Management System</title>
    @vite('resources/css/app.css')
    <script src="{{ asset('jquery.js') }}"></script>
</head>

<body>
    <div class="flex flex-col bg-gray-200 xl:h-screen">
        <nav class="fixed z-10 shadow-md navbar bg-base-100">
            <div class="flex-1">
                <a class="text-md sm:text-xl btn btn-ghost">Employee Management System</a>
            </div>
            <div class="flex-none">
                <ul class="px-1 menu menu-horizontal">
                    <li>
                        <details>
                            <summary>Menu</summary>
                            <ul class="p-2 rounded-t-none bg-base-100">
                                <li><a>Logout</a></li>
                            </ul>
                        </details>
                    </li>
                </ul>
            </div>
        </nav>

        <main
            class="flex flex-col xl:flex-row justify-center px-3 md:px-5 lg:px-8 flex-grow xl:pt-[68px] pt-[160px] items-center xl:gap-5 gap-20 pb-10">
            <section class="flex items-center justify-center w-full sm:w-fit xl:w-[500px]">
                <div
                    class="relative flex justify-center w-full px-5 py-3 bg-white rounded-lg shadow-md jq-form-container">
                    <form class="flex flex-col w-full gap-1" action="" method="POST" id="employee-form">
                        @csrf
                        <input type="hidden" id="method" name="_method"> {{-- spoofing, same as @method() --}}
                        <div class="block sm:hidden">
                            <x-input name="employee_id" type="number">Employee ID</x-input>
                            <x-input name="fname" type="text">First Name</x-input>
                            <x-input name="lname" type="text">Last Name</x-input>
                            <x-input name="birthdate" type="date">Birthdate</x-input>
                            <x-input name="age" placeholder="Auto calculate" :disabled="false" readonly
                                :age="true">
                                Age (auto)
                            </x-input>
                            <x-input name="salary" type="number">Salary</x-input>
                        </div>
                        <div class="hidden gap-5 sm:flex">
                            <x-input name="employee_id" type="number">Employee ID</x-input>
                            <x-input name="fname" type="text">First Name</x-input>
                        </div>
                        <div class="hidden gap-5 sm:flex">
                            <x-input name="lname" type="text">Last Name</x-input>
                            <x-input name="birthdate" type="date">Birthdate</x-input>
                        </div>
                        <div class="hidden gap-5 sm:flex">
                            <x-input name="age" placeholder="Auto calculate" :disabled="false" readonly
                                :age="true">
                                Age (auto)
                            </x-input>
                            <x-input name="salary" type="number">Salary</x-input>
                        </div>
                        <x-input name="address" type="text">Address</x-input>
                        <input type="hidden" name="employee-id" id="employee-id" value=""> {{-- container for currentEmployee id --}}
                        <div class="flex justify-center gap-3 my-3">
                            <button class="text-white btn btn-primary btn-sm" type="button" id="create-btn">
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

            <section class="flex items-center justify-center flex-grow w-full xl:w-[700px] xl:ps-16">
                <div
                    class="relative flex justify-center w-full py-2 bg-white rounded-lg shadow-md jq-table-container h-fit">
                    <div class="max-h-[550px] overflow-x-auto overflow-y-auto w-full">
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
                                            <button class="text-white btn btn-info btn-sm" type="button" id="edit-btn"
                                                data-id="{{ $employee->id }}">
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
    @include('jquery-ajax')
</body>

</html>
