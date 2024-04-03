@props(['name'])
<i {{ $attributes->merge(['class' => 'ph ph-' . $name]) }}></i>