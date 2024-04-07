<x-app-layout>
    <x-splade-modal>
        <x-splade-form :default="$user" :action="route('user.update', $user->id)" class="flex flex-col gap-4 px-4 py-6" method="put">
            <div class="flex gap-4">
                <div class="w-full flex flex-col gap-4">
                    <x-splade-input name="name" :label="__('Nama')" placeholder="namamu" />
                    <x-splade-input name="email" :label="__('Email')" placeholder="email" />
                </div>
            </div>
            <button type="submit"
                class="bg-slate-500 p-2 text-white rounded-md text-sm items-center  hover:bg-green-500 w-20">
                Update
            </button>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
