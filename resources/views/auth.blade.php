<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Authentication</title>
    <link rel="icon" type="image/x-icon" href="{{ Vite::asset('resources/images/employee.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('jquery.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
</head>

<body>
    <div class="flex flex-col items-center justify-center min-h-screen gap-8 px-3 py-5 bg-gray-200">
        <header class="text-5xl sm:text-6xl jq-header">Login</header>
        <div
            class="relative flex justify-center w-full px-5 py-3 bg-white rounded-lg shadow-md jq-login-form max-w-[450px]">
            <form class="w-full" action="" method="POST" id="sign-in-form">
                @csrf
                <div class="flex flex-col gap-5 ">
                    <x-input class="relative" name="email" type="email" disabled="">Email</x-input>
                    <x-input class="relative" name="password" type="password" disabled="">Password</x-input>
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
    </div>

    @include('auth-jquery')
</body>

</html>
