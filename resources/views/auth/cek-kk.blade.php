@seoTitle(__('Register'))

<x-authentication-card>
    <x-slot:logo>
        <x-authentication-card-logo />
        </x-slot>

        <x-splade-form class="">
            <x-splade-data remember="menu" default="{currentIndex: 0 }">
                <aside v-show="data.currentIndex === 0">
                    <x-splade-input name="form.kk" label="Nomor KK" />
                </aside>

                <div class="flex items-center justify-between mt-4">
                    <x-splade-submit :label="__('Selanjutnya')" class="ml-4" hidden />
                </div>
            </x-splade-data>
        </x-splade-form>
</x-authentication-card>
