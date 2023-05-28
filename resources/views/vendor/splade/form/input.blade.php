@php $flatpickrOptions = $flatpickrOptions() @endphp

<SpladeInput {{ $attributes->only(['v-if', 'v-show', 'v-for', 'class'])->class(['hidden' => $isHidden()]) }}
    :flatpickr="@js($flatpickrOptions)" :js-flatpickr-options="{!! $jsFlatpickrOptions !!}" v-model="{{ $vueModel() }}"
    #default="inputScope">
    <label class="block">
        @includeWhen($label, 'splade::form.label', ['label' => $label])

        <div class="flex rounded-md shadow-sm">
            @if ($prepend)
                <span :class="{ 'opacity-50': inputScope.disabled && @json(!$alwaysEnablePrepend) }"
                    class="inline-flex items-center px-3 rounded-l-md bg-gray-50 text-gray-500">
                    {!! $prepend !!}
                </span>
            @endif

            <input
                {{ $attributes->except(['v-if', 'v-show', 'v-for', 'class'])->class([
                        'block w-full border-none focus:ring focus:ring-green-600 disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed bg-white/50',
                        'rounded-md' => !$append && !$prepend,
                        'min-w-0 flex-1 rounded-none' => $append || $prepend,
                        'rounded-l-md' => $append && !$prepend,
                        'rounded-r-md' => !$append && $prepend,
                    ])->merge([
                        'name' => $name,
                        'type' => $type,
                        'data-validation-key' => $validationKey(),
                    ])->when(
                        !$flatpickrOptions,
                        fn($attributes) => $attributes->merge([
                            'v-model' => $vueModel(),
                        ]),
                    ) }} />

            @if ($append)
                <span :class="{ 'opacity-50': inputScope.disabled && @json(!$alwaysEnableAppend) }"
                    class="inline-flex items-center px-3  bg-gray-50 text-gray-500">
                    {!! $append !!}
                </span>
            @endif
        </div>
    </label>

    @include('splade::form.help', ['help' => $help])
    @includeWhen($showErrors, 'splade::form.error', ['name' => $validationKey()])
</SpladeInput>
