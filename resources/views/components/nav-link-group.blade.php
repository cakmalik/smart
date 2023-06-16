@props(['active' => false, 'main' => 'Drop', 'sub'])

@php
    $classes =
        $active ?? false
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-green-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-green-700 transition duration-150 ease-in-out'
            : 'relative justify-content-center group
 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp
<button {{ $attributes->merge(['class' => $classes]) }}>
    <p class="mr-2">{{ $main }}</p>
    <span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="#000000" viewBox="0 0 256 256">
            <path
                d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z">
            </path>
        </svg></span>
    <div class="absolute hidden group-focus:block top-full min-w-full w-max bg-white shadow-md mt-1 rounded z-50">
        <ul class="text-left border rounded">
            @foreach ($sub as $i)
                <li class="px-4 py-1 hover:bg-gray-100 border-b">
                    <Link href="{{ $i['route'] ?? '' }}">
                    {{ $i['name'] }}
                    </Link>
                </li>
            @endforeach
        </ul>
    </div>
</button>
