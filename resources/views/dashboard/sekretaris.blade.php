{{-- <x-add.ayat /> --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-2 mx-4 sm:mx-0">
    <Link href="{{ route('student.new') }}">
    <x-card.summary title="Pendaftar" :value="$summary['pendaftar']" color="atlantis" />
    </Link>
    <Link href="{{ route('student.index') }}">
    <x-card.summary title="Santri Laki" :value="$summary['student_l_count']" color="chilean" />
    </Link>
    <Link href="{{ route('student.index') }}">
    <x-card.summary title="Santri Perempuan" :value="$summary['student_p_count']" color="danube" />
    </Link>
    <Link href="{{ route('invoice.index') }}">
    <x-card.summary title="Tagihan" :value="$summary['mutation']" color="mantis" />
    </Link>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-2 mt-3  mx-4 sm:mx-0">
    <Link href="/student?filter[verified_at]={{ date('Y') }}" class="bg-slate-200 rounded-lg p-3">
    <div class="flex flex-col gap-2">
        <div class="flex justify-between items-center"><span>PSB {{ date('Y') }}</span> <span
                class="bg-yellow-400 text-white text-xs p-1 rounded font-semibold">BELUM LUNAS</span></div>
        <div class="text-3xl font-bold">Rp{{ number_format($summary['psb_unpaid_amount']) }} <span
                class="text-xl font-light"></span></div>
    </div>

    </Link>
    <Link href="/student?filter[verified_at]={{ date('Y') }}" class="bg-slate-200 rounded-lg p-3">
    <div class="flex flex-col gap-2">
        <div class="flex justify-between items-center"><span>PSB {{ date('Y') }}</span> <span
                class="bg-green-400 text-white text-xs p-1 rounded font-semibold">LUNAS</span></div>
        <div class="text-3xl font-bold">Rp{{ number_format($summary['psb_paid_amount']) }}<span
                class="text-xl font-light"> / {{ $summary['psb_paid_count'] }}</span></div>
    </div>
    </Link>
    <Link href="/student?filter[verified_at]={{ date('Y') }}" class="bg-slate-200 rounded-lg p-3">
    <div class="flex flex-col gap-2">
        <div class="flex justify-between items-center"><span>PSB {{ date('Y') }}</span> <span
                class="bg-slate-800 text-white text-xs p-1 rounded font-semibold">SANTRI BARU</span></div>
        <div class="text-3xl font-bold flex justify-between items-center">
            <span class="text-xl font-light">Laki-laki</span>
            <div class="">{{ $summary['psb_student_count'] }}</div>
        </div>
    </div>
    </Link>
</div>
{{-- statistic --}}
