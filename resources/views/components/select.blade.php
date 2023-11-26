@props([
    'options' => [],
    'selected' => null,
    'label' => '',
    'placeholder' => '',
    'name' => '',
    'parent_class' => 'col-6',
    'is_db' => false,
])


<div class="{{ $parent_class }}">
    <label for="{{ $attributes['id'] }}" class="form-label">{{ $label ?? 'Select' }}</label>
    <select class=" form-select @error($name)
    is-invalid    @enderror"
        {{ $attributes->merge(['class' => 'form-select']) }} name="{{ $name }}"
        aria-label="Default select example">
        <option value="" selected>{{ $placeholder }}</option>
        @if ($is_db)
            @foreach ($options as $option)
                <option value="{{ $option['value'] }}" {{ $selected == $option['value'] ? 'selected' : '' }}>
                    {{ $option['label'] }}
                </option>
            @endforeach
        @else
            @foreach ($options as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        @endif
    </select>

    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

</div>
