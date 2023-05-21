@seoTitle(__('Log in'))

<x-authentication-card>
    <x-slot:logo>
        <x-authentication-card-logo />
        </x-slot>

        @if ($status = session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $status }}
            </div>
        @endif
        @isset($user)
            <x-splade-form class="space-y-4" :action="route('check')">
                <x-splade-input id="name" name="identifier" :label="__('Masukkan Identitas')" placeholder="No KK / Hp / Email / Username"
                    required autofocus />
                <div class="flex items-center justify-end">
                    <x-splade-submit :label="__('Next')" class="ml-4" />
                </div>
            </x-splade-form>
        @endisset

        <x-splade-form class="space-y-4" :action="route('login.post')" :default="$user">
            <input type="text" hidden name="key" :value="$user[0]">
            <x-splade-input id="identifier" name="value" type="text" :label="__('Identifier')" required autofocus
                value="$user[1]" />
            <x-splade-input id="password" name="password" type="password" :label="__('Password')" required
                autocomplete="current-password" />
            <x-splade-checkbox name="remember">{{ __('Remember me') }}</x-splade-checkbox>

            <div class="flex items-center justify-end mt-4">
                {{-- @if (Route::has('password.request'))
                    <Link href="{{ route('password.request') }}"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Forgot your password?') }}
                    </Link>
                @endif --}}

                <x-splade-submit :label="__('Log in')" class="ml-4" />
            </div>
        </x-splade-form>
</x-authentication-card>
