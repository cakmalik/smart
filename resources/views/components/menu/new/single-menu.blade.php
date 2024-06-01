@props(['link' => '#', 'label' => '-', 'icon' => 'ph-dots-three'])
<Link href="{{ $link }}"
    class="flex flex-col gap-2 w-24 p-2 items-center rounded-lg text-center group cursor-pointer ">
<div
    class="w-12 h-12  rounded-full flex items-center justify-center bg-white group-hover:bg-green-500 transition duration-300 ease-in-out">
    <i
        class="ph-bold {{ $icon }} text-neutral-500 group-hover:text-white transition duration-300 ease-in-out"></i>
</div>
<span class="text-neutral-200 text-center text-sm group-hover:text-white  transition duration-300 ease-in-out">
    {{ $label }}
</span>
</Link>
