@seoTitle(__('data'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl capitalize">
            {{ __($title) }}
        </h2>
    </x-slot>
    <div class="mt-10">
        <x-splade-rehydrate on="academy_updated">
            <div class="max-w-7xl mx-auto p-2 sm:px-6 lg:px-8">
                <div class="w-full flex justify-end mb-3">
                    <Link modal href="{{ route('informal.academic_years.create') }}" close-explicitly>
                    <x-bakid.button label="Tambah">
                        <x-slot:leading>
                            <x-bakid.icon name="plus" />
                        </x-slot:leading>
                    </x-bakid.button>
                    </Link>
                </div>

                <!-- component -->
                <x-splade-table :for="$data" class="group">
                    <x-slot:empty-state>
                        <x-bakid.state.empty />
                    </x-slot>
                    <x-splade-cell status as="$data">
                        <span class=" p-1 px-2 rounded-full " @class([
                            'bg-green-400 text-white ' => $data->is_active,
                            'text-black border border-neutral-500' => !$data->is_active,
                        ])>
                            {{ $data->is_active ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </x-splade-cell>
                </x-splade-table>
            </div>
        </x-splade-rehydrate>
    </div>
</x-app-layout>
<x-splade-script>

</x-splade-script>
