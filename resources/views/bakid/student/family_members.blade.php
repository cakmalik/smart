@seoTitle(__('bakid.t.family_members'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl text-gray-800">
            {{ __('bakid.t.family_members') }}
        </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                {{-- card with image --}}
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 px-3">
                    @foreach ($families as $i)
                        <x-card.image />
                    @endforeach
                    <x-card.image />

                </div>
            </div>
        </div>
</x-app-layout>
