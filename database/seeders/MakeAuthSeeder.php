<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class MakeAuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        User::truncate();
        $super_admin = User::create([
            'name' => 'superadmin',
            'email' => 'superadmin@admin.com',
            'password' => '$2y$08$LE4H5hSpdxI5Lnfgt/CjzufLr9x33ZvDTOUA46Q4ZwbKCNQTa6/va',
        ]);
        $user_admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$08$LE4H5hSpdxI5Lnfgt/CjzufLr9x33ZvDTOUA46Q4ZwbKCNQTa6/va',
        ]);
        $user = User::create([
            'name' => 'user',
            'email' => 'user@admin.com',
            'password' => '$2y$08$LE4H5hSpdxI5Lnfgt/CjzufLr9x33ZvDTOUA46Q4ZwbKCNQTa6/va',
        ]);
        //    Roles

        Role::truncate();
        $roles = [
            'superadmin',
            'admin',
            'member'
        ];
        foreach ($roles as $value) :
            $$value = Role::create(['name' => $value]);
        endforeach;
        DB::table('model_has_roles')->truncate();
        $super_admin->assignRole('superadmin');
        $user_admin->assignRole('admin');
        $user->assignRole('member');
        var_dump($admin->id);exit;

        // Permission::truncate();
        // $permission = [
        //     'can_read',
        //     'can_create',
        //     'can_edit',
        //     'can_delete',
        // ];
        // DB::table('model_has_permissions')->truncate();
        //     $admin = Permission::create(['name' => $value]);
        //     $super_admin->givePermissionTo($$value);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
