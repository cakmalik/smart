@hasrole('madin_admin')
    @can('access informal_info')
        <x-menu.web link="{{ route('violation.index') }}" label="Informasi Lembaga" />
    @endcan

    @php
        $u = auth()->user();
        $can = $u->can('access informal_akademik');
        $can = $can || $u->can('access informal_master_kelas');
        $can = $can || $u->can('access informal_master_siswa');
        $can = $can || $u->can('access informal_master_pelajaran');
    @endphp
    
    @if ($can)
        <x-menu.web-mega cols="1" label="PSB">
            <div class="p-4 pb-0 text-gray-900 md:pb-4 dark:text-white">
                <ul class="space-y-4" aria-labelledby="mega-menu-icons-dropdown-button">
                    @can('access informal_akademik')
                        <x-menu.web link="{{ route('student.new') }}" label="Akademik" icon="ph-plus-circle" />
                    @endcan
                    @can('access informal_master_kelas')
                        <x-menu.web link="{{ route('student.new') }}" label="Kelas" icon="ph-plus-circle" />
                    @endcan
                    @can('access informal_master_siswa')
                        <x-menu.web link="{{ route('student.new') }}" label="Siswa" icon="ph-plus-circle" />
                    @endcan
                    @can('access informal_master_pelajaran')
                        <x-menu.web link="{{ route('student.new') }}" label="Pelajaran" icon="ph-plus-circle" />
                    @endcan
                </ul>
            </div>
        </x-menu.web-mega>
    @endif


    @can('access informal_presensi')
        <x-menu.web link="{{ route('violation.index') }}" label="Presensi" />
    @endcan
    @can('access informal_kelola_pelajaran')
        <x-menu.web link="{{ route('violation.index') }}" label="Pelajaran" />
    @endcan
    @can('access informal_kelola_mutasi')
        <x-menu.web link="{{ route('violation.index') }}" label="Mutasi" />
    @endcan
    @can('access informal_kelola_nilai')
        <x-menu.web link="{{ route('violation.index') }}" label="Nilai" />
    @endcan
    @can('access informal_kelola_raport')
        <x-menu.web link="{{ route('violation.index') }}" label="Raport" />
    @endcan
@endhasrole
