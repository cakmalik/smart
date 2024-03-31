@seoTitle(__('Informal Education'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl capitalize">
            {{ __('Informal Education') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl h-full mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-col md:grid-cols-1 gap-3">
                <div class="p-4 malik-bg">
                    <div class="flex justify-between items-center mb-3">
                        <div class="inline-flex items-center gap-2">
                            Head
                        </div>
                    </div>
                    {{-- start container --}}
                    <div class="overflow-hidden rounded-lg">
                        <div class="h-[55vh] overflow-y-scroll">
                            <div class="grid grid-col sm:grid-cols-4 gap-2 lg:gap-4">
                            body
                            </div>
                        </div>
                    </div>
                    {{-- end container --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
