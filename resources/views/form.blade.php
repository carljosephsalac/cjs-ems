<form class="flex flex-col gap-1" action="" method="POST" id="employee-form">
    @csrf
    <input type="hidden" id="method" name="_method"> {{-- spoofing, same as @method() --}}
    <div class="flex gap-5">
        <label class="w-full form-control">
            <div class="label">
                <span class="label-text">Employee ID</span>
            </div>
            <input class="w-full js-input input input-bordered {{ $errors->has('employee_id') ? 'input-error' : '' }}"
                name="employee_id" type="number" placeholder="Type here"
                {{ $errors->any() || request()->routeIs('edit') || request()->routeIs('delete') ? '' : 'disabled' }}
                value="{{ old('employee_id', $currentEmployee->employee_id ?? '') }}"
                {{ request()->routeIs('delete') ? 'readonly' : '' }} />
            @error('employee_id')
                <div class="-bottom-7 label">
                    <span class="text-red-600 label-text-alt">{{ $message }}</span>
                </div>
            @enderror
        </label>
        <label class="w-full form-control">
            <div class="label">
                <span class="label-text">First Name</span>
            </div>
            <input class="w-full js-input input input-bordered {{ $errors->has('fname') ? 'input-error' : '' }}"
                name="fname" type="text" placeholder="Type here"
                {{ $errors->any() || request()->routeIs('edit') || request()->routeIs('delete') ? '' : 'disabled' }}
                value="{{ old('fname', $currentEmployee->fname ?? '') }}"
                {{ request()->routeIs('delete') ? 'readonly' : '' }} />
            @error('fname')
                <div class="label -bottom-7">
                    <span class="text-red-600 label-text-alt">{{ $message }}</span>
                </div>
            @enderror
        </label>
    </div>
    <div class="flex gap-5">
        <label class="w-full form-control">
            <div class="label">
                <span class="label-text">Last Name</span>
            </div>
            <input class="w-full js-input input input-bordered {{ $errors->has('lname') ? 'input-error' : '' }}"
                name="lname" type="text" placeholder="Type here"
                {{ $errors->any() || request()->routeIs('edit') || request()->routeIs('delete') ? '' : 'disabled' }}
                value="{{ old('lname', $currentEmployee->lname ?? '') }}"
                {{ request()->routeIs('delete') ? 'readonly' : '' }} />
            @error('lname')
                <div class="label -bottom-7">
                    <span class="text-red-600 label-text-alt">{{ $message }}</span>
                </div>
            @enderror
        </label>
        <label class="w-full form-control">
            <div class="label">
                <span class="label-text">Birthdate</span>
            </div>
            <input class="w-full js-input input input-bordered {{ $errors->has('birthdate') ? 'input-error' : '' }}"
                name="birthdate" type="date" placeholder="Type here"
                {{ $errors->any() || request()->routeIs('edit') || request()->routeIs('delete') ? '' : 'disabled' }}
                value="{{ old('birthdate', $currentEmployee->birthdate ?? '') }}"
                {{ request()->routeIs('delete') ? 'readonly' : '' }} />
            @error('birthdate')
                <div class="label -bottom-7">
                    <span class="text-red-600 label-text-alt">{{ $message }}</span>
                </div>
            @enderror
        </label>
    </div>
    <div class="flex gap-5">
        <label class="w-full form-control">
            <div class="label">
                <span class="label-text">Age (auto)</span>
            </div>
            <input class="w-full input input-bordered {{ $errors->has('age') ? 'input-error' : '' }}" name="age"
                type="number" placeholder="Auto calculate" value="{{ $currentEmployee->age ?? '' }}" readonly />
        </label>
        <label class="w-full form-control">
            <div class="label">
                <span class="label-text">Salary</span>
            </div>
            <input class="w-full js-input input input-bordered {{ $errors->has('salary') ? 'input-error' : '' }}"
                name="salary" type="number" placeholder="Type here"
                {{ $errors->any() || request()->routeIs('edit') || request()->routeIs('delete') ? '' : 'disabled' }}
                value="{{ old('salary', $currentEmployee->salary ?? '') }}"
                {{ request()->routeIs('delete') ? 'readonly' : '' }} />
            @error('salary')
                <div class="label -bottom-7">
                    <span class="text-red-600 label-text-alt">{{ $message }}</span>
                </div>
            @enderror
        </label>
    </div>
    <label class="w-full form-control">
        <div class="label {{ $errors->has('salary') ? 'pt-0' : '' }}">
            <span class="label-text">Address</span>
        </div>
        <input class="w-full js-input input input-bordered {{ $errors->has('address') ? 'input-error' : '' }}"
            name="address" type="text" placeholder="Type here"
            {{ $errors->any() || request()->routeIs('edit') || request()->routeIs('delete') ? '' : 'disabled' }}
            value="{{ old('address', $currentEmployee->address ?? '') }}"
            {{ request()->routeIs('delete') ? 'readonly' : '' }} />
        @error('address')
            <div class="label -bottom-7">
                <span class="text-red-600 label-text-alt">{{ $message }}</span>
            </div>
        @enderror
    </label>
    <div class="flex justify-center gap-3 my-3">
        <a class="hidden btn btn-primary btn-sm" id="home-btn" href="{{ route('showHome') }}">
            Create
        </a>
        <button class="btn btn-primary btn-sm" type="button" id="create-btn">
            Create
        </button>
        <button class="text-white btn btn-success btn-sm js-buttons" id="save-btn" type="button"
            {{ $errors->any() && request()->routeIs('showHome') ? '' : 'disabled' }}>
            Save
        </button>
        <button class="text-white btn btn-info btn-sm js-buttons" type="button" id="update-btn"
            {{ request()->routeIs('edit') ? '' : 'disabled' }}>
            Update
        </button>
        <button class="text-white btn btn-error btn-sm js-buttons" type="button" id="delete-btn"
            {{ request()->routeIs('delete') ? '' : 'disabled' }}>
            Delete
        </button>
    </div>
</form>
