@props(['label' => '-', 'cols' => 1, 'id' => rand(0, 9999)])

<li>
    <button id="mega-menu-icons-dropdown-button" data-dropdown-toggle="mega-menu-icons-dropdown-{{ $id }}"
        class="flex items-center justify-between w-full py-2 px-3 font-medium text-gray-500 border-b border-gray-100 md:w-auto hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700">
        {{ $label }}
        <svg class="w-2.5 h-2.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 4 4 4-4" />
        </svg>
    </button>
    <div id="mega-menu-icons-dropdown-{{ $id }}"
        class="absolute z-10 grid hidden w-auto grid-cols-{{ $cols }} text-sm bg-white border border-gray-100 rounded-lg shadow-md dark:border-gray-700 md:grid-cols-{{ $cols }} dark:bg-gray-700">
        {{ $slot }}
    </div>
</li>
