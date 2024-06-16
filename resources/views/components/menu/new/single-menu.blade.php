 @props(['link' => '#', 'label' => '-', 'icon' => 'ph-dots-three'])

<Link href="{{ $link }}"
    class="flex flex-col gap-2 w-24 p-2 items-center rounded-lg text-center group cursor-pointer group">
    <div class="link-animation">
        <i class="ph-bold {{ $icon }}"></i>
    </div>
    <span class="link-text text-neutral-500 group-hover:text-[greenyellow] transition duration-500 ease-in-out">{{ $label }}</span>
</Link>
