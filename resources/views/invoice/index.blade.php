@seoTitle(__('Invoice'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Invoice') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-splade-table :for="$invoices" striped>
                <x-slot:empty-state>
                    <div class="flex justify-center">
                        <lottie-player src="https://lottie.host/e1929754-8ae8-40ae-af73-de3d132e5fb6/ZVkbeMfTvv.json"
                            background="transparent" speed="1" style="width: 300px; height: 300px;" loop
                            autoplay></lottie-player>
                    </div>
                </x-slot:empty-state>

                @cell('action', $invoices)
                    <div class="flex gap-1 ">
                        <Link href="{{ route('invoice.show', $invoices->invoice_number) }}"
                            class="rounded-full flex items-center justify-center gap-1 p-1 bg-slate-500 text-white hover:bg-green-500">
                        <i class="ph-fill ph-pencil-circle"></i>
                        </Link>
                        <Link modal href="{{ route('student.show', $invoices->student_id) }}"
                            class="rounded-full flex items-center justify-center gap-1 p-1 bg-slate-500 text-white hover:bg-green-500">
                        <i class="ph-fill ph-user-circle"></i>
                        </Link>
                    </div>
                @endcell

                @cell('status', $invoices)
                    <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ statusBgColor($invoices->status) . ' ' . statusTextColor($invoices->status) }}">
                        {{ $invoices->status }}
                    </span>
                @endcell
            </x-splade-table>

        </div>
    </div>
</x-app-layout>
