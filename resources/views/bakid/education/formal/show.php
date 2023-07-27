<x-app-layout>
    <x-splade-modal>
        <x-splade-form :default="$formal" :action="route('formal.update', $formal->id)" class="flex flex-col gap-4" method="put" background stay @success="$splade.emit('formal-updated')">
            <div class="flex gap-4 mt-5">
                <div class="w-full flex flex-col gap-4">
                    <x-splade-input class="mb-2" name="name" :label="__('Name')" placeholder="" />
                    <x-splade-input class="mb-2" name="level" :label="__('level')" placeholder="" />
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-slate-500 p-2 text-white rounded-md text-sm items-center  hover:bg-green-500 w-20">
                    Update
                </button>
            </div>
            as
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>