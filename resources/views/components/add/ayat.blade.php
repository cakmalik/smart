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
            <div class="mb-5 p-3">
                <h1 class=" text-2xl text-gray-900 text-center leading-loose font-amiri">
                    {{ $rand['ayat'] }}
                </h1>

                <p class="mt-3 text-gray-700 leading-relaxed coba text-center italic">
                    {{ $rand['arti'] }}
                </p>

                <p class=" text-gray-500 text-center text-sm">
                    @isset($rand['surat'])
                        ({{ $rand['surat'] . ' : ' . $rand['ayat_ke'] }})
                    @endisset
                </p>
            </div>
        @endif
    </x-splade-lazy>
