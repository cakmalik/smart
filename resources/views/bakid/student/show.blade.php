<x-app-layout>
    <x-splade-modal>
        <x-splade-form :default="$student" :action="route('student.update', $student->id)" class="flex flex-col gap-4" method="put">
            {{-- @dd($student) --}}
            <div class="grid grid-cols-3 gap-4">
                <div class="">
                    <img class="rounded-xl object-cover w-full h-full"
                        src="{{ $student->student_image ? asset('storage/student-photos/' . $student->student_image) : asset('bakid/default_image.jpg') }}">
                </div>
                <div class="col-span-2">
                    <h3 class="text-2xl">{{ $student->name }}</h3>
                    <h3 class="text-gray-500 italic">{{ $student->nickname }}</h3>
                    <h3>{{ $student->district . ' - ' . $student->city }}</h3>
                    <h3>Asrama </h3>
                </div>

            </div>

        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
