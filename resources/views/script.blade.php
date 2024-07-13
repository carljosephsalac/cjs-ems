<script>
    const homeBtn = $('#home-btn');
    const createBtn = $('#create-btn');
    const saveBtn = $('#save-btn');
    const updateBtn = $('#update-btn');
    const deleteBtn = $('#delete-btn');

    /* Show and hide create and home button */
    if (updateBtn.prop('disabled') || deleteBtn.prop('disabled')) { // if either the update or delete button is disabled
        createBtn.removeClass('hidden');
        homeBtn.addClass('hidden');
        createBtn.on('click', function() { // enable all input fields with the class when clicked
            $('.js-input').each(function() {
                $(this).removeAttr('disabled');
            });
            saveBtn.removeAttr('disabled');
            createBtn.prop('disabled', true);
        });
    }

    // if both the update and delete buttons are not disabled
    if (!updateBtn.prop('disabled') || !deleteBtn.prop('disabled')) {
        homeBtn.removeClass('hidden');
        createBtn.addClass('hidden');
    }

    // disable create button if save button is not disabled using guard && operator instead of if else
    if (!saveBtn.prop('disabled')) {
        createBtn.prop('disabled', true);
    }

    /* remove alerts after 3 seconds */
    $('.js-alert').each(function(_, element) {
        setTimeout(() => {
            $(element).remove();
        }, 3000);
    });

    /* handle form submission based on which button is clicked */

    // Get the current employee ID from the Blade template and assign it to a JavaScript variable
    const currentEmployeeId = "{{ $currentEmployee->id ?? '' }}";
    const employeeForm = $('#employee-form');
    const method = $('#method'); // hidden input for HTTP method

    $('.js-buttons').each(function(_, button) {
        $(button).on('click', function() {
            const btnText = $(button).text().trim();
            if (btnText === 'Save') {
                employeeForm.attr('action', '{{ route('store') }}');
                method.val('POST');
            } else if (btnText === 'Update') {
                employeeForm.attr('action',
                    '{{ route('update', ['currentEmployee' => ':currentEmployeeId']) }}'
                    .replace(':currentEmployeeId', currentEmployeeId));
                method.val('PUT');
            } else if (btnText === 'Delete') {
                employeeForm.attr('action',
                    '{{ route('destroy', ['currentEmployee' => ':currentEmployeeId']) }}'
                    .replace(':currentEmployeeId', currentEmployeeId));
                method.val('DELETE');
            }
            employeeForm.submit();
        });
    });
</script>


{{-- <script>
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
</script> --}}
