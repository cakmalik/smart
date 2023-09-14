<x-app-layout>
    <x-splade-modal>
        <x-splade-lazy>
            <x-slot:placeholder> {{ __('loading') }}... </x-slot:placeholder>
            <div class="flex items-center mb-6 text-xl gap-2">
                <img src="{{ asset('/storage/student-photos/' . $student->student_image) }}" alt="bakid"
                    class="w-12 h-12 rounded-lg object-cover">
                <div class="flex flex-col">
                    <span class="leading-none">{{ $student->name }}</span>
                    <span class="leading-relaxed text-base">{{ $student->nickname }}</span>
                </div>
            </div>

            <x-splade-form method="put" action="{{ route('mutation.update', $student->nis) }}" :default="$student"
                confirm="Mutasi santri" confirm-text="Apakah yakin ingin memindahkan santri ini?">
                <div class="flex justify-between border-b border-slate-400 my-3">
                    <div class="font-semibold">Asrama</div>
                    <div class="font-semibold mb-3">Sekarang:
                        {{ $student->dormitory[0]?->name . $student->room[0]?->name }}
                    </div>
                </div>
                @php
                    $url = '/api/dormitories/by-student-gender/' . $student->id;
                @endphp

                <x-splade-select class="mb-3" :remote-url="$url" option-label="name" option-value="id"
                    name="dormitory_id" placeholder="{{ __('Pilih Daerah') }}" />

                <x-splade-select class="mb-3" remote-url="`/api/rooms/by-dormitory/${form.dormitory_id}`"
                    option-label="name" option-value="id" name="room_id" placeholder="{{ __('Pilih Asrama') }}" />

                <div class="flex justify-between border-b border-slate-400 my-3">
                    <div class="font-semibold">Formal</div>
                    <div class="font-semibold mb-3">Sekarang:
                        {{ $student->formal?->lembaga?->name . ' (' . $student->formal?->kelas?->class_name . $student->formal?->rombel?->grade_name . ')' }}
                    </div>
                </div>

                <x-splade-select class="mb-3" :options="$formal" option-label="name" option-value="id" name="formal_id"
                    placeholder="{{ __('Formal') }}" />

                <x-splade-select class="mb-3" remote-url="`/api/formal_classes/${form.formal_id}`"
                    option-label="class_name" option-value="id" name="formal_class_id"
                    placeholder="{{ __('Pilih Kelas') }}" />

                <div class="flex justify-between border-b border-slate-400 my-3">
                    <div class="font-semibold">Non-Formal</div>
                    <div class="font-semibold mb-3">Sekarang:
                        {{ $student->informal?->lembaga?->name . ' (' . $student->informal?->kelas?->class_name . $student->informal?->rombel?->grade_name . ')' }}
                    </div>
                </div>
                <x-splade-select class="mb-3" :options="$informal" option-label="name" option-value="id"
                    name="informal_id" placeholder="{{ __('Informal') }}" />
                <x-splade-select class="mb-3" remote-url="`/api/informal_classes/${form.informal_id}`"
                    option-label="class_name" option-value="id" name="informal_class_id"
                    placeholder="{{ __('Pilih Kelas') }}" />



                <x-splade-submit />
            </x-splade-form>
            <div class="fixed bottom-0 right-0 m-6">
                <Link method="put" href="{{ route('mutation.dropout', $student->nis) }}" confirm="Jadikan Alumni"
                    confirm-text="Apakah yakin ingin menjadikan alumi?" confirm-button="Ya, saya yakin"
                    cancel-button="Tidak"
                    class="font-semibold p-2 px-3 bg-red-100 border border-red-500 rounded-lg text-red-600">DROP
                OUT (BOYONG)</Link>
            </div>
        </x-splade-lazy>
    </x-splade-modal>
</x-app-layout>
