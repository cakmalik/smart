<div class="mx-auto max-w-xl p-6 lg:p-8 border-b border-gray-200">
    <div class="flex justify-center">
        <x-application-logo class="block h-12 w-auto mx-auto" />
    </div>
    @if (auth()->user()->students->count() == 0 &&
            !auth()->user()->isAdmin())
        <h1 class="mt-8 text-2xl font-medium text-gray-900 text-center">
            Assalamualaikum, {{ Auth::user()->name }}'s Family
        </h1>

        <p class="mt-6 text-gray-700 leading-relaxed text-center">
            kami informasikan bahwa satu akun orang tua bisa memiliki/memantau
            semua anggota keluarga yang terdaftar sebagai santri di pesantren kami.
        </p>
    @else
        <x-splade-lazy>
            @php
                $rand = getRandomAyat();
            @endphp
            <x-slot:placeholder>
                <p class="text-center my-16">
                    <span class="animate-pulse font-bold text-2xl"> . </span>
                    <span class="animate-pulse font-bold text-2xl" style="animation-delay: 0.3s"> . </span>
                    <span class="animate-pulse font-bold text-2xl" style="animation-delay: 0.6s"> . </span>
                </p>
            </x-slot:placeholder>

            @if ($rand != null)
                <h1 class="mt-8 text-xl text-gray-900 text-center leading-loose">
                    {{ $rand['ayat'] }}
                </h1>

                <p class="mt-6 text-gray-700 leading-relaxed coba text-center italic">
                    {{ $rand['arti'] }}
                </p>

                <p class=" text-gray-500 text-center text-sm">
                    @isset($rand['surat'])
                        ({{ $rand['surat'] . ' : ' . $rand['ayat_ke'] }})
                    @endisset
                </p>
            @endif
        </x-splade-lazy>
    @endif
</div>


@if (Auth::user()->students->count() == 0 &&
        !auth()->user()->isAdmin())
    <div class="backdrop-blur-md gap-6 lg:gap-8 p-6 lg:p-8 mx-auto max-w-lg">
        <div>
            <h2 class="ml-3 text-xl font-semibold text-gray-900 text-center">
                <a href="{{ route('student.create') }}">Daftarkan Sekarang</a>
            </h2>

            <p class="mt-4 text-gray-900 text-base leading-relaxed text-center">
                @if (Auth::user()->students->count() == 0)
                    Anda terdeteksi belum mendaftarkan putra/putri anda sebagai santri di pesantren kami, silahkan
                    daftarkan
                @endif
            </p>


            <p class="mt-4 text-base text-center">
                <Link href="{{ route('student.create') }}"
                    class="inline-flex items-center font-semibold text-white px-10 py-3 rounded-full bg-green-500 animate-pulse">
                Mendaftar

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5 fill-white">
                    <path fill-rule="evenodd"
                        d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z"
                        clip-rule="evenodd" />
                </svg>
                </Link>
            </p>
        </div>
    </div>
@endif
