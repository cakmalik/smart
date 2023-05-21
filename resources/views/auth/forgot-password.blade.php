@seoTitle(__('Forgot Password'))

<x-authentication-card>
    <x-slot:logo>
        <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{-- {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }} --}}
            {{ __('Beri tahu kami Email atau No KK anda, kami akan segera memberikan notifikasi perubahan password.') }}
        </div>

        @if ($status = session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $status }}
            </div>
        @endif

        <x-splade-form class="space-y-4" :action="route('password.email')">
            <x-splade-input id="email" name="email" type="email" :label="__('Email atau No.KK')" required autofocus />

            <div class="flex items-center justify-end mt-4">
                <x-splade-submit :label="__('Kirim link reset')" />
            </div>
        </x-splade-form>
</x-authentication-card>
