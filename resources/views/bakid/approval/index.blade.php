@seoTitle(__('Students'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl capitalize">
            {{ __('Approval') . ' (' . $title . ')' }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-splade-table :for="$data" striped>
                <x-slot name="empty-state">
                    <p class="text-center">No data found.</p>
                </x-slot>
                @cell('tujuan', $data)
                    @switch(request()->segment(2))
                        @case('asrama')
                            <span>{{ $data->dormitory?->name . $data->room?->name }}</span>
                        @break

                        @case('formal')
                            <span>{{ $data->formal?->name . ' (Kls ' . $data->class?->class_name . ')' }}</span>
                        @break

                        @case('nonformal')
                            <span>{{ $data->informal?->name . ' (Kls ' . $data->class?->class_name . ')' }}</span>
                        @break

                        @default
                            <a href="">as</a>
                    @endswitch
                @endcell
                @cell('action', $data)
                    <div class="flex gap-1 ">
                        <Link class="bg-wa-light px-2 py-1 text-white rounded-full" confirm="Konfirmasi..."
                            confirm-text="Anda yakin menerima pengajuan? " confirm-button="YA" cancel-button="Tidak"
                            href="{{ route('approval.action', ['id' => $data->id, 'category' => Request::segment(2)]) }}">
                        <i class="ph ph-check"></i>
                        </Link>
                    </div>
                @endcell
            </x-splade-table>
        </div>
    </div>
</x-app-layout>

<x-splade-script>

</x-splade-script>
