<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-3 rounded-lg">
                <x-splade-data remember="menu" default="{currentIndex: 0 }">

                    <aside v-show="data.currentIndex === 0">
                        ini
                    </aside>

                    <aside v-show="data.currentIndex === 1">
                        inu
                    </aside>

                    <aside v-show="data.currentIndex === 2">
                        ine
                    </aside>

                    <div class="flex justify-center mt-4">
                        <button class="px-4 py-2 bg-gray-200 mr-2 rounded-lg hover:bg-green-400"
                            v-show="data.currentIndex > 0"
                            @click="data.currentIndex = data.currentIndex - 1;">Back</button>
                        <button class="px-4 py-2 bg-gray-200 ml-2 rounded-lg hover:bg-green-400"
                            v-show="data.currentIndex < 2"
                            @click="data.currentIndex = data.currentIndex + 1;">Next</button>
                    </div>
                </x-splade-data>
            </div>
        </div>
    </div>
</x-app-layout>
