<x-banner />

<div class="min-h-screen bg-green-200"
    style="background-image: url('{{ asset('bg/' . env('CURRENT_BACKGROUND') . '.jpg') }}'); background-size: cover; background-position: center;background-attachment: fixed;">
    <x-navigation />

    <!-- Page Heading -->
    @isset($header)
        <header class="text-center sm:text-start shadow bg-wa-teal2  backdrop-filter backdrop-blur-lg">
            <div class="max-w-7xl mx-auto py-3  px-4 sm:px-6 lg:px-8 text-white">
                <div class="flex items-center justify-start gap-3 ">
                    <img src="{{ asset('bakid/logo-ppmu.png') }}" alt="Logo" class="w-10 h-10 sm:hidden" />
                    {{ $header }}
                </div>
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
