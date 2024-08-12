<section class="flex items-center justify-center flex-grow w-full xl:w-[700px]">
    <div class="relative flex justify-center w-full py-2 bg-white rounded-lg shadow-md jq-table-container h-fit ">
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
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <th class="whitespace-nowrap">{{ $employee->employee_id }}</th>
                            <td class="whitespace-nowrap">{{ $employee->fname }}</td>
                            <td class="whitespace-nowrap">{{ $employee->lname }}</td>
                            <td class="whitespace-nowrap">{{ $employee->birthdate }}</td>
                            <td class="whitespace-nowrap">{{ $employee->age }}</td>
                            <td class="whitespace-nowrap">{{ $employee->salary }}</td>
                            <td class="whitespace-nowrap">{{ $employee->address }}</td>
                            <td>
                                <a class="text-white btn btn-info btn-sm"
                                    href="{{ route('employees.edit', $employee) }}">
                                    Edit
                                </a>
                            </td>
                            <td>
                                <a class="text-white btn btn-error btn-sm"
                                    href="{{ route('employees.delete', $employee) }}">
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
