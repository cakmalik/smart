@seoTitle(__('data'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl capitalize">
            {{ __($title) }}
        </h2>
    </x-slot>
    <x-splade-rehydrate on="kts-generated">
        <div class="py-12">
            <div class="max-w-7xl mx-auto p-2 sm:px-6 lg:px-8">
                <!-- component -->
                <x-splade-table :for="$data" class="group">
                    <x-slot:empty-state>
                        <x-bakid.state.empty />
                    </x-slot>

                    <x-splade-cell status as="$data">
                        <span class=" p-1 px-2 rounded-full " @class(['bg-green-400 text-white ' => $data->is_active, 'text-black border border-neutral-500' => !$data->is_active])>
                            {{ $data->is_active ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </x-splade-cell>

                </x-splade-table>
            </div>
        </div>
    </x-splade-rehydrate>
</x-app-layout>
<x-splade-script>

</x-splade-script>
