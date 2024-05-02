@seoTitle(__($title))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl capitalize">
            {{ __($title) }}
        </h2>
    </x-slot>
    <div class="mt-10">
        <div class="max-w-7xl mx-auto p-2 sm:px-6 lg:px-8">
            <div class="mt-5 w-full">
                <x-splade-form action="{{ route('export.generate') }}" method="POST">
                    <div class="w-full flex items-center justify-center gap-3">
                        <div class="w-1/3 sm:w-2/5">
                            <x-splade-select name="year">
                                <option value="">Pilih tahun</option>
                                @forelse ($year_collection as $i)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @empty
                                    <option value="{{ date('Y') }}">{{ now()->year }}</option>
                                @endforelse
                            </x-splade-select>
                        </div>
                        <div class="w-1/3 sm:w-2/5">
                            <x-splade-select name="category">
                                <option value="">Pilih Kategori</option>
                                <option value="asrama">By Asrama</option>
                                <option value="formal">By Pendidikan Formal</option>
                                <option value="informal">By Madin</option>
                            </x-splade-select>
                        </div>
                        <div class="w-1/3 sm:w-1/5">
                            <x-splade-submit class="w-full" label="Generate" />
                        </div>
                    </div>
                </x-splade-form>
            </div>
            <a href="https://drive.google.com/drive/folders/18UF1T-SEqlDHK_qFd6YpDxvmknQMfMZl?usp=sharing" target="_blank" class="w-full mt-6 flex items-center justify-center">
                <div  class="px-4 py-2 rounded-lg border text-white bg-black/50 backdrop-blur-md">
                    BUKA DRIVE
                </div>
            </a>

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
