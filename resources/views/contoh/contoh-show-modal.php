<x-app-layout>
    <x-splade-modal>
        <x-splade-form :default="$data" :action="route('informal.academic_years.update', $data->id)" class="flex flex-col gap-4" method="put" stay background
            @success="$splade.emit('informal-updated')">
            <div class="flex gap-4 mt-5">
                <div class="w-full flex flex-col gap-4">
                    <x-splade-input class="mb-2" name="name" :label="__('Name')" placeholder="Nama Asrama" />
                </div>
            </div>
            <div class="flex
                       justify-between">
                <Link confirm="Delete..." confirm-text="Are you sure?" confirm-button="Yes, take me there!"
                    cancel-button="No, keep me save!" href="{{ route('informal.academic_years.destroy', $data->id) }}" method="delete"
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
