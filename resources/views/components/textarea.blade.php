@props([
    'id' => '',
    'name' => '',
    'label' => '',
    'placeholder' => '',
    'value' => '',
    'parent_class' => 'col-6',
    'is_edit' => false,
])

<div class="{{ $parent_class }}">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <textarea class="form-control @error($name) is-invalid @enderror" id="{{ $id }}" name="{{ $name }}"
        placeholder="{{ $placeholder }}" aria-describedby="{{ $id }}Help"
        value="{{ $is_edit ? $value : old($name) }}">{!! $is_edit ? $value : old($name) !!}</textarea>


    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
