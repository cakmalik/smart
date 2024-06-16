@props(['title' => '', 'value' => '', 'color' => 'atlantis'])

@php
    // Daftar warna yang valid untuk digunakan
    $colors = [
        'atlantis' => [
            'text' => 'atlantis-800',
            'bg' => 'bg-atlantis-200',
        ],
        'danube' => [
            'text' => 'danube-800',
            'bg' => 'bg-danube-200',
        ],
        'chilean' => [
            'text' => 'chilean-800',
            'bg' => 'bg-chilean-200',
        ],
        'mantis' => [
            'text' => 'mantis-800',
            'bg' => 'bg-mantis-200',
        ],

        // Tambahkan warna lain di sini jika diperlukan
    ];

    // Pastikan warna yang dipilih ada dalam daftar yang valid
    $textColorClass = $colors[$color]['text'] ?? 'atlantis-800';
    $bgColorClass = $colors[$color]['bg'] ?? 'bg-atlantis-200';
@endphp

<div {{ $attributes->class(['p-4 rounded-lg shadow', $bgColorClass]) }}>
    <div class="flex items-center justify-between text-center">
        <div class="text-lg font-medium text-neutral-600">
            {{ $title }}
        </div>
        <div class="text-lg font-medium text-{{ $textColorClass }}">
            {{ $value }}
        </div>
    </div>
</div>
