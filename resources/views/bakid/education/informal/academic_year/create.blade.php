<x-app-layout>
    <x-splade-modal>
        <x-splade-form :action="route('user.store')" class="flex flex-col gap-4" method="post">
            <div class="flex gap-4">
                <div class="w-full flex flex-col gap-4">
                    <x-splade-input name="code" :label="__('Kode')"  />
                    <x-splade-input name="semester" :label="__('Kwartal')" placeholder="Kwartal / Semester"  />
                    <x-splade-input name="year" type="year" :label="__('Tahun Hijriah')" />
                </div>

            </div>
            <button type="submit"
                class="bg-slate-500 p-2 text-white rounded-md text-sm items-center  hover:bg-green-500 w-20">
                Simpan
            </button>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
