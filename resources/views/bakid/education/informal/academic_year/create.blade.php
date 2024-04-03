<x-app-layout>
    <x-splade-modal>
        <x-splade-form :action="route('informal.academic_years.store')" class="flex flex-col gap-4" method="post">
            <div class="flex gap-4">
                <div class="w-full flex flex-col gap-4">
                    <x-splade-input name="semester" :label="__('Kwartal')" placeholder="Kwartal / Semester"  />
                    <x-splade-input name="year"  :label="__('Tahun Hijriah')" placeholder="Tahun Hijriah"  />
                    <x-splade-input name="start_date" :label="__('Start Date')" placeholder="Start Date" date />
                    <x-splade-input name="end_date" :label="__('End Date')" placeholder="End Date" date />
                </div>

            </div>
            <button type="submit"
                class="bg-slate-500 p-2 text-white rounded-md text-sm items-center  hover:bg-green-500 w-20">
                Simpan
            </button>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
