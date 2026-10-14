<?php

namespace Database\Seeders;

use App\Enums\RoleNames;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $role_admin = Role::create(['name' => RoleNames::ADMIN]);
        $role_uploader = Role::create(['name' => RoleNames::UPLOADER]);
        $role_employee = Role::create(['name' => RoleNames::EMPLOYEE]);

        $sampleAdmin = [
            'name'          => 'Admin Test User',
            'branch_code'   => 'admin',
            'email'         => 'admin@example.com',
            'password'      => 'password'
        ];

        $sampleUploader = [
            'name'          => 'Uploader Test User',
            'branch_code'   => 'uploader',
            'email'         => 'uploader@example.com',
            'password'      => 'password'
        ];

        $sampleEmployee = [
            'name'          => 'Employee Test User',
            'branch_code'   => 'employee',
            'email'         => 'employee@example.com',
            'password'      => 'password'
        ];

        $role_admin->users()->create($sampleAdmin);
        $role_uploader->users()->create($sampleUploader);
        $role_employee->users()->create($sampleEmployee);
    }
}
