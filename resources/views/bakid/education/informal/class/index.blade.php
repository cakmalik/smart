@seoTitle(__($title))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl capitalize">
            {{ __($title) }}
        </h2>
    </x-slot>
    <div class="mt-10">
        <div class="max-w-7xl mx-auto p-2 sm:px-6 lg:px-8">
            <div class="w-full flex justify-end mb-3">
                <Link href="#create-modal" close-explicitly>
                <x-bakid.button label="Tambah">
                    <x-slot:leading>
                        <x-bakid.icon name="plus" />
                    </x-slot:leading>
                </x-bakid.button>
                </Link>
            </div>

            <!-- component -->
            <x-splade-rehydrate on="class-updated">
                <x-splade-table :for="$data" class="group">
                    <x-slot:empty-state>
                        <x-bakid.state.empty />
                    </x-slot>

                    <x-splade-cell aksi as="$data">
                        <div class="flex gap-2 items-center">
                            <Link modal href="{{ route('informal.class.show', $data->id) }}">
                            <x-bakid.button>
                                <x-slot:leading>
                                    <x-bakid.icon name="magnifying-glass-plus" />
                                </x-slot:leading>
                            </x-bakid.button>
                            </Link>
                        </div>
                    </x-splade-cell>
                </x-splade-table>
            </x-splade-rehydrate>

            <x-splade-modal name="create-modal">
                <x-splade-form :action="route('informal.class.store')" stay background @success="$splade.emit('class-updated')"
                    class="flex flex-col gap-4" method="post">
                    <div class="flex gap-4">
                        <div class="w-full flex flex-col gap-4">
                            <x-splade-input class="mb-2" name="class_name" :label="__('nama kelas')"  />
                            <x-splade-input class="mb-2" type="number" name="qty" :label="__('maksimal kuota')" />
                            <x-splade-input class="mb-2" type="number" name="current_qty" :label="__('kuota sekarang')" />
                        </div>
                    </div>
                    <x-splade-submit label="Simpan" />
                </x-splade-form>
            </x-splade-modal>
        </div>
    </div>
</x-app-layout>
<x-splade-script>

</x-splade-script>
