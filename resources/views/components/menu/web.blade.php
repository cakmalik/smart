@props(['mega' => false, 'link' => '#', 'label' => '-', 'icon' => null])
{{-- <Link href="{{ $link }}" class="my-auto w-full h-full hover hover:bg-lime-200 hover:overflow-hidden">
<div class="flex flex-col items-center justify-center rounded cursor-pointer py-5  border-t">
    {{ $slot }}
    <h4 class="text-base text-gray-500">{{ $label }}</h4>
</div>
</Link> --}}

@if (!$mega)
    @if (!$icon)
        <li>
            <Link href="{{ $link }}"
                class="block py-2 px-3 text-blue-600 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-blue-500 md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700"
                aria-current="page">
            {{ __($label) }}
            </Link>
        </li>
    @else
        <li>
            <a href="{{ $link }}"
                class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="sr-only">{{ __($label) }}</span>
                <i class="ph {{ $icon }} me-2"></i>
                {{ __($label) }}
            </a>
        </li>
    @endif
@else
    <li id="menuu">
        <x-splade-toggle>
            <button  @click.prevent="toggle"
                class="flex items-center justify-between w-full py-2 px-3 font-medium text-gray-900 border-b border-gray-100 md:w-auto hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700">
                {{ __($label) }}
                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <div id="mega-menu-icons-dropdown"
                class="absolute z-10 grid w-auto grid-cols-2 text-sm bg-white border border-gray-100 rounded-lg shadow-md dark:border-gray-700 md:grid-cols-3 dark:bg-gray-700"
                :class="{'hidden': !toggled, '': toggled}"
                >
                {{ $slot }}
            </div>
        </x-splade-toggle>
    </li>
@endif

<x-splade-script>
    document.addEventListener('click', function(event) {
        //if not exists hidden class, add it
        var megaMenuIconsDropdown = document.getElementById('mega-menu-icons-dropdown');
        if (!megaMenuIconsDropdown.classList.contains('hidden')) {
            megaMenuIconsDropdown.classList.add('hidden');
        }
    });
    
    var megaMenuIconsDropdown = document.getElementById('menuu');
    megaMenuIconsDropdown.addEventListener('click', function(event) {
        event.stopPropagation();
    });
    
</x-splade-script>
