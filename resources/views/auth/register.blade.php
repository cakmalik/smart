@seoTitle(__('Register'))

<x-authentication-card>
    <x-slot:logo>
        <x-authentication-card-logo />
        </x-slot>

        <x-splade-form class="space-y-2">
            <x-splade-input id="name" name="name" :label="__('Nama')" required autofocus />
            <x-splade-input id="email" name="email" type="email" :label="__('Email')" required />
            <x-splade-input id="kk" name="kk" type="text" :label="__('No KK')" required />
            <x-splade-input id="phone" name="phone" type="text" :label="__('No Hp/Wa')" required />
            <x-splade-input id="password" name="password" type="password" :label="__('Password')" required
                autocomplete="new-password" />
            <x-splade-input id="password_confirmation" name="password_confirmation" type="password" :label="__('Confirm Password')"
                required autocomplete="new-password" />

            @if (\Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <x-splade-checkbox name="terms">
                    {!! __('Saya setuju :terms_of_service and :privacy_policy', [
                        'terms_of_service' =>
                            '<Link modal href="' .
                            route('terms.show') .
                            '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">' .
                            __('Syarat Layanan') .
                            '</Link>',
                        'privacy_policy' =>
                            '<Link modal href="' .
                            route('policy.show') .
                            '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">' .
                            __('Kebijakan Privasi') .
                            '</Link>',
                    ]) !!}
                </x-splade-checkbox>
            @endif

            <div class="flex items-center justify-between pt-11">
                <Link href="{{ route('login') }}"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                {{ __('Sudah pernah mendaftar?') }}
                </Link>

                {{-- <x-splade-submit :label="__('Mendaftar')" class="" secondary /> --}}
                <x-bakid-button />
            </div>
        </x-splade-form>
</x-authentication-card>
