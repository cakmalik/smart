@seoTitle(__('Users'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl text-gray-800">
            {{ __('bakid.t.students') }}
        </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <x-splade-table :for="$students" striped>
                    <x-slot name="empty-state">
                        <p class="text-center">No students found.</p>
                    </x-slot>

                    @cell('action', $students)
                        <div class="flex gap-1 ">
                            <Link modal href="{{ route('student.show', $students->id) }}"
                                class="rounded-full p-1 bg-slate-500 text-white hover:bg-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5 p-1">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6" />
                            </svg>

                            </Link>
                            <Link href="{{ route('student.edit', $students->id) }}"
                                class="rounded-full p-1 bg-slate-500 text-white hover:bg-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5 p-1">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                            </Link>
                        </div>
                    @endcell
                </x-splade-table>
            </div>
        </div>
</x-app-layout>
