@props([
    'text' => 'Button',
    'style' => 'primary',
    'type' => 'button',
    'id' => '',
    'parent_class' => 'col-6',
    'disabled' => false,
])


<button class="btn btn-{{ $style }}" type="{{$type}}" id="{{ $id }}"
    {{ $attributes->merge(['class' => 'form-control'])}}

>{{ $text }}</button>
