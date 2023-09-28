@seoTitle(__('Permittion'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl capitalize">
            {{ __('Permittion') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full flex justify-end p-2">
                <button
                    class=" flex  items-center  gap-2 p-2 px-4 rounded-lg  text-white bg-wa-teal2 hover:bg-wa-teal1">{{ __('Show Permittion Access') }}
                    <div class="ph ph-arrow-right"></div>
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
