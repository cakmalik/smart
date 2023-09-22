<x-app-layout>
    <x-splade-modal>
        <x-splade-form :action="route('invoice.discount.store', $categoryId)" class="flex flex-col gap-4 p-6" method="post">
            <div class="flex gap-4">
                <div class="w-full flex flex-col gap-4">
                    <x-splade-input name="number_of_child" v-model="form.number_of_child" type="number"
                        :label="__('Number of child')" />
                    <x-splade-input name="discount_amount" v-model="form.discount_amount" type="number"
                        :label="__('Discount amount')" />
                    <x-splade-select name="discount_type" v-model="form.discount_type" :label="__('Discount type')">
                        <option value="amount">Amount</option>
                        <option value="percentage">Percentage</option>
                    </x-splade-select>
                </div>
            </div>
            <div class="flex justify-between items-center">
                <button type="submit"
                    class="bg-wa-teal2 p-2 text-white rounded-md text-sm items-center  hover:bg-wa-light w-20">
                    {{ __('Add') }}
                </button>
            </div>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
