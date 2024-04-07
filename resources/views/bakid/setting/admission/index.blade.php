@seoTitle(__('Settings'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl capitalize">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-12 px-4 max-w-7xl mx-auto sm:px-6 lg:px-8 grid sm:grid-cols-3">
        <x-bakid.card>
            <x-slot:header>
                <div class="flex items-center justify-between">
                    <span>Pendaftaran Aktif</span>
                    <Link href="#admissions">
                    <x-bakid.icon name="pencil" variant="duotone" />
                    </Link>
                </div>
            </x-slot:header>

            @if ($active_admission)
                <table>
                    <tr>
                        <td class="px-2">Gelombang</td>
                        <td class="px-2">:</td>
                        <td class="px-2">{{ $active_admission->batch }}</td>
                    </tr>
                    <tr>
                        <td class="px-2">Periode</td>
                        <td class="px-2">:</td>
                        <td class="px-2">{{ $active_admission->period }}</td>
                    </tr>
                    <tr>
                        <td class="px-2">Administrasi</td>
                        <td class="px-2">:</td>
                        <td class="px-2">{{ $active_admission->amount }}</td>
                    </tr>
                    <tr>
                        <td class="px-2">Mulai</td>
                        <td class="px-2">:</td>
                        <td class="px-2">
                            {{ \Carbon\Carbon::parse($active_admission->start_date)->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td class="px-2">Hingga</td>
                        <td class="px-2">:</td>
                        <td class="px-2">
                            {{ \Carbon\Carbon::parse($active_admission->end_date)->translatedFormat('d F Y') }}</td>
                    </tr>
                </table>
            @else
                Tidak ada pendaftaran yang aktif
            @endif
        </x-bakid.card>


        {{-- admissions --}}
        
        <x-splade-rehydrate on="admission-setting-updated">
            <x-splade-modal name="admissions" slideover max-width="lg" close-explicitly>
                <div class="p-3 mb-3 bg-neutral-300 rounded-lg mt-6">
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-semibold">Riwayat Gelombang</span>
                        <button class="bg-primary-500 px-5 p-2 rounded-lg">
                            <x-bakid.icon name="plus-circle" size="xl" color="white" />
                        </button>
                    </div>
                </div>
                @foreach ($admissions as $i)
                <Link href="{{ route('admission.edit', $i->id) }}" modal>
                <table class=" w-full  p-3  rounded-xl mb-3 relative">
                    @if ($i->id === $active_admission->id)
                    <div class="absolute top-0 right-0">
                        <x-bakid.icon name="check-circle" variant="fill" size="xl" color="green-500" />
                    </div>
                    @endif
                        <tbody class="p-3 mb-3 hover:cursor-pointer hover:bg-neutral-200">
                            <tr>
                                <td class="px-2">Gelombang</td>
                                <td class="px-2">:</td>
                                <td class="px-2">{{ $i->batch }}</td>
                            </tr>
                            <tr>
                                <td class="px-2">Periode</td>
                                <td class="px-2">:</td>
                                <td class="px-2">{{ $i->period }}</td>
                            </tr>
                            <tr>
                                <td class="px-2">Administrasi</td>
                                <td class="px-2">:</td>
                                <td class="px-2">{{ $i->amount }}</td>
                            </tr>
                            <tr>
                                <td class="px-2">Mulai</td>
                                <td class="px-2">:</td>
                                <td class="px-2">
                                    {{ \Carbon\Carbon::parse($i->start_date)->translatedFormat('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td class="px-2">Hingga</td>
                                <td class="px-2">:</td>
                                <td class="px-2">
                                    {{ \Carbon\Carbon::parse($i->end_date)->translatedFormat('d F Y') }}</td>
                            </tr>
                        </tbody>
                    </table>
                    </Link>
                    <hr>
                @endforeach
            </x-splade-modal>
        </x-splade-rehydrate>
    </div>
</x-app-layout>
