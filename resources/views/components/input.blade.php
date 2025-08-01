@props([
    'label',
    'name',
    'type' => 'text',
    'value' => '',
    'required' => false,
    'autofocus' => false,
])

<label for="{{ $name }}">{{ $label }}:</label><br>
<input
    type="{{ $type }}"
    name="{{ $name }}"
    id="{{ $name }}"
    value="{{ old($name, $value) }}"
    {{ $required ? 'required' : '' }}
    {{ $autofocus ? 'autofocus' : '' }}
    {{ $attributes->merge(['class' => '']) }}
><br>
@error($name)
    <div class="error">{{ $message }}</div>
@enderror
<br>
