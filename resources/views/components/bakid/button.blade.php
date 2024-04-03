@props(['size' => 'md', 'color' => 'primary', 'leading' => '', 'trailing' => '', 'label' => ''])
<div>
    <button
        {{ $attributes->merge(['class' => 'bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-full']) }}>
        <div class="flex gap-1 items-center">
            {{ $leading }}
            {{ $label }}
            {{ $trailing }}
        </div>
    </button>
</div>
