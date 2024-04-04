@props(['size' => 'md', 'level' => 'primary', 'leading' => '', 'trailing' => '', 'label' => ''])

@php
// Tentukan kelas tambahan berdasarkan level
$levelClasses = [
    'primary' => 'bg-primary-500 hover:bg-primary-600',
    'danger' => 'bg-red-500 hover:bg-red-600',
    // Anda dapat menambahkan lebih banyak level sesuai kebutuhan Anda
];

// Ambil kelas tambahan berdasarkan level yang dipilih atau gunakan kelas default jika tidak ada yang cocok
$levelClass = $levelClasses[$level] ?? $levelClasses['primary'];
@endphp

<div>
    <button
        {{ $attributes->merge(['class' => $levelClass . ' text-white font-bold py-2 px-4 rounded-full']) }}>
        <div class="flex gap-1 items-center">
            {{ $leading }}
            {{ $label }}
            {{ $trailing }}
        </div>
    </button>
</div>
