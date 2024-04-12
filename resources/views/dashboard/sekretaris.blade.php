<x-add.ayat />
<div class="grid grid-cols-1 md:grid-cols-4 gap-2">
    <Link href="{{ route('student.new') }}">
        <x-card.summary title="Santri Baru" value="453" color="atlantis" />
    </Link>
    <Link href="{{ route('student.new') }}">
            <x-card.summary title="Total Santri " value="453" color="danube" />
    </Link>
    <Link href="{{ route('student.new') }}">
        <x-card.summary title="Menunggu persetujuan" value="453" color="chilean" />
    </Link>
    <Link href="{{ route('student.new') }}">
        <x-card.summary title="Mutasi" value="453" color="mantis" />
    </Link>
</div>
{{-- statistic --}}
