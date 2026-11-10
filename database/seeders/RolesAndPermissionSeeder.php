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

        $role_admin = Role::create(['name' => RoleNames::ADMIN->value]);
        $role_uploader = Role::create(['name' => RoleNames::UPLOADER->value]);
        $role_employee = Role::create(['name' => RoleNames::EMPLOYEE->value]);

        $sampleAdmin = [
            "name"          => "Administrator",
            "code"          => "admin",
            "email"         => "admin@gmail.com",
            "branch_code"   => "HO",
            'password'      => 'dapho04051983'
        ];

        $sampleUploader = [
            'name'          => 'Uploader Test User',
            'code'          => 'uploader',
            'email'         => 'uploader@example.com',
            'branch_code'   => 'HO',
            'password'      => 'password'
        ];

        $sampleEmployee = [
            'name'          => 'Employee Test User',
            'code'          => 'employee',
            'email'         => 'employee@example.com',
            'branch_code'   => 'HO',
            'password'      => 'password'
        ];

        $role_admin->users()->create($sampleAdmin);
        $role_uploader->users()->create($sampleUploader);
        $role_employee->users()->create($sampleEmployee);
    }
}
