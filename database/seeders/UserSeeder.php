<?php

namespace Database\Seeders;

use App\Enums\RoleNames;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(5)->create()->each(fn($q) => $q->assignRole(RoleNames::EMPLOYEE));
    }
}
