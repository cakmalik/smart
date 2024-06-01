@props(['link' => '#', 'label' => '-', 'icon' => null])
<li>
    <Link href="{{ $link }}"
        class="block px-4 py-1 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
        <span class="sr-only">{{ __($label) }}</span>
        {{-- @if ($icon != null)
            <i class="text-sm me-2 ph {{ $icon }}"></i>
        @endif --}}
        {{ __($label) }}
    </Link>
</li>
