<x-splade-modal>
    <h1 class=" font-semibold text-2xl">{{ __('Class') }}</h1>
    <div class="relative flex py-5 items-center">
        <div class="flex-grow border-t border-gray-400"></div>
    </div>

    <div class="grid grid-cols-1 gap-4">
        <div id="accordion-collapse" data-accordion="collapse">
            @forelse ($data as $i)
                <h2 id="accordion-collapse-{{ $i->id }}">
                    <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 @if ($loop->first) rounded-t-xl @endif focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                        data-accordion-target="#accordion-collapse-body-{{ $i->id }}" aria-expanded="true"
                        aria-controls="accordion-collapse-body-{{ $i->id }}">
                        <div class="flex gap-3">
                            <span>{{ $i->class_name }}</span>
                            <span class="text-gray-400">({{ $i->rombel?->count() }} {{ __('Group') }})</span>
                        </div>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />     
                        </svg>
                    </button>
                </h2>
                <div id="accordion-collapse-body-{{ $i->id }}" class="hidden"
                    aria-labelledby="accordion-collapse-{{ $i->id }}">
                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                        <div class="flex flex-wrap gap-2">
                            @if ($i->rombel)
                                @forelse ($i->rombel as $ri)
                                    <div
                                        class=" grow flex justify-center card text-gray-500 border rounded-md border-gray-200 px-2 py-1 bg-white hover:bg-wa-teal1 hover:text-white cursor-pointer">
                                        {{ $ri->grade_name }}
                                    </div>
                                @empty
                                    <span class="flex grow justify-center text-gray-400">
                                        Tidak ditemukan Rombel
                                    </span>
                                @endforelse
                            @endif
                            <div
                                class=" grow flex justify-center items-center card text-gray-500 border rounded-md border-gray-200 px-2 py-1 bg-gray-100 hover:bg-wa-teal1 hover:text-white cursor-pointer">
                                <i class="ph ph-plus-circle me-2"></i>
                                <span>Tambah</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class=" sm:rounded-lg p-4 py-2 border border-neutral-300">
                <div class="flex justify-between items-center">
                    <span> </span>
                    <div class="justify-center border rounded-lg p-2 py-1"> {{ $i->rombel->count() }}</div>
                </div>
            </div> --}}
            @empty
            @endforelse
        </div>
    </div>


    <x-splade-script>
        initFlowbite();
    </x-splade-script>
</x-splade-modal>
