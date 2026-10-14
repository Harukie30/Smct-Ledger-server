<?php

namespace Database\Seeders;

use App\Enums\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        $role_admin = Role::create(['name' => Roles::ADMIN]);
        $role_employee = Role::create(['name' => Roles::EMPLOYEE]);

        $sampleAdmin = [
            'name' => 'Admin Test User',
            'email' => 'admin@example.com',
            'password' => 'password'
        ];

        $sampleEmployee = [
            'name' => 'Employee Test User',
            'email' => 'employee@example.com',
            'password' => 'password'
        ];

        $role_admin->users()->create($sampleAdmin);
        $role_employee->users()->create($sampleEmployee);
    }
}
