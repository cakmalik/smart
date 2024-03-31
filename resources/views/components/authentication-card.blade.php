<div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0 "
    style="background-image: url('{{ asset('bg/' . env('CURRENT_BACKGROUND') . '.jpg') }}'); background-size: cover; background-position: center;background-attachment: fixed;">
    <div>
        {{ $logo }}
    </div>

    <div
        class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-xl malik-bg">
        {{ $slot }}
    </div>
</div>
