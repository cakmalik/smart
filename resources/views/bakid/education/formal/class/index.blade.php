<x-splade-modal>
    <h1 class=" font-semibold text-2xl">{{ __('Class') }}</h1>
    <div class="relative flex py-5 items-center">
        <div class="flex-grow border-t border-gray-400"></div>
    </div>   

    <div class="grid grid-cols-1 gap-4">
        @forelse ($data as $i)
            <div class=" sm:rounded-lg p-4 py-2 border border-neutral-300">
                <div class="flex justify-between items-center">
                   <span> {{ $i->class_name }}</span>
                   <div class="justify-center border rounded-lg p-2 py-1"> {{ $i->rombel->count() }}</div>
                </div>
            </div>
        @empty
        @endforelse
    </div>
</x-splade-modal>