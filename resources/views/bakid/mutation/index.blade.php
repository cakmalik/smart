@seoTitle(__('Mutation'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl capitalize">
            {{ __('mutation') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto p-3 sm:px-6 lg:px-8">
            {{-- jenis mutasi --}}

            {{-- mutasi menjadi alumni
            mutasi lembaga
            mutasi kelas
            mutasi asrama     --}}
            {{-- disertai cetak surat dan pemberitahuan by wa dan app --}}
            {{-- tampilkan confirm password --}}
            {{-- 
            <input type="text"
                class="mb-5 w-full rounded-lg bg-white/50 border-wa-teal1 text-center focus:outline-none focus:border-wa-teal1 focus:ring-wa-teal1 "
                placeholder="Cari NIS / Nama Santri">
            <div class="grid grid-cols-3 sm:grid-cols-5 gap-1 sm:gap-3 w-full items-center text-center"> --}}
            <x-splade-table :for="$data">
                   <x-slot:empty-state>
                        <x-bakid.state.empty />
                    </x-slot>
                @cell('asrama', $data)
                    <div class="flex gap-1 ">
                        <span>{{ $data->dormitory[0]?->name }}-{{ $data->room[0]?->name }}</span>
                        {{-- <Link confirm method="DELETE" href="{{ route('announcement.destroy', $data->id) }}"
                            class="rounded-full p-1 px-2 capitalize bg-red-200 text-red-500 hover:bg-red-500 hover:text-white">
                        {{ __('delete') }}
                        </Link> --}}
                    </div>
                @endcell
                @cell('formal', $data)
                    <div class="flex gap-1">
                        @if ($data->formal)
                            <span>{{ $data->formal?->lembaga?->name }}
                                - {{ $data->formal?->kelas?->class_name . $data->formal?->rombel?->grade_name }}</span>
                        @endif
                    </div>
                @endcell
                @cell('non-formal', $data)
                    <div class="flex gap-1 ">
                        @if ($data->informal)
                            <span>{{ $data->informal?->lembaga?->name }}
                                - {{ $data->informal?->kelas?->class_name . $data->informal?->rombel?->grade_name }}</span>
                        @endif
                    </div>
                @endcell
            </x-splade-table>

        </div>
    </div>
</x-app-layout>
