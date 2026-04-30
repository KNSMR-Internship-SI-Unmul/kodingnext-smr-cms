<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Koding Next Samarinda',
                'email' => 'admin@kodingnext.com',
                'password' => Hash::make('password'),
                'role_id' => 1,
                'hired_date' => now(),
            ], [
                'name' => 'Rinda Lailatul Arofah, S. Kom.',
                'email' => 'riindalaiilatul@gmail.com',
                'password' => Hash::make('password'),
                'profile_picture' => 'employees/4ZTjMl72n6aGvCpxSSHCj07a5NPgs0KBgCzcdCG0.jpg',
                'hired_date' => '2025-10-01',
                'role_id' => 2,
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
