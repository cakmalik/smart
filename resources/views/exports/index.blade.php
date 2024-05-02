@seoTitle(__($title))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl capitalize">
            {{ __($title) }}
        </h2>
    </x-slot>
    <div class="mt-10">
        <div class="max-w-7xl mx-auto p-2 sm:px-6 lg:px-8">
            <div class="w-full flex justify-end mb-3">
                <Link href="#create-modal" close-explicitly>
                {{-- <x-bakid.button label="Tambah">
                    <x-slot:leading>
                        <x-bakid.icon name="plus" />
                    </x-slot:leading>
                </x-bakid.button> --}}
                </Link>
            </div>

            <!-- component -->
            {{-- <x-splade-rehydrate on="academy-updated">
                <x-splade-table :for="$data" class="group">
                    <x-slot:empty-state>
                        <x-bakid.state.empty />
                    </x-slot>
                    <x-splade-cell status as="$data">
                        <span class=" p-1 px-2 rounded-full " @class([
                            'bg-green-400 text-white ' => $data->is_active,
                            'text-black border border-neutral-500' => !$data->is_active,
                        ])>
                            {{ $data->is_active ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </x-splade-cell>
                    <x-splade-cell aksi as="$data">
                        <div class="flex gap-2 items-center">
                            @if (!$data->is_active)
                                <Link confirm="Lanjutkan?"
                                    confirm-text="Apakah anda yakin mengaktifkan tahun akademik ini?"
                                    confirm-button="Ya" cancel-button="Tidak"
                                    href="{{ route('informal.academic_years.activate', $data->id) }}" close-explicitly>
                                <x-bakid.button :is_fill="false">
                                    <x-slot:leading>
                                        <x-bakid.icon name="check" />
                                    </x-slot:leading>
                                </x-bakid.button>
                                </Link>
                            @endif
                            <Link modal href="{{ route('informal.academic_years.show', $data->id) }}">
                            <x-bakid.button>
                                <x-slot:leading>
                                    <x-bakid.icon name="magnifying-glass-plus" />
                                </x-slot:leading>
                            </x-bakid.button>
                            </Link>
                        </div>
                    </x-splade-cell>
                </x-splade-table>
            </x-splade-rehydrate> --}}

            {{-- <x-splade-modal name="create-modal">
                <x-splade-form :action="route('informal.academic_years.store')" stay background @success="$splade.emit('academy-updated')"
                    class="flex flex-col gap-4" method="post">
                    <div class="flex gap-4">
                        <div class="w-full flex flex-col gap-4">
                            <x-splade-input name="semester" :label="__('Kwartal')" placeholder="Kwartal / Semester" />
                            <x-splade-input name="year" :label="__('Tahun Hijriah')" placeholder="Tahun Hijriah" />
                            <x-splade-input name="start_date" :label="__('Start Date')" placeholder="Start Date" date />
                            <x-splade-input name="end_date" :label="__('End Date')" placeholder="End Date" date />
                        </div>
                    </div>
                    <x-splade-submit label="Simpan" />
                </x-splade-form>
            </x-splade-modal> --}}
        </div>
    </div>
</x-app-layout>
<x-splade-script>

</x-splade-script>
