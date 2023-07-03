<Link href="{{ $link }}" class="my-auto w-full h-full hover hover:bg-lime-200 hover:overflow-hidden">
<div class="flex flex-col items-center justify-center rounded cursor-pointer py-5  border-t">
    {{ $slot }}
    <h4 class="text-base text-gray-500">{{ $label }}</h4>
</div>
</Link>
