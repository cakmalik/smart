@seoTitle(__('Register'))

<x-authentication-card>
    <x-slot:logo>
        <x-authentication-card-logo />
        </x-slot>

        <x-splade-form class="">
            <x-splade-data remember="menu" default="{currentIndex: 0 }">
                <aside v-show="data.currentIndex === 0">
                    <x-splade-input name="form.name" validation-key="email_address" />
                </aside>

                <aside v-show="data.currentIndex === 1">
                    inu
                </aside>

                <aside v-show="data.currentIndex === 2">
                    ine
                </aside>


                <div class="flex items-center justify-between mt-4">
                    <button class="px-4 py-2 bg-gray-200 mr-2 rounded-lg hover:bg-green-400"
                        v-show="data.currentIndex > 0" @click="data.currentIndex = data.currentIndex - 1;">Back</button>
                    <button class="px-4 py-2 bg-gray-200 ml-auto rounded-lg hover:bg-green-400"
                        v-show="data.currentIndex < 2" @click="data.currentIndex = data.currentIndex + 1;">Next</button>

                    <x-splade-submit :label="__('')" class="ml-4" hidden />
                </div>
            </x-splade-data>
        </x-splade-form>
</x-authentication-card>
