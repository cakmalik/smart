<x-app-layout>
    <x-splade-modal>
        <x-splade-form :default="$student" :action="route('student.update', $student->id)" class="flex flex-col gap-4" method="put">
            <div class="flex justify-center items-center gap-4">
                <div class="w-56">
                    <img class="rounded-xl object-cover w-full h-full"
                        src="{{ $student->student_image ? asset('storage/student-photos/' . $student->student_image) : asset('bakid/default_image.jpg') }}"
                        onerror="this.onerror=null;this.src='{{ asset('bakid/default-profile.png') }}';" />
                </div>
                <div class="grow">
                    <h3 class="text-xl">{{ $student->name }}</h3>
                    <h3 class="text-gray-500">{{ $student->nickname }}</h3>
                    <h3>{{ $student->district . ' - ' . $student->city }}</h3>
                    <h3>Asrama </h3>
                    <div class="flex mt-3 gap-1 text-center">
                        <Link class="p-3 border bg-green-400 hover:bg-green-500 rounded-xl text-white">
                        Cetak KTS
                        </Link>
                        <Link class="p-3 border bg-green-400 hover:bg-green-500 rounded-xl text-white">
                        Cetak MoU
                        </Link>
                        <Link class="p-3 border bg-green-400 hover:bg-green-500 rounded-xl text-white">
                        Cetak Kartu Mahrom
                        </Link>
                    </div>
                </div>
            </div>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
