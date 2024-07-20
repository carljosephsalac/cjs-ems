<script>
    const createBtn = $('#create-btn');
    const saveBtn = $('#save-btn');
    const updateBtn = $('#update-btn');
    const destroyBtn = $('#destroy-btn');
    const employeeForm = $('#employee-form');
    const hiddenMethod = $('#method'); // hidden input for HTTP method

    createBtn.on('click', () => {
        $('.jq-input').removeAttr('disabled');
        saveBtn.removeAttr('disabled');
        createBtn.prop('disabled', true);
    });

    store();
    edit();
    update();
    deleteEmployee();
    destroy();

    function store() {
        saveBtn.on('click', () => {
            $.ajax({
                url: '{{ route('store') }}',
                method: 'POST',
                data: employeeForm.serialize(), // form data
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        const employee = response.employee;
                        const message = response.message;

                        displayAlert(message);

                        // Create a new table row with the employee data
                        const newRow = `
                                <tr data-id="${employee.id}">
                                    <th class="whitespace-nowrap">${employee.employee_id}</th>
                                    <td class="whitespace-nowrap">${employee.fname}</td>
                                    <td class="whitespace-nowrap">${employee.lname}</td>
                                    <td class="whitespace-nowrap">${employee.birthdate}</td>
                                    <td class="whitespace-nowrap">${employee.age}</td>
                                    <td class="whitespace-nowrap">${employee.salary}</td>
                                    <td class="whitespace-nowrap">${employee.address}</td>
                                    <td>
                                        <button class="text-white btn btn-info btn-sm" type="button" data-id="${employee.id}" id="edit-btn">
                                            Edit
                                        </button>
                                    </td>
                                    <td>
                                        <button class="text-white btn btn-error btn-sm" type="button" data-id="${employee.id}" id="delete-btn">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            `;
                        $('#jq-tbody').append(newRow); // Append the new row to the table body

                        resetForm();

                        saveBtn.prop('disabled', true);
                    } else {
                        console.log(response.errors);
                    }
                },
                error: function(response) {
                    displayErrors(response.responseJSON.errors);
                    console.log(response.responseJSON.errors);
                }
            });
        });
    }

    function edit() {
        // Attach a delegated event listener to the static parent element #jq-tbody
        $('#jq-tbody').on('click', '#edit-btn', function(e) { // ensures that new added edit button is clickable
            const employeeId = $(this).data('id'); // get data-id of the button
            $('#employee-id').val(employeeId); // Set the employeeId in the hidden input field
            $.ajax({
                url: '{{ route('edit', ['currentEmployee' => ':id']) }}'.replace(':id', employeeId),
                method: 'GET',
                success: function(response) {
                    resetForm();

                    $('[name="employee_id"]').val(response.employee_id);
                    $('[name="fname"]').val(response.fname);
                    $('[name="lname"]').val(response.lname);
                    $('[name="birthdate"]').val(response.birthdate);
                    $('[name="age"]').val(response.age);
                    $('[name="salary"]').val(response.salary);
                    $('[name="address"]').val(response.address);
                    $('input').removeAttr('disabled');

                    hiddenMethod.val('PUT'); // Set method to PUT for update

                    createBtn.prop('disabled', true); // Disable create button
                    saveBtn.prop('disabled', true); // Disable save button
                    updateBtn.removeAttr('disabled'); // Enable update button
                    destroyBtn.prop('disabled', true); // Disable delete button
                    $('.jq-warning').remove(); // remove warning alert
                },
                error: function(response) {
                    console.log('Error:', response);
                }
            });
        });
    }

    function update() {
        updateBtn.on('click', () => {
            // Retrieve the employeeId from the hidden input field
            const employeeId = $('#employee-id').val();
            $.ajax({
                url: '{{ route('update', ['currentEmployee' => ':id']) }}'.replace(':id', employeeId),
                method: 'PUT',
                data: employeeForm.serialize(), // form data
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        const currentEmployee = response.currentEmployee;
                        const message = response.message;

                        displayAlert(message);

                        // Update the existing table row with the updated employee data
                        const updatedRow = `
                                <tr data-id="${currentEmployee.id}">
                                    <th class="whitespace-nowrap">${currentEmployee.employee_id}</th>
                                    <td class="whitespace-nowrap">${currentEmployee.fname}</td>
                                    <td class="whitespace-nowrap">${currentEmployee.lname}</td>
                                    <td class="whitespace-nowrap">${currentEmployee.birthdate}</td>
                                    <td class="whitespace-nowrap">${currentEmployee.age}</td>
                                    <td class="whitespace-nowrap">${currentEmployee.salary}</td>
                                    <td class="whitespace-nowrap">${currentEmployee.address}</td>
                                    <td>
                                        <button class="text-white btn btn-info btn-sm" type="button" data-id="${currentEmployee.id}" id="edit-btn">
                                            Edit
                                        </button>
                                    </td>
                                    <td>
                                        <button class="text-white btn btn-error btn-sm" type="button" id="delete-btn"
                                            data-id="${currentEmployee.id}">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            `;
                        // Replace the old row with the updated row
                        $(`#jq-tbody tr[data-id="${employeeId}"]`).replaceWith(updatedRow);

                        hiddenMethod.val(''); // Clear the hidden input field

                        resetForm();

                        updateBtn.prop('disabled', true);
                    } else {
                        console.log(response.errors);
                    }
                },
                error: function(response) {
                    displayErrors(response.responseJSON.errors);
                    console.log(response.responseJSON.errors);
                }
            });
        });
    }


    function deleteEmployee() {
        // Attach a delegated event listener to the static parent element #jq-tbody
        $('#jq-tbody').on('click', '#delete-btn', function(e) { // ensures that new added edit button is clickable
            const employeeId = $(this).data('id'); // get data-id of the button
            $('#employee-id').val(employeeId); // Set the employeeId in the hidden input field
            $.ajax({
                url: '{{ route('delete', ['currentEmployee' => ':id']) }}'.replace(':id', employeeId),
                method: 'GET',
                success: function(response) {
                    resetForm();

                    const warning = `
                        <div role="alert" class="absolute w-auto alert -top-24 alert-warning jq-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-current shrink-0" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span>Are you sure you want to delete ${response.fname} info?</span>
                            <div>
                                <button class="btn btn-sm jq-no-btn">No</button>
                            </div>
                        </div>
                    `;

                    $('.jq-form-container').append(warning); // add new warning

                    $('.jq-input').attr('readonly', true);

                    $('.jq-no-btn').on('click', function() {
                        resetForm();
                        destroyBtn.prop('disabled', true);
                        hiddenMethod.val(''); // Clear the hidden input field
                    });

                    $('[name="employee_id"]').val(response.employee_id);
                    $('[name="fname"]').val(response.fname);
                    $('[name="lname"]').val(response.lname);
                    $('[name="birthdate"]').val(response.birthdate);
                    $('[name="age"]').val(response.age);
                    $('[name="salary"]').val(response.salary);
                    $('[name="address"]').val(response.address);
                    $('input').removeAttr('disabled');
                    hiddenMethod.val('DELETE'); // Set method to DELETE for destroy

                    createBtn.prop('disabled', true); // Disable create button
                    saveBtn.prop('disabled', true); // Disable save button
                    updateBtn.prop('disabled', true); // Disable update button
                    destroyBtn.removeAttr('disabled'); // Enable update button
                },
                error: function(response) {
                    console.log('Error:', response);
                }
            });
        });
    }

    function destroy() {
        destroyBtn.on('click', () => {
            // Retrieve the employeeId from the hidden input field
            const employeeId = $('#employee-id').val();
            $.ajax({
                url: '{{ route('destroy', ['currentEmployee' => ':id']) }}'.replace(':id', employeeId),
                method: 'DELETE',
                data: employeeForm.serialize(), // form data
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        const message = response.message;

                        displayAlert(message);

                        $(`#jq-tbody tr[data-id="${employeeId}"]`).remove(); // delete row

                        hiddenMethod.val(''); // Clear the hidden input field

                        resetForm();

                        destroyBtn.prop('disabled', true);
                    } else {
                        console.log(response.errors);
                    }
                },
                error: function(response) {
                    displayErrors(response.responseJSON.errors);
                    console.log(response.responseJSON.errors);
                }
            });
        });
    }



    // UTILITY FUNCTIONS

    function displayErrors(errors) {
        $('.jq-error').remove(); // Remove previous error messages
        $('.input-error').removeClass('input-error'); // Remove previous input-error daisyUi class

        $.each(errors, function(key, messages) { // loop through validation error messages
            // target input element by its name attribute using key from error messages
            const inputField = $(`[name="${key}"]`);
            inputField.addClass('input-error'); // add input-error daisyUi class
            const errorMessage = `
                <div class="label -bottom-7 jq-error">
                    <span class="text-red-600 label-text-alt">
                        ${messages}
                    </span>
                </div>
                `; // generate error message
            inputField.closest('.form-control').append(errorMessage); // put inside label element
        });
    }

    function displayAlert(message) {
        let alertType = '';
        if (message === 'Created Successfully') {
            alertType = 'success';
        } else if (message === 'Updated Successfully') {
            alertType = 'info';
        } else if (message === 'Deleted Successfully') {
            alertType = 'error';
        }

        // create alert message
        const alert = `
            <div role="alert" class="absolute w-auto text-white jq-alert -top-20 alert alert-${alertType}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-current shrink-0" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>${message}</span>
            </div>
        `;

        $('.jq-table-container').append(alert); // append alert

        setTimeout(() => { // remove alert after 3s.
            $('.jq-alert').remove();
        }, 3000);
    }

    function resetForm() {
        $('#employee-form')[0].reset(); // clear the form fields
        $('.jq-error').remove(); // Remove previous error messages
        $('.input-error').removeClass('input-error'); // Remove previous input-error
        $('.jq-input').prop('disabled', true);
        $('.jq-input').removeAttr('readonly');
        createBtn.removeAttr('disabled');
        $('.jq-warning').remove();
    }
</script>
