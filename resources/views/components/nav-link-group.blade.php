@props(['main' => '', 'items' => ''])

@php
    $classes = $active ?? false ? 'inline-flex items-center px-1 pt-1 border-b-2 border-green-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-green-700 transition duration-150 ease-in-out' : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp
<button {{ $attributes->merge(['class' => $classes]) }}>
    <x-splade-dropdown>
        <x-slot:trigger>
            <span class="inline-flex">
                <button type="button"
                    class="inline-flex items-center py-6 border border-transparent text-sm leading-4 font-medium text-gray-500 hover:text-gray-700 transition ease-in-out duration-150">
                    <span class="mr-2">{{ $main }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="#000000"
                        viewBox="0 0 256 256">
                        <path
                            d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z">
                        </path>
                    </svg>
                </button>
            </span>
            </x-slot>
            <div class="w-48 mt-2 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 py-1 bg-white">
                @foreach ($items as $i)
                    <x-dropdown-link :href="$i['link']">
                        {{ __($i['name']) }}
                    </x-dropdown-link>
                @endforeach
            </div>
    </x-splade-dropdown>
</button>
