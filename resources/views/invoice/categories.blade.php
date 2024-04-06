@seoTitle(__('Invoice Categories'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Invoice Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-splade-table :for="$categories" striped>
                <x-slot:empty-state>
                    <div class="flex justify-center">
                        <lottie-player src="https://lottie.host/e1929754-8ae8-40ae-af73-de3d132e5fb6/ZVkbeMfTvv.json"
                            background="transparent" speed="1" style="width: 300px; height: 300px;" loop
                            autoplay></lottie-player>
                    </div>
                </x-slot:empty-state>

                <x-splade-cell actions as="$category">
                    <Link modal class="py-1 px-2 rounded-md border"
                        href="{{ route('invoice.category.show', ['category' => $category->id, 'isEdit' => true]) }}">
                    {{ __('Edit') }}
                    </Link>
                </x-splade-cell>

            </x-splade-table>

        </div>
    </div>
</x-app-layout>
