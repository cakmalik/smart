@props(['label' => '-', 'id' => uniqid(), 'icon' => 'ph-dots-three'])
<div class="">
    <button id="dropdownHoverButton{{ $id }}" data-dropdown-toggle="dropdownHover{{ $id }}"
        data-dropdown-trigger="hover" type="button"
        class="flex flex-col gap-2 w-24 p-2 items-center rounded-lg text-center group cursor-pointer ">
        <div
            class="link-animation">
            <i
                class="ph-bold {{ $icon }} "></i>
        </div>
        <div class="text-neutral-500 group-hover:text-[greenyellow] transition duration-500 ease-in-out">
            {{ $label }} 
            <i class="ph ph-caret-down text-sm scale-90"></i>
        </div>
    </button>
    <div id="dropdownHover{{ $id }}"
        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
            aria-labelledby="dropdownHoverButton{{ $id }}">
            {{ $slot }}
        </ul>
    </div>
</div>
