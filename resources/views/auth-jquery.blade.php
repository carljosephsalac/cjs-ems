<script>
    showRegister();
    showLogin();
    signUp();
    signIn()

    function showRegister() {
        $(document).on('click', '.jq-show-register', function() {
            const register = `
                <div class="jq-login-form relative flex justify-center w-[500px] px-8 py-3 bg-white rounded-lg shadow-md">
                    <form class="w-full" action="" method="POST" id="sign-up-form">
                        @csrf
                        <div class="flex flex-col gap-5 ">
                            <x-input class="relative" name="fname" type="text" :disabled="false">First Name</x-input>
                            <x-input class="relative" name="lname" type="text" :disabled="false">Last Name</x-input>
                            <x-input class="relative" name="email" type="email" :disabled="false">Email</x-input>
                            <x-input class="relative" name="password" type="password" :disabled="false">Password</x-input>
                            <x-input class="relative" name="password_confirmation" type="password" :disabled="false">Confirm Password</x-input>
                            <div class="flex flex-wrap justify-end gap-3 my-3">
                                <button class="text-white jq-sign-up btn btn-success btn-sm" type="button">
                                    Sign up
                                </button>
                                <button class="jq-show-login link link-info" type="button">
                                    Already have an account?
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            `;
            $('.jq-login-form').replaceWith(register);
        });
    }

    function showLogin() {
        $(document).on('click', '.jq-show-login', function() {
            const login = `
                <div class="jq-login-form relative flex justify-center w-[500px] px-8 py-3 bg-white rounded-lg shadow-md">
                    <form class="w-full" action="" method="POST" id="sign-in-form">
                        @csrf
                        <div class="flex flex-col gap-5 ">
                            <x-input class="relative" name="email" type="email" :disabled="false">Email</x-input>
                            <x-input class="relative" name="password" type="password" :disabled="false">Password</x-input>
                            <div class="flex flex-wrap justify-end gap-3 my-3">
                                <button class="text-white jq-sign-in btn btn-success btn-sm" type="button">
                                    Sign in
                                </button>
                                <button class="jq-show-register link link-info" type="button">
                                    Don't have an account?
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            `;
            $('.jq-login-form').replaceWith(login);
        });
    }

    function signUp() {
        $(document).on('click', '.jq-sign-up', function() {
            $.ajax({
                type: "POST",
                url: "{{ route('auth.store') }}",
                data: $('#sign-up-form').serialize(),
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        window.location.href = response.redirect;
                    } else {
                        console.error(response.errors);
                    }
                },
                error: function(response) {
                    displayErrors(response.responseJSON.errors);
                    console.log(response.responseJSON.errors);
                }
            });
        });
    }

    function signIn() {
        $(document).on('click', '.jq-sign-in', function() {
            console.log('sdfds');
            $.ajax({
                type: "POST",
                url: "{{ route('auth.login') }}",
                data: $('#sign-in-form').serialize(),
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        window.location.href = response.redirect;
                    } else {
                        console.error(response.errors);
                    }
                },
                error: function(response) {
                    displayErrors(response.responseJSON.errors);
                    $('#sign-in-form').find('input[name="password"]').val('');
                    console.log(response.responseJSON.errors);
                }
            });
        });
    }


    function displayErrors(errors) {
        $('.jq-error').remove(); // Remove previous error messages
        $('.input-error').removeClass('input-error'); // Remove previous input-error daisyUi class

        $.each(errors, function(key, messages) { // loop through validation error messages
            // target input element by its name attribute using key from error messages
            const inputField = $(`[name="${key}"]`);
            inputField.addClass('input-error'); // add input-error daisyUi class
            const errorMessage = `
                <div class="absolute label -bottom-7 jq-error">
                    <span class="text-red-600 label-text-alt">
                        ${messages}
                    </span>
                </div>
                `; // generate error message
            inputField.closest('.form-control').append(errorMessage); // put inside label element
        });
    }
</script>
