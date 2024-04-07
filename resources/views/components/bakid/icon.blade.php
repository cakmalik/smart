@props(['name', 'variant' => 'regular', 'size' => 'md', 'color' => 'black'])
@php
    switch ($variant) {
        case 'fill':
            $variant_name = 'ph-fill';
            break;

        case 'duotone':
            $variant_name = 'ph-duotone';
            break;

        default:
            $variant_name = 'ph';
            break;
    }
@endphp

<i {{ $attributes->merge(['class' => $variant_name . ' ph-' . $name . ' ' . $size . ' text-' . $color]) }}></i>
