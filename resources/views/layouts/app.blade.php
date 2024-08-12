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
        @include('layouts.navbar')

        <main
            class="flex flex-col xl:flex-row justify-center px-3 md:px-5 lg:px-8 flex-grow xl:pt-[68px] pt-[160px] items-center gap-20 pb-10 min-h-screen">

            @yield('content')

            @include('layouts.table')
        </main>
    </div>
    <script>
        function disableSubmitButton(event) { // Function to disable the submit button
            const $form = $(event.target);
            const $submitButton = $form.find('[type="submit"]');
            $submitButton.prop('disabled', true);
        }
        $('form').on('submit', disableSubmitButton); // Attach the submit event listener to all forms

        let alertTimeout; // Variable to store the timeout ID
        if (alertTimeout) { // Clear the previous timeout if it exists

            clearTimeout(alertTimeout);
        }
        alertTimeout = setTimeout(() => { // Set a new timeout to remove the alert after 3 seconds
            $('.jq-alert').remove();
        }, 3000);
    </script>
</body>

</html>
