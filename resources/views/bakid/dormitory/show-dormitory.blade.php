<x-app-layout>
    <x-splade-modal>
        <x-splade-form :default="$dormitory" :action="route('dormitory.update', $dormitory->id)" class="flex flex-col gap-4" method="put" stay background
            @success="$splade.emit('dormitory-updated')">

            <div class="flex gap-4 mt-5">
                <div class="w-full flex flex-col gap-4">
                    <x-splade-input class="mb-2" name="name" :label="__('Name')" placeholder="Nama Asrama" />
                    <x-splade-input class="mb-2" type="number" name="rooms" :label="__('Jumlah Asrama')"
                        placeholder="Kapasitas" />
                    <x-splade-input class="mb-2" type="number" name="capacity" :label="__('Capacity')"
                        placeholder="Kapasitas" />

                    <x-splade-select class="mb-2" name="leader_id" :label="__('Ketua Daerah')" />
                </div>
            </div>
            <div class="flex justify-end">
                <x-splade-submit
                    class="bg-slate-500 p-2 text-white rounded-md text-sm items-center  hover:bg-green-500 w-20"
                    :spinner="true">
                    Update
                </x-splade-submit>
            </div>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
