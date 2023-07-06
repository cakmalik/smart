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

        <x-splade-form class="space-y-4">
            <x-splade-input id="email" name="email" type="email" :label="__('Email / Username / KK / No.HP')" required autofocus />
            <x-splade-input id="password" name="password" type="password" :label="__('Password')" required
                autocomplete="current-password" />

            <div class="flex items-center justify-between mt-4">
                <x-splade-checkbox name="remember">{{ __('Ingatkan saya') }}</x-splade-checkbox>
                @if (Route::has('password.request'))
                    <Link href="{{ route('password.request') }}"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Lupa password?') }}
                    </Link>
                @endif
            </div>
            <div class="flex items-center justify-between mt-4">
                <Link href="/"
                    class="relative w-10 h-10 bg-green-500 hover:bg-green-700 rounded-full cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#ffffff"
                    viewBox="0 0 256 256"
                    class="absolute inset-y-0 ml-2 my-auto h-6 w-6 border-transparent peer-focus:border-green-300 peer-focus:stroke-green-500">
                    <path
                        d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z">
                    </path>
                </svg>
                </Link>
                <x-splade-submit :label="__('Masuk')" class="ml-4"/>
            </div>
        </x-splade-form>
</x-authentication-card>
