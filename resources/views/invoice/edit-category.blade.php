<x-app-layout>
    <x-splade-modal>
        <x-splade-form :default="$category" :action="route('invoice.category.update', $category->id)" class="flex flex-col gap-4 p-6" method="put">
            <div class="flex gap-4">
                <div class="w-full flex flex-col gap-4">
                    <x-splade-input name="name" :label="__('Judul/Nama')" placeholder="namamu" />
                    <x-splade-input type="number" name="amount" :label="__('Besar Tagihan')" placeholder="100000" />
                    <x-splade-select name="is_discount_for_siblings" label="Diskon Bersaudara">
                        <option value="0">Tidak</option>
                        <option value="1">Ya</option>
                    </x-splade-select>


                </div>
            </div>
            <button type="submit"
                class="bg-slate-500 p-2 text-white rounded-md text-sm items-center  hover:bg-green-500 w-20">
                Update
            </button>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
