<div id="accordion-collapse" data-accordion="collapse">
    @forelse ($data as $i)
        <h2 id="accordion-collapse-{{ $i->id }}">
            <button type="button"
                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 @if ($loop->first) rounded-t-xl @endif focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                data-accordion-target="#accordion-collapse-body-{{ $i->id }}" aria-expanded="true"
                aria-controls="accordion-collapse-body-{{ $i->id }}">
                <span>{{ $i->class_name }}</span>
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
                <p class="mb-2 text-gray-500 dark:text-gray-400">Flowbite is an open-source library of
                    interactive components built on top of Tailwind CSS including buttons, dropdowns, modals,
                    navbars, and more.</p>
                <p class="text-gray-500 dark:text-gray-400">Check out this guide to learn how to <a
                        href="/docs/getting-started/introduction/"
                        class="text-blue-600 dark:text-blue-500 hover:underline">get started</a> and start
                    developing websites even faster with components on top of Tailwind CSS.</p>
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