<x-app-layout>
    <x-splade-modal>
        <x-splade-form :default="$informal" :action="route('informal.update', $informal->id)" class="flex flex-col gap-4" method="put" stay background
            @success="$splade.emit('informal-updated')">

            <div class="flex gap-4 mt-5">
                <div class="w-full flex flex-col gap-4">
                    <?php
                    $levels = [
                        [
                            'label' => 'Primary',
                            'value' => 'primary',
                        ],
                        [
                            'label' => 'Secondary',
                            'value' => 'Secondary',
                        ],
                        [
                            'label' => 'high',
                            'value' => 'high',
                        ],
                        [
                            'label' => 'bachelor',
                            'value' => 'bachelor',
                        ],
                        [
                            'label' => 'master',
                            'value' => 'master',
                        ],
                        [
                            'label' => 'doctoral',
                            'value' => 'doctoral',
                        ],
                    ];
                    ?>
                    <x-splade-input class="mb-2" name="name" :label="__('Name')" placeholder="Nama Asrama" />
                    <x-splade-select name="level" :options="$levels" option-label="label" option-value="value"
                        class="capitalize" />
                </div>
            </div>
            <div class="flex
                       justify-between">

                <Link confirm="Delete..." confirm-text="Are you sure?" confirm-button="Yes, take me there!"
                    cancel-button="No, keep me save!" href="{{ route('informal.destroy', $informal->id) }}" method="delete"
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
