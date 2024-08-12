<nav class="fixed z-10 shadow-md navbar bg-base-100">
    <div class="flex-1">
        <a class="text-xl btn btn-ghost">
            <span class="hidden sm:inline">Employee Management System</span>
            <span class="inline sm:hidden">EMS</span>
        </a>
    </div>
    <div class="flex-none">
        <ul class="px-1 menu menu-horizontal">
            <li>
                <details>
                    <summary>
                        <span class="sm:inline">{{ Auth::user()->fname }}</span>
                    </summary>
                    <ul class="w-full p-2 rounded-t-none bg-base-100">
                        <li class="flex justify-center">
                            <form action="{{ route('auth.logout') }}" method="POST"
                                class="flex justify-center px-0 text-center" onsubmit="disableSubmitButton(this)">
                                @csrf
                                <button class="w-full" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </details>
            </li>
        </ul>
    </div>
</nav>
