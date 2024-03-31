@seoTitle(__('Students'))

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
                <x-splade-table :for="$data">
                    <x-slot:empty-state>
                        <x-bakid.state.empty />
                    </x-slot>

                    
                </x-splade-table>
            </div>
        </div>
    </x-splade-rehydrate>
</x-app-layout>
<x-splade-script>

</x-splade-script>
