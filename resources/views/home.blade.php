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
        @include('navbar')

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
                    @include('form')
                </div>
            </section>

            <section class="flex items-center justify-center w-1/2 px-10">
                <div class="relative flex justify-center w-full py-3 bg-white rounded-lg shadow-md h-fit">
                    @include('alerts')
                    @include('table')
                </div>
            </section>
        </main>
    </div>

    @include('script')
</body>

</html>
