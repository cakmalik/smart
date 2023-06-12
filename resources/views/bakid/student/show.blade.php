<x-app-layout>
    <x-splade-modal>
        <x-splade-form :default="$student" :action="route('student.update', $student->id)" class="flex flex-col gap-4" method="put">
            @dd($student)
            <div class="grid grid-cols-2">
                <div class="">
                    <img src="{{ asset('storage/student-photos/' . $student->student_image) }}" alt="">
                </div>
                <div class="">dfs</div>

            </div>
            <button type="submit"
                class="bg-slate-500 p-2 text-white rounded-md text-sm items-center  hover:bg-green-500 w-20">
                Update
            </button>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
