<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'marketing' => [
                'email' => 'marketing@example.com',
                'name' => 'marketing'
            ],
            'teknisi' => [
                'email' => 'teknisi@example.com',
                'name' => 'teknisi'
            ],
        ];

        foreach ($roles as $roleName => $data) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => bcrypt('password123'),
                ]
            );

            if (!$user->hasRole($roleName)) {
                $user->assignRole($role);
            }
        }
    }
}
