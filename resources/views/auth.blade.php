<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Authentication</title>
    @vite('resources/css/app.css')
    <script src="{{ asset('jquery.js') }}"></script>
</head>

<body>
    <div class="flex items-center justify-center h-screen px-3 bg-gray-200">
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
    </div>

    @include('auth-jquery')
</body>

</html>
