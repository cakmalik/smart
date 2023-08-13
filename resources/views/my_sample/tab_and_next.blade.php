<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-3 rounded-lg">
                <x-splade-data remember="menu" default="{ tab1: false, tab2: false, tab3: false, currentIndex: 0 }">
                    <nav class="flex justify-center mb-4">
                        <button class="px-4 py-2 bg-gray-200 rounded-l-lg"
                            :class="{ 'bg-blue-500 text-white': data.tab1 }"
                            @click="data.tab1 = true; data.tab2 = false; data.tab3 = false; data.currentIndex = 0;">Tab
                            1</button>
                        <button class="px-4 py-2 bg-gray-200" :class="{ 'bg-blue-500 text-white': data.tab2 }"
                            @click="data.tab1 = false; data.tab2 = true; data.tab3 = false; data.currentIndex = 1;">Tab
                            2</button>
                        <button class="px-4 py-2 bg-gray-200 rounded-r-lg"
                            :class="{ 'bg-blue-500 text-white': data.tab3 }"
                            @click="data.tab1 = false; data.tab2 = false; data.tab3 = true; data.currentIndex = 2;">Tab
                            3</button>
                    </nav>

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
                        <button class="px-4 py-2 bg-gray-200 mr-2 rounded-lg" :disabled="data.currentIndex === 0"
                            @click="data.currentIndex = data.currentIndex - 1;">Back</button>
                        <button class="px-4 py-2 bg-gray-200 ml-2 rounded-lg" :disabled="data.currentIndex === 2"
                            @click="data.currentIndex = data.currentIndex + 1;">Next</button>
                    </div>
                </x-splade-data>
            </div>
        </div>
    </div>
</x-app-layout>
