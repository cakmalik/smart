<x-banner />

<div class="min-h-screen bg-gray-100 "
    style="background-image: url('{{ asset('bakid/bg-bakid.png') }}'); background-size: cover; background-position: center;background-attachment: fixed;">
    <x-navigation />

    <!-- Page Heading -->
    @isset($header)
        <header class="shadow bg-green-100/50">
            <div class="max-w-7xl mx-auto py-3  px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
