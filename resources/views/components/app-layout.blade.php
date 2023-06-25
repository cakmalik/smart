<x-banner />

<div class="min-h-screen bg-green-300"
    style="background-image: url('{{ asset('bakid/blobanimation.svg') }}'); background-size: cover; background-position-x:10%; background-position-y:80%; background-attachment: fixed;">
    <x-navigation />

    <!-- Page Heading -->
    @isset($header)
        <header class="text-center sm:text-start shadow bg-green-100/50 backdrop-filter backdrop-blur-lg">
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
