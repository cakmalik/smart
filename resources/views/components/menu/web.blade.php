@props(['link' => '#', 'label' => '-', 'icon' => null])
{{-- <Link href="{{ $link }}" class="my-auto w-full h-full hover hover:bg-lime-200 hover:overflow-hidden">
<div class="flex flex-col items-center justify-center rounded cursor-pointer py-5  border-t">
    {{ $slot }}
    <h4 class="text-base text-gray-500">{{ $label }}</h4>
</div>
</Link> --}}


<li>
    <a href="{{ $link }}"
        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group">
        <span class="sr-only">{{ __($label) }}</span>
        @if ($icon != null)
            <i class="text-sm ph-fill me-2 {{ $icon }}"></i>
        @endif
        {{ __($label) }}
    </a>
</li>
