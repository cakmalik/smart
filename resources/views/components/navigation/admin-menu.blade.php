<x-splade-data store="mobileNavigation" default="{ open: false }" />
{{-- MENU WEB --}}
<nav class="hidden sm:block bg-white border-gray-200 dark:bg-gray-900">
    <div class="flex flex-wrap items-center justify-center max-w-screen-xl mx-auto p-4 overflow-x-scroll">
        <a href="https://bakid.id" class="flex  items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('bakid/logo-ppmu.png') }}" class="h-8" alt="Flowbite Logo" />
            <span
                class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">{{ config('app.name') }}</span>
        </a>
    </div>
    <div class="flex flex-wrap items-center justify-center max-w-screen-xl mx-auto p-4 overflow-x-scroll">
        <div id="mega-menu-icons" class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1">
            <ul class="flex flex-col mt-4 font-medium md:flex-row md:mt-0 md:space-x-8 rtl:space-x-reverse">
              @include('components.navigation.web.layout')
            </ul>
        </div>
    </div>
</nav>

<x-splade-rehydrate on="refresh-navigation-menu, profile-information-updated">
    @include('components.navigation.mobile.layout')
</x-splade-rehydrate>
