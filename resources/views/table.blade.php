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
