@props(['age' => false, 'disabled' => true, 'placeholder' => 'Type here'])

<label class="w-full form-control">
    <div class="label">
        <span class="label-text">{{ $slot }}</span>
    </div>
    <input class="w-full input input-bordered {{ $age ? '' : 'jq-input' }} " placeholder="{{ $placeholder }}"
        {{ $disabled ? 'disabled' : '' }} {{ $attributes }} />
</label>
