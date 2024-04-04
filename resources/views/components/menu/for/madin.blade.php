@hasrole('madin_admin')
    
    @php
        $u = auth()->user();
        $can = $u->can('access informal_akademik');
        $can = $can || $u->can('access informal_master_kelas');
        $can = $can || $u->can('access informal_master_siswa');
        $can = $can || $u->can('access informal_master_pelajaran');
    @endphp

    @if ($can)
        <x-menu.web-mega cols="1" label="Master">
            <div class="p-4 pb-0 text-gray-900 md:pb-4 dark:text-white">
                <ul class="space-y-4" aria-labelledby="mega-menu-icons-dropdown-button">
                    @can('access informal_akademik')
                        <x-menu.web link="{{ route('informal.academic_years.index') }}" label="Akademik" icon="ph-graduation-cap" />
                    @endcan
                    @can('access informal_master_kelas')
                        <x-menu.web link="{{ route('informal.class.index') }}" label="Kelas" icon="ph-user-list" />
                    @endcan
                    @can('access informal_master_siswa')
                        <x-menu.web link="{{ route('informal.student.index') }}" label="Siswa" icon="ph-users" />
                    @endcan
                    @can('access informal_master_pelajaran')
                        <x-menu.web link="{{ route('informal.subject.index') }}" label="Pelajaran" icon="ph-notebook" />
                    @endcan
                    @can('access informal_master_guru')
                        <x-menu.web link="{{ route('informal.teacher.index') }}" label="Guru" icon="ph-user" />
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

    @can('access informal_info')
        <x-menu.web link="{{ route('violation.index') }}" label="Profil" />
    @endcan

@endhasrole
