<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();


        // create permissions
        // user

        // Permission::firstOrCreate(['name' => 'Dashboard.Index']);
        // Permission::firstOrCreate(['name' => 'Data Wilayah.Kecamatan']);
        // Permission::firstOrCreate(['name' => 'Data Wilayah.Kelurahan']);
        // Permission::firstOrCreate(['name' => 'Ruas Jalan.Kelurahan']);
        // Permission::firstOrCreate(['name' => 'Data Pemeliharaan.Penyedia Jasa']);
        // Permission::firstOrCreate(['name' => 'Data Pemeliharaan.Riwayat Pemeliharaan']);
        // Permission::firstOrCreate(['name' => 'Administrator.Data User']);
        // Permission::firstOrCreate(['name' => 'Administrator.Data Role']);
        // Permission::firstOrCreate(['name' => 'Administrator.Setting']);

        Permission::firstOrCreate(['name' => 'Dashboard.Index']);
        Permission::firstOrCreate(['name' => 'Data Wilayah.Index']);
        Permission::firstOrCreate(['name' => 'Data Wilayah.Kecamatan']);
        Permission::firstOrCreate(['name' => 'Data Wilayah.Kelurahan']);
        Permission::firstOrCreate(['name' => 'Ruas Jalan.Index']);
        Permission::firstOrCreate(['name' => 'Ruas Jalan.Kelurahan']);
        Permission::firstOrCreate(['name' => 'Data Pemeliharaan.Index']);
        Permission::firstOrCreate(['name' => 'Data Pemeliharaan.Penyedia Jasa']);
        Permission::firstOrCreate(['name' => 'Data Pemeliharaan.Riwayat Pemeliharaan']);
        Permission::firstOrCreate(['name' => 'Administrator.Index']);
        Permission::firstOrCreate(['name' => 'Administrator.Hak Akses']);
        Permission::firstOrCreate(['name' => 'Administrator.Data User']);
        Permission::firstOrCreate(['name' => 'Administrator.Setting']);

        // Assigning super admin
        User::truncate();
        $superAdminRole = Role::firstOrCreate(['name' => 'Super-Admin']);
        $superAdminPermissions = [
            'Dashboard.Index',
            'Data Wilayah.Index',
            'Data Wilayah.Kecamatan',
            'Data Wilayah.Kelurahan',
            'Ruas Jalan.Index',
            'Ruas Jalan.Kelurahan',
            'Data Pemeliharaan.Index',
            'Data Pemeliharaan.Penyedia Jasa',
            'Data Pemeliharaan.Riwayat Pemeliharaan',
            'Administrator.Index',
            'Administrator.Hak Akses',
            'Administrator.Data User',
            'Administrator.Setting',
        ];
        $superAdminRole->syncPermissions($superAdminPermissions);

        $user = \App\Models\User::where('username', 'Admin')->first();
        if (!$user) {
            $user = \App\Models\User::firstOrCreate([
                'name' => 'Administrator',
                'username' => 'Admin',
                'password' => bcrypt('perkim2022'),
                'avatar' => 'avatar-default.png',
            ]);
            echo "username: Admin\n";
            echo "password: perkim2022\n";
        }


        $user->assignRole($superAdminRole);

        // default role
        $generalRole = Role::firstOrCreate(['name' => 'General']);
        $generalPermissions = [
            'Dashboard.Index',
        ];
        $generalRole->syncPermissions($generalPermissions);
    }
}
