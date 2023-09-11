@seoTitle(__('Students'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl capitalize">
            {{ __('students') }}
        </h2>
    </x-slot>
    <x-splade-rehydrate on="kts-generated">
        <div class="py-12">
            <div class="max-w-7xl mx-auto p-2 sm:px-6 lg:px-8">
                <!-- component -->
                <x-splade-table :for="$students">
                    <x-slot:empty-state>
                        <x-bakid.state.empty />
                    </x-slot>

                    <x-splade-cell asrama as="$students">
                        <span class="text-green-500 p-1 rounded-xl bg-green-100 border">
                            {{ $students->dormitory[0]->name . $students->room[0]->name }}</span>
                    </x-splade-cell>

                    <x-splade-cell family as="$students">
                        <span>
                            {{ $students->parent?->father_name . ' (' . $students->getTotalStudentsAttribute() . ')' }}</span>
                    </x-splade-cell>

                    <x-splade-cell action as="$students">
                        <div class="flex items-center">
                            <div class="flex gap-1 ">
                                <Link modal href="{{ route('student.show', $students->id) }}"
                                    class="rounded-full px-6 flex items-center justify-center gap-1 p-1 bg-wa-teal2 text-white hover:bg-green-500">
                                <i class="ph-fill ph-magnifying-glass-plus"></i>
                                {{-- Detail --}}
                                </Link>
                                <Link edit href="{{ route('student.edit', $students->id) }}"
                                    class="rounded-full px-6 flex items-center justify-center gap-1 p-1 bg-wa-teal2 text-white hover:bg-green-500">
                                <i class="ph-fill ph-pencil-circle"></i>
                                {{-- Edit --}}
                                </Link>

                            </div>
                        </div>
                    </x-splade-cell>

                    {{-- <x-slot name="head">
                        <thead>
                            <tr>
                                @foreach ($users->columns() as $column)
                                    <th>{{ $column->label }}</th>
                                @endforeach
                            </tr>
                        </thead>
                    </x-slot>

                    <x-slot name="body">
                        <tbody>
                            @foreach ($users->resource as $user)
                                <tr>
                                    ...
                                </tr>
                            @endforeach
                        </tbody>
                    </x-slot> --}}
                </x-splade-table>
            </div>
        </div>
    </x-splade-rehydrate>
</x-app-layout>
<x-splade-script>

</x-splade-script>
