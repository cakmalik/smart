<x-app-layout>
    <x-splade-modal>
        <x-splade-form :default="$data" :action="route('informal.class.update', $data->id)" class="flex flex-col gap-4" method="put" stay background
            @success="$splade.emit('class-updated')">
            <div class="flex gap-4 mt-5">
                <div class="w-full flex flex-col gap-4">
                    <x-splade-input class="mb-2" name="class_name" :label="__('nama kelas')"  />
                    <x-splade-input class="mb-2" type="number" name="qty" :label="__('maksimal kuota')" />
                    <x-splade-input class="mb-2" type="number" name="current_qty" :label="__('kuota sekarang')" />
    {{-- <x-splade-input class="mb-2" name="start_date" date :label="__('start_date')" />
                    <x-splade-input class="mb-2" name="end_date" date :label="__('end_date')" /> --}}
                </div>
            </div>
            <div class="flex
                       justify-between items-center">
                <Link confirm="Delete..." confirm-text="Yakin?" confirm-button="Ya, Saya yakin" 
                    cancel-button="Tidak" href="{{ route('informal.class.destroy', $data->id) }}" method="delete"
                    >
                    <x-bakid.button level="danger">
                        <x-slot:leading>
                            <x-bakid.icon name="trash" />
                        </x-slot:leading>
                    </x-bakid.button>
                </Link>
                <x-splade-submit :label="__('Simpan')" class="ml-4" />
            </div>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
