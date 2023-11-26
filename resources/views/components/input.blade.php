@props([
    'disabled' => false,
    'name' =>'',
    'label' => '',
    'placeholder' => '',
    'type' => 'text',
    'id' => '',
    'name' => '',
    'value' => '',
    'parent_class'=>'col-6',
    'is_edit'=>false,
])

<div class="{{$parent_class}}">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" class="form-control @error($name) is-invalid @enderror" id="{{ $id }}"
        name="{{ $name }}" placeholder="{{ $placeholder }}" aria-describedby="{{ $id }}Help"
        value="{{ $is_edit ? $value : old($name) }}"
        />

    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
