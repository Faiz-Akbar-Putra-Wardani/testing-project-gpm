<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;


class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ownerRole = Role::firstOrCreate(['name' => 'owner']);

        $owner = User::firstOrCreate(
            ['email' => 'owner@example.com'],
            [
                'name' => 'Super Owner',
                'password' => bcrypt('password123'),
            ]
        );

        if (!$owner->hasRole('owner')) {
            $owner->assignRole($ownerRole);
        }
    }
}
