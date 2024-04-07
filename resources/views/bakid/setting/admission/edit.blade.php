<x-app-layout>
    <x-splade-modal close-explicitly>
        <x-splade-form :default="$admission" :action="route('admission.update', $admission->id)" class="flex flex-col gap-4" method="put" 
            @success="$splade.emit('admission-setting-updated')">
            <div class="flex gap-4 mt-5">
                <div class="w-full flex flex-col gap-4">
                    <x-splade-input name="batch" label="Gelombang" />
                    <x-splade-input name="period" label="Periode" />
                    <x-splade-input date name="start_date" label="Tanggal Mulai" />
                    <x-splade-input date name="end_date" label="Berakhir" />
                    <x-splade-select name="is_active" label="Administrasi" :options="[['label' => 'Aktif', 'value' => 1], ['label' => 'Tidak Aktif', 'value' => 0]]" />
                </div>
            </div>
            <div class="flex
                       justify-between">
                <Link tabindex="-1" confirm="Delete..." confirm-text="Are you sure?" confirm-button="Yes, take me there!"
                    cancel-button="No, keep me save!" href="{{ route('admission.destroy', $admission->id) }}" method="delete"
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
