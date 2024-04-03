@props(['size' => 'md', 'color' => 'primary'])
<div>
    <button
        {{ $attributes->merge(['class' => 'bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-full']) }}>
        <div class="flex gap-3 items-center">
            {{ $leading ?? '' }}
            <span>Button</span>
            {{ $trailing ?? '' }}
        </div>
    </button>
</div>
