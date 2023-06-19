<x-app-layout>
    <x-splade-modal>
        <x-splade-form :default="$room" :action="route('room.update', $room->id)" class="flex flex-col gap-4" method="put" background stay
            @success="$splade.emit('room-updated')">
            <div class="flex gap-4 mt-5">
                <div class="w-full flex flex-col gap-4">
                    <x-splade-select class="mb-2" name="dormitory_id" :options="$daerah" option-label="name"
                        option-value="id" label="Pilih Daerah" />
                    <x-splade-input class="mb-2" name="name" :label="__('Name')" placeholder="Nama Asrama" />
                    <x-splade-input class="mb-2" type="number" name="capacity" :label="__('Capacity')"
                        placeholder="Kapasitas" />
                    <x-splade-input class="mb-2" type="number" name="current_capacity" :label="__('Current Capacity')"
                        placeholder="Kapasitas" />

                    <x-splade-select class="mb-2" name="leader_id" :label="__('Ketua Asrama')" />
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-slate-500 p-2 text-white rounded-md text-sm items-center  hover:bg-green-500 w-20">
                    Update
                </button>
            </div>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
