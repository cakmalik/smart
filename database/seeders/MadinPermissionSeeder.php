<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MadinPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $madin_info = ['access informal_info', 'view informal_info', 'create informal_info', 'update informal_info', 'delete informal_info'];
        $madin_akademik = ['access informal_akademik', 'view informal_akademik', 'create informal_akademik', 'update informal_akademik', 'delete informal_akademik'];
        $madin_master_kelas = ['access informal_master_kelas', 'view informal_master_kelas', 'create informal_master_kelas', 'update informal_master_kelas', 'delete informal_master_kelas'];
        $madin_master_siswa = ['access informal_master_siswa', 'view informal_master_siswa', 'create informal_master_siswa', 'update informal_master_siswa', 'delete informal_master_siswa'];
        $madin_master_pelajaran = ['access informal_master_pelajaran', 'view informal_master_pelajaran', 'create informal_master_pelajaran', 'update informal_master_pelajaran', 'delete informal_master_pelajaran'];
        $madin_master_guru = ['access informal_master_guru', 'view informal_master_guru', 'create informal_master_guru', 'update informal_master_guru', 'delete informal_master_guru'];
        $madin_presensi = ['access informal_presensi', 'view informal_presensi', 'create informal_presensi', 'update informal_presensi', 'delete informal_presensi'];
        $madin_kelola_pelajaran = ['access informal_kelola_pelajaran', 'view informal_kelola_pelajaran', 'create informal_kelola_pelajaran', 'update informal_kelola_pelajaran', 'delete informal_kelola_pelajaran'];
        $madin_kelola_mutasi = ['access informal_kelola_mutasi', 'view informal_kelola_mutasi', 'create informal_kelola_mutasi', 'update informal_kelola_mutasi', 'delete informal_kelola_mutasi'];
        $madin_kelola_nilai = ['access informal_kelola_nilai', 'view informal_kelola_nilai', 'create informal_kelola_nilai', 'update informal_kelola_nilai', 'delete informal_kelola_nilai'];
        $madin_kelola_raport = ['access informal_kelola_raport', 'view informal_kelola_raport', 'create informal_kelola_raport', 'update informal_kelola_raport', 'delete informal_kelola_raport'];

         // madin menu
         $madin_menu_permission = array_merge(
        $madin_info,
        $madin_akademik,
        $madin_master_kelas,
        $madin_master_siswa,
        $madin_master_guru,
        $madin_master_pelajaran,
        $madin_presensi,
        $madin_kelola_pelajaran,
        $madin_kelola_mutasi,
        $madin_kelola_nilai,
        $madin_kelola_raport
        );

        foreach ($madin_menu_permission as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }


         $madin = Role::where('name', 'madin_admin')->first();
         $madin->givePermissionTo($madin_menu_permission);
    }
}