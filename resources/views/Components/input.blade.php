@props(['error' => '', 'name' => '', 'data' => '', 'disabled' => 'disabled'])

@php
    $hasError = $errors->has($name) ? ' input-error' : '';
    // $isDisabled = $errors->any() ? '' : 'disabled';
@endphp

<label {{ $attributes->merge(['class' => 'w-full form-control']) }}>
    <div class="label">
        {{-- <span class="label-text {{ $errors->has($name) ? 'text-red-600' : '' }}">{{ $slot }}</span> --}}
        <span class="label-text ">{{ $slot }}</span>
    </div>
    <input name="{{ $name }}"
        {{ $attributes->merge([
            'placeholder' => 'Type here',
            'readonly',
            'class' => 'jq-input w-full input input-bordered' . $hasError,
        ]) }}
        value="{{ old($name, $data) }}" autocomplete="on" {{ $errors->any() ? '' : $disabled }} />
    @error($name)
        <div class="label -bottom-7 jq-error">
            <span class="text-red-600 label-text-alt">
                {{ $message }}
            </span>
        </div>
    @enderror
</label>
