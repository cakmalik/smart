@seoTitle(__('Settings'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl capitalize">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-12 px-4 max-w-7xl mx-auto sm:px-6 lg:px-8 grid sm:grid-cols-3 gap-3">
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
                        <td class="px-2">Rp{{ number_format($active_admission->amount) }}</td>
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

        <x-bakid.card>
            <x-slot:header>
                <div class="flex items-center justify-between">
                    <span>Administrasi</span>
                    <Link href="{{ route('invoice.category.edit', 'psb') }}">
                    <x-bakid.icon name="pencil" variant="duotone" />
                    </Link>
                </div>
            </x-slot:header>

            @if ($adm)
                <p>
                    Adapun besaran administrasi adalah : <br> Rp{{ number_format($adm->amount) }}
                    <br>
                    @if ($adm->discounts->count() > 0)
                        dan terdapat potongan jika bersaudara
                    @endif
                </p>
            @else
                Tidak ditemukan data administrasi
            @endif
        </x-bakid.card>



        {{-- list --}}
        <x-splade-modal name="admissions" slideover max-width="lg" close-explicitly>
            <div class="p-3 mb-3 bg-neutral-300 rounded-lg mt-6">
                <div class="flex justify-between pe-6 items-center">
                    <span class="text-xl font-semibold">Riwayat Gelombang</span>
                    <Link href="#create" class="bg-primary-500 px-5 p-2 rounded-lg">
                    <x-bakid.icon name="plus" size="xl" color="white" />
                    </Link>
                </div>
            </div>
            @foreach ($admissions as $i)
                <Link href="{{ route('admission.edit', $i->id) }}" modal>
                <div class="p-3 mb-3 hover:cursor-pointer hover:bg-neutral-200">
                    <div class="flex justify-between pe-6">
                        <div class="flex gap-3 items-center">
                            Periode
                            @if ($i->id == $active_admission?->id)
                                <x-bakid.icon name="check-circle" variant="fill" size="xl" color="green-500" />
                            @endif
                        </div>
                        <div>{{ $i->period }}</div>
                    </div>
                    <div class="flex justify-between pe-6">
                        <div>Gelombang</div>
                        <div>{{ $i->batch }}</div>
                    </div>
                    <div class="flex justify-between pe-6">
                        <div>Administrasi</div>
                        <div>Rp{{ number_format($i->amount) }}</div>
                    </div>
                    <div class="flex justify-between pe-6">
                        <div>Mulai</div>
                        <div>
                            {{ \Carbon\Carbon::parse($i->start_date)->translatedFormat('d F Y') }}</div>
                    </div>
                    <div class="flex justify-between pe-6">
                        <div>Hingga</div>
                        <div>
                            {{ \Carbon\Carbon::parse($i->end_date)->translatedFormat('d F Y') }}</div>
                    </div>
                </div>
                </Link>
                <hr>
            @endforeach
        </x-splade-modal>

        {{-- form --}}
        <x-splade-modal name="create" close-explicitly>
            <x-splade-form :action="route('admission.store')" class="flex flex-col gap-4" method="POST">
                <div class="flex gap-4 mt-5">
                    <div class="w-full flex flex-col gap-4">
                        <x-splade-input name="batch" label="Gelombang" />
                        <x-splade-input name="period" label="Periode" />
                        <x-splade-input date name="start_date" label="Tanggal Mulai" />
                        <x-splade-input date name="end_date" label="Berakhir" />
                        <x-splade-input name="amount" label="Administrasi" />
                        <x-splade-select name="is_active" label="Status" :options="[['label' => 'Aktif', 'value' => 1], ['label' => 'Tidak Aktif', 'value' => 0]]" />
                    </div>
                </div>
                <div class="flex justify-between">
                    <x-splade-submit size="" :spinner="true">
                        Tambah
                    </x-splade-submit>
                </div>
            </x-splade-form>
        </x-splade-modal>
    </div>
</x-app-layout>
