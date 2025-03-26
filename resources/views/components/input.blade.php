@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-gray-300 focus:border-[#00A7E1] focus:ring-[#00A7E1] rounded-md shadow-sm',
]) !!}>
