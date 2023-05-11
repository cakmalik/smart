<x-app-layout>
    <x-splade-modal>
        <x-splade-form :action="route('user.store')" class="flex flex-col gap-4" method="post">
            <div class="flex gap-4">
                <div class="w-full flex flex-col gap-4">
                    <x-splade-input name="name" :label="__('Nama')" placeholder="namamu" />
                    <x-splade-input name="email" :label="__('Email')" placeholder="email" />
                    <x-splade-input name="password" type="password" :label="__('Password')" placeholder="password" />
                    {{-- <x-splade-input name="published_at" date range label="ini date range" />
                    <x-splade-input name="published_at" date time label="ini date time" /> --}}
                </div>
            </div>
            <button type="submit"
                class="bg-slate-500 p-2 text-white rounded-md text-sm items-center  hover:bg-green-500 w-20">
                Simpan
            </button>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
