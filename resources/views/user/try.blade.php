<x-app-layout>
    <x-splade-modal>
        <x-splade-form :action="route('user.try')" class="flex flex-col gap-4" method="post">
            <div class="flex gap-4">
                <div class="w-full flex flex-col gap-4">
                    {{-- <x-splade-input name="name" :label="__('Nama')" placeholder="namamu" />
                    <x-splade-input name="email" :label="__('Email')" placeholder="email" />
                    <x-splade-input name="password" type="password" :label="__('Password')" placeholder="password" /> --}}
                    <x-splade-input name="published_at" date range label="ini date range" />
                    <x-splade-input name="published_at" date time label="ini date time" />
                    <x-splade-select name="users" :options="$users" option-label="name" option-value="id" label="Users"
                        choices multiple />

                    <button type="submit"
                        class="p-3 bg-green-500 hover:bg-green-600 text-white transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110">Submit</button>

                </div>
            </div>

        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
