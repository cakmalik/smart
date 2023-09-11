@seoTitle(__('Choose Payment Method'))

<x-app-layout>
    <x-slot:header>
        <h2 class="font-medium text-xl capitalize">
            {{ __('Choose Payment Method') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl py-12 mx-auto sm:px-6 lg:px-8">
        <div class="grid gap-3 grid-col md:grid-cols-2 mx-3 m-auto sm:p-24 sm:justify-center">
            @forelse ($payment_methods as $i)
                <x-splade-link href="{{ route('payment.change-method') }}" method="POST" :data="[
                    'invoice_number' => $invoice->invoice_number,
                    'payment_method_id' => $i->id,
                ]"
                    preserve-scroll class="w-full bg-white/50 rounded-lg py-6 backdrop-filter backdrop-blur-sm">
                    <div class="flex items-center justify-center my-auto">
                        {{ $i->name }}
                    </div>
                </x-splade-link>
            @empty
            @endforelse
        </div>
    </div>
</x-app-layout>
