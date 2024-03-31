@seoTitle(__('Dashboard'))
<x-app-layout>
    <x-slot:header>
        <div class="flex justify-between items-center gap-3">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 malik-card">
            asdasdads
            <br>
            afafs
            <br>
            {{-- jika akun wali murid yang sudah punya anak terdaftar --}}
            @if (roleName() == 'santri' && isHasStudents() != 0)
                {{-- <div class="grid grid-cols-2 gap-2 mb-4 sm:grid-cols-4 sm:gap-3">
                        <x-card.summary />
                        <x-card.summary />
                        <x-card.summary />
                        <x-card.summary />
                    </div> --}}
                <x-splade-rehydrate on="done-admission">
                    <x-dashboard.santri-baru :data="$x" />
                </x-splade-rehydrate>
                {{-- akun wali murid yang belum pernah mendaftarkan anaknya --}}
            @elseif (roleName() == 'santri' && isHasStudents() == 0)
                <x-welcome />
                {{-- untuk admin --}}
            @else
                {{-- <div class="p-5 overflow-hidden shadow-xl bg-white/30 sm:rounded-lg backdrop-blur-md"> --}}
                @switch(roleName())
                    @case('admin')
                    @break

                    @case('sekretaris')
                        @include('dashboard.sekretaris')
                    @break

                    @default
                @endswitch
                {{-- </div> --}}
            @endif
        </div>
    </div>
</x-app-layout>
