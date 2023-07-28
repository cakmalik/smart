@seoTitle(__('Users'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Format Message') }}
        </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-splade-table :for="$format_message" striped>
                    <x-slot name="empty-state">
                        <p class="text-center">No setting found.</p>
                    </x-slot>
                    @cell('action', $format_message)
                        <div class="flex gap-1 ">
                            <Link modal href="{{ route('format-message.edit', $format_message->id) }}"
                                class="rounded-full p-1 bg-slate-500 text-white hover:bg-green-500 me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                viewBox="0 0 256 256">
                                <path
                                    d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63ZM51.31,160,136,75.31,152.69,92,68,176.68ZM48,179.31,76.69,208H48Zm48,25.38L79.31,188,164,103.31,180.69,120Zm96-96L147.31,64l24-24L216,84.68Z">
                                </path>
                            </svg>
                            </Link>
                            <Link href="{{ route('tes.message') }}"
                                class="rounded-full p-1 bg-slate-500 text-white hover:bg-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                viewBox="0 0 256 256">
                                <path
                                    d="M223.87,114l-168-95.89A16,16,0,0,0,32.93,37.32l31,90.47a.42.42,0,0,0,0,.1.3.3,0,0,0,0,.1l-31,90.67A16,16,0,0,0,48,240a16.14,16.14,0,0,0,7.92-2.1l167.91-96.05a16,16,0,0,0,.05-27.89ZM48,224l0-.09L78.14,136H136a8,8,0,0,0,0-16H78.22L48.06,32.12,48,32l168,95.83Z">
                                </path>
                            </svg>
                            </Link>

                        </div>
                    @endcell
                </x-splade-table>

            </div>
        </div>
</x-app-layout>
