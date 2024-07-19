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
    <div class="flex flex-col h-screen bg-gray-200">
        <nav class="fixed z-10 shadow-md navbar bg-base-100">
            <div class="flex-1">
                <a class="text-xl btn btn-ghost">Employee Management System</a>
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


        <main class="flex justify-center flex-grow">
            <section class="flex items-center justify-center w-1/2">
                <div class="relative flex justify-center px-5 py-3 bg-white rounded-lg shadow-md jq-form-container">
                    <form class="flex flex-col gap-1" action="" method="POST" id="employee-form">
                        @csrf
                        <input type="hidden" id="method" name="_method"> {{-- spoofing, same as @method() --}}
                        <div class="flex gap-5">
                            <label class="w-full form-control">
                                <div class="label">
                                    <span class="label-text">Employee ID</span>
                                </div>
                                <input class="w-full jq-input input input-bordered" name="employee_id" type="number"
                                    placeholder="Type here" disabled />
                            </label>
                            <label class="w-full form-control">
                                <div class="label">
                                    <span class="label-text">First Name</span>
                                </div>
                                <input class="w-full jq-input input input-bordered" name="fname" type="text"
                                    placeholder="Type here" disabled />
                            </label>
                        </div>
                        <div class="flex gap-5">
                            <label class="w-full form-control">
                                <div class="label">
                                    <span class="label-text">Last Name</span>
                                </div>
                                <input class="w-full jq-input input input-bordered" name="lname" type="text"
                                    placeholder="Type here" disabled />
                            </label>
                            <label class="w-full form-control">
                                <div class="label">
                                    <span class="label-text">Birthdate</span>
                                </div>
                                <input class="w-full jq-input input input-bordered " name="birthdate" type="date"
                                    placeholder="Type here" disabled />
                            </label>
                        </div>
                        <div class="flex gap-5">
                            <label class="w-full form-control">
                                <div class="label">
                                    <span class="label-text">Age (auto)</span>
                                </div>
                                <input class="w-full input input-bordered " name="age" type="number"
                                    placeholder="Auto calculate" readonly />
                            </label>
                            <label class="w-full form-control">
                                <div class="label">
                                    <span class="label-text">Salary</span>
                                </div>
                                <input class="w-full jq-input input input-bordered" name="salary" type="number"
                                    placeholder="Type here" disabled />
                            </label>
                        </div>
                        <label class="w-full form-control">
                            <div class="label">
                                <span class="label-text">Address</span>
                            </div>
                            <input class="w-full jq-input input input-bordered" name="address" type="text"
                                placeholder="Type here" disabled />
                        </label>
                        <input type="hidden" name="employee-id" id="employee-id" value="">
                        <div class="flex justify-center gap-3 my-3">
                            <button class="btn btn-primary btn-sm" type="button" id="create-btn">
                                Create
                            </button>
                            <button class="text-white btn btn-success btn-sm js-buttons" id="save-btn" type="button"
                                disabled>
                                Save
                            </button>
                            <button class="text-white btn btn-info btn-sm js-buttons" type="button" id="update-btn"
                                disabled>
                                Update
                            </button>
                            <button class="text-white btn btn-error btn-sm js-buttons" type="button" id="destroy-btn"
                                disabled>
                                Destroy
                            </button>
                        </div>
                    </form>
                </div>
            </section>

            <section class="flex items-center justify-center w-1/2 px-10">
                <div
                    class="relative flex justify-center w-full py-3 bg-white rounded-lg shadow-md jq-table-container h-fit">
                    <div class="max-h-[500px] overflow-x-auto overflow-y-auto ">
                        <table class="table text-center no-wrap-table">
                            <thead>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Birthdate</th>
                                    <th>Age</th>
                                    <th>Salary</th>
                                    <th>Address</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody id="jq-tbody">
                                @foreach ($employees as $employee)
                                    <tr data-id="{{ $employee->id }}">
                                        <th class=" whitespace-nowrap">{{ $employee->employee_id }}</th>
                                        <td class=" whitespace-nowrap">{{ $employee->fname }}</td>
                                        <td class=" whitespace-nowrap">{{ $employee->lname }}</td>
                                        <td class=" whitespace-nowrap">{{ $employee->birthdate }}</td>
                                        <td class=" whitespace-nowrap">{{ $employee->age }}</td>
                                        <td class=" whitespace-nowrap">{{ $employee->salary }}</td>
                                        <td class=" whitespace-nowrap">{{ $employee->address }}</td>
                                        <td>
                                            <button class="text-white jq-edit-btn btn btn-info btn-sm" type="button"
                                                data-id="{{ $employee->id }}">
                                                Edit
                                            </button>
                                        </td>
                                        <td>
                                            <button class="text-white jq-delete-btn btn btn-error btn-sm"
                                                type="button" data-id="{{ $employee->id }}">
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
    </div>
    @include('jquery-ajax')
</body>

</html>
