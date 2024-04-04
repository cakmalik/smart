<x-app-layout>
    <x-splade-modal close-explicitly>
        <x-splade-form :default="$data" :action="route('informal.academic_years.update', $data->id)" class="flex flex-col gap-4" method="put" stay background
            @success="$splade.emit('informal-updated')">
            <div class="flex gap-4 mt-5">
                <div class="w-full flex flex-col gap-4">
                    <x-splade-input class="mb-2" name="code" :label="__('code')" readonly />
                    <x-splade-input class="mb-2" name="semester" :label="__('kwartal')" />
                    <x-splade-input class="mb-2" name="year" :label="__('year')" />
                    <x-splade-input class="mb-2" name="start_date" :label="__('start_date')" />
                    <x-splade-input class="mb-2" name="end_date" :label="__('end_date')" />
                </div>
            </div>
            <div class="flex
                       justify-between">
                <Link confirm="Delete..." confirm-text="Yakin?" confirm-button="Ya, Saya yakin"
                    cancel-button="Tidak" href="{{ route('informal.academic_years.destroy', $data->id) }}" method="delete"
                    class='bg-red-500 hover:bg-red-600 p-2 px-4 text-white rounded-md text-sm items-center  '>
                Hapus</Link>
                <x-splade-submit
                    class="bg-slate-500 p-2 px-4 text-white rounded-md text-sm items-center  hover:bg-green-500 w-20"
                    :spinner="true">
                    Update
                </x-splade-submit>
            </div>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
