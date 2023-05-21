@seoTitle(__('Register'))

<x-authentication-card>
    <x-slot:logo>
        <x-authentication-card-logo />
        </x-slot>

        <x-splade-form class="space-y-4" :action="route('check')">
            <x-splade-input id="name" name="identifier" :label="__('Masukkan Identitas')" placeholder="No KK / Hp / Email / Username"
                required autofocus />
            <div class="flex items-center justify-end">
                <x-splade-submit :label="__('Next')" class="ml-4" />
            </div>
        </x-splade-form>
</x-authentication-card>
