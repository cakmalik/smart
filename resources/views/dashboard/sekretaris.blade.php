{{-- <x-add.ayat /> --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-2">
    <Link href="{{ route('student.new') }}">
        <x-card.summary title="Santri Baru" :value="$summary['new_students']" color="atlantis" />
    </Link>
    <Link href="{{ route('student.index') }}">
            <x-card.summary title="Santri {{ auth()->user()->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}" :value="$summary['students']" color="danube" />
    </Link>
    <Link href="{{ route('student.new') }}">
        <x-card.summary title="Menunggu persetujuan" :value="$summary['approval']" color="chilean" />
    </Link>
    <Link href="{{ route('invoice.index') }}">
        <x-card.summary title="Tagihan" :value="$summary['mutation']" color="mantis" />
    </Link>
</div>
{{-- statistic --}}
