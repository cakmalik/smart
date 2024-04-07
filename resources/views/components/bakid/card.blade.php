@props(['header' => '', 'footer' => ''])
<div>
    <!-- Let all your things have their places;
        let each part of your business have its time.
        - Benjamin Franklin -->

    <div {{ $attributes->merge(['class' => 'rounded-xl overflow-hidden']) }}>
        @if ($header != '')
            <div class="py-2 px-3 border-b border-neutral-500 font-semibold bg-white ">
                {{ $header }}
            </div>
        @endif
        <div class="p-3 bg-white/60 dark:bg-slate-800/60 backdrop-blur-md ">
            {{ $slot }}
        </div>
        {{ $footer }}
    </div>
</div>
