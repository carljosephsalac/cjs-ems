<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Management System</title>
    @vite('resources/css/app.css')
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
                <div class="relative flex justify-center px-5 py-3 bg-white rounded-lg shadow-md">
                    @isset($warningMessage)
                        <div role="alert" class="absolute w-auto alert -top-28 alert-warning to">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-current shrink-0" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span>{{ $warningMessage }}</span>
                            <div>
                                <a href="{{ route('showHome') }}" class="btn btn-sm">No</a>
                            </div>
                        </div>
                    @endisset
                    <form class="flex flex-col gap-1" action="" method="POST" id="employee-form">
                        @csrf
                        <input type="hidden" id="method" name="_method"> {{-- spoofing, same as @method() --}}
                        <div class="flex gap-5">
                            <label class="w-full form-control">
                                <div class="label">
                                    <span class="label-text">Employee ID</span>
                                </div>
                                <input
                                    class="w-full js-input input input-bordered {{ $errors->has('employee_id') ? 'input-error' : '' }}"
                                    name="employee_id" type="number" placeholder="Type here"
                                    {{ $errors->any() || request()->routeIs('edit') || request()->routeIs('delete') ? '' : 'disabled' }}
                                    value="{{ old('employee_id', $currentEmployee->employee_id ?? '') }}"
                                    {{ request()->routeIs('delete') ? 'readonly' : '' }} />
                                @error('employee_id')
                                    <div class="-bottom-7 label">
                                        <span class="text-red-600 label-text-alt">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>
                            <label class="w-full form-control">
                                <div class="label">
                                    <span class="label-text">First Name</span>
                                </div>
                                <input
                                    class="w-full js-input input input-bordered {{ $errors->has('fname') ? 'input-error' : '' }}"
                                    name="fname" type="text" placeholder="Type here"
                                    {{ $errors->any() || request()->routeIs('edit') || request()->routeIs('delete') ? '' : 'disabled' }}
                                    value="{{ old('fname', $currentEmployee->fname ?? '') }}"
                                    {{ request()->routeIs('delete') ? 'readonly' : '' }} />
                                @error('fname')
                                    <div class="label -bottom-7">
                                        <span class="text-red-600 label-text-alt">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>
                        </div>
                        <div class="flex gap-5">
                            <label class="w-full form-control">
                                <div class="label">
                                    <span class="label-text">Last Name</span>
                                </div>
                                <input
                                    class="w-full js-input input input-bordered {{ $errors->has('lname') ? 'input-error' : '' }}"
                                    name="lname" type="text" placeholder="Type here"
                                    {{ $errors->any() || request()->routeIs('edit') || request()->routeIs('delete') ? '' : 'disabled' }}
                                    value="{{ old('lname', $currentEmployee->lname ?? '') }}"
                                    {{ request()->routeIs('delete') ? 'readonly' : '' }} />
                                @error('lname')
                                    <div class="label -bottom-7">
                                        <span class="text-red-600 label-text-alt">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>
                            <label class="w-full form-control">
                                <div class="label">
                                    <span class="label-text">Birthdate</span>
                                </div>
                                <input
                                    class="w-full js-input input input-bordered {{ $errors->has('birthdate') ? 'input-error' : '' }}"
                                    name="birthdate" type="date" placeholder="Type here"
                                    {{ $errors->any() || request()->routeIs('edit') || request()->routeIs('delete') ? '' : 'disabled' }}
                                    value="{{ old('birthdate', $currentEmployee->birthdate ?? '') }}"
                                    {{ request()->routeIs('delete') ? 'readonly' : '' }} />
                                @error('birthdate')
                                    <div class="label -bottom-7">
                                        <span class="text-red-600 label-text-alt">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>
                        </div>
                        <div class="flex gap-5">
                            <label class="w-full form-control">
                                <div class="label">
                                    <span class="label-text">Age (auto)</span>
                                </div>
                                <input
                                    class="w-full input input-bordered {{ $errors->has('age') ? 'input-error' : '' }}"
                                    name="age" type="number" placeholder="Auto calculate"
                                    value="{{ $currentEmployee->age ?? '' }}" readonly />
                            </label>
                            <label class="w-full form-control">
                                <div class="label">
                                    <span class="label-text">Salary</span>
                                </div>
                                <input
                                    class="w-full js-input input input-bordered {{ $errors->has('salary') ? 'input-error' : '' }}"
                                    name="salary" type="number" placeholder="Type here"
                                    {{ $errors->any() || request()->routeIs('edit') || request()->routeIs('delete') ? '' : 'disabled' }}
                                    value="{{ old('salary', $currentEmployee->salary ?? '') }}"
                                    {{ request()->routeIs('delete') ? 'readonly' : '' }} />
                                @error('salary')
                                    <div class="label -bottom-7">
                                        <span class="text-red-600 label-text-alt">{{ $message }}</span>
                                    </div>
                                @enderror
                            </label>
                        </div>
                        <label class="w-full form-control">
                            <div class="label {{ $errors->has('salary') ? 'pt-0' : '' }}">
                                <span class="label-text">Address</span>
                            </div>
                            <input
                                class="w-full js-input input input-bordered {{ $errors->has('address') ? 'input-error' : '' }}"
                                name="address" type="text" placeholder="Type here"
                                {{ $errors->any() || request()->routeIs('edit') || request()->routeIs('delete') ? '' : 'disabled' }}
                                value="{{ old('address', $currentEmployee->address ?? '') }}"
                                {{ request()->routeIs('delete') ? 'readonly' : '' }} />
                            @error('address')
                                <div class="label -bottom-7">
                                    <span class="text-red-600 label-text-alt">{{ $message }}</span>
                                </div>
                            @enderror
                        </label>
                        <div class="flex justify-center gap-3 my-3">
                            <a class="btn btn-primary btn-sm" id="home-btn" href="{{ route('showHome') }}">
                                Create
                            </a>
                            <button class="btn btn-primary btn-sm" type="button" id="create-btn">
                                Create
                            </button>
                            <button class="text-white btn btn-success btn-sm js-buttons" id="save-btn"
                                type="button"
                                {{ $errors->any() && request()->routeIs('showHome') ? '' : 'disabled' }}>
                                Save
                            </button>
                            <button class="text-white btn btn-info btn-sm js-buttons" type="button" id="update-btn"
                                {{ request()->routeIs('edit') ? '' : 'disabled' }}>
                                Update
                            </button>
                            <button class="text-white btn btn-error btn-sm js-buttons" type="button" id="delete-btn"
                                {{ request()->routeIs('delete') ? '' : 'disabled' }}>
                                Delete
                            </button>
                        </div>
                    </form>
                </div>
            </section>

            <section class="flex items-center justify-center w-1/2 px-10">
                <div class="relative flex justify-center w-full py-3 bg-white rounded-lg shadow-md h-fit">
                    {{-- ALERTS --}}
                    @session('created')
                        <div role="alert" class="absolute w-auto text-white -top-20 alert alert-success js-alert">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-current shrink-0"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $value }}</span>
                        </div>
                    @endsession
                    @session('updated')
                        <div role="alert" class="absolute w-auto text-white -top-20 alert alert-info js-alert">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-current shrink-0"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $value }}</span>
                        </div>
                    @endsession
                    @session('deleted')
                        <div role="alert" class="absolute w-auto text-white -top-20 alert alert-error js-alert">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-current shrink-0"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $value }}</span>
                        </div>
                    @endsession
                    {{-- TABLE --}}
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
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <th class=" whitespace-nowrap">{{ $employee->employee_id }}</th>
                                        <td class=" whitespace-nowrap">{{ $employee->fname }}</td>
                                        <td class=" whitespace-nowrap">{{ $employee->lname }}</td>
                                        <td class=" whitespace-nowrap">{{ $employee->birthdate }}</td>
                                        <td class=" whitespace-nowrap">{{ $employee->age }}</td>
                                        <td class=" whitespace-nowrap">{{ $employee->salary }}</td>
                                        <td class=" whitespace-nowrap">{{ $employee->address }}</td>
                                        <td>
                                            <a class="text-white btn btn-info btn-sm"
                                                href="{{ route('edit', ['currentEmployee' => $employee]) }}">
                                                Edit
                                            </a>
                                        </td>
                                        <td>
                                            <a class="text-white btn btn-error btn-sm"
                                                href="{{ route('delete', ['currentEmployee' => $employee]) }}">
                                                Delete
                                            </a>
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

    <script>
        const homeBtn = document.getElementById('home-btn');
        const createBtn = document.getElementById('create-btn');
        const saveBtn = document.getElementById('save-btn');
        const updateBtn = document.getElementById('update-btn');
        const deleteBtn = document.getElementById('delete-btn');
        const employeeForm = document.getElementById('employee-form');

        /* Show and hide create and home button */
        if (updateBtn.disabled || deleteBtn.disabled) { // if either the update or delete button is disabled
            createBtn.classList.remove('hidden');
            homeBtn.classList.add('hidden');
            createBtn.addEventListener('click', () => { // enable all input fields with the class when clicked
                document.querySelectorAll('.js-input').forEach(input => {
                    input.removeAttribute('disabled');
                });
                saveBtn.removeAttribute('disabled');
                createBtn.disabled = true;
            });
        } else {

        }
        if (!updateBtn.disabled || !deleteBtn.disabled) { // if both the update and delete buttons are not disabled
            homeBtn.classList.remove('hidden');
            createBtn.classList.add('hidden');
        }

        // disable create button if save button is not disabled using guard && operator instead of if else
        saveBtn.disabled === false && (createBtn.disabled = true);

        /* remove alerts after 3 seconds */
        document.querySelectorAll('.js-alert').forEach(alert => {
            if (alert) {
                setTimeout(() => {
                    alert.remove();
                }, 3000);
            }
        });

        /* handle form submission based on which button is clicked */

        // Select the hidden input field that will be used to set the HTTP method (e.g., POST, PUT, DELETE)
        const method = document.getElementById('method');

        // Get the current employee ID from the Blade template and assign it to a JavaScript variable
        // This assumes $currentEmployee->id is available in the view. If not, it will be an empty string.
        const currentEmployeeId = "{{ $currentEmployee->id ?? '' }}";

        document.querySelectorAll('.js-buttons').forEach(button => {
            button.addEventListener('click', () => {
                if (button.innerText === 'Save') {
                    employeeForm.action = '{{ route('store') }}';
                } else if (button.innerText === 'Update') {
                    // Use a placeholder ':currentEmployeeId' in the Blade route and replace it
                    // with the actual current employee ID using JavaScript
                    employeeForm.action =
                        '{{ route('update', ['currentEmployee' => ':currentEmployeeId']) }}'.replace(
                            ':currentEmployeeId', currentEmployeeId);
                    method.value = 'PUT';
                } else if (button.innerText === 'Delete') {
                    employeeForm.action =
                        '{{ route('destroy', ['currentEmployee' => ':currentEmployeeId']) }}'.replace(
                            ':currentEmployeeId', currentEmployeeId);
                    method.value = 'DELETE';
                }
                employeeForm.submit();
            });
        });
    </script>
</body>

</html>
