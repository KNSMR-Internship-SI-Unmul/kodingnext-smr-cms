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
            ], 
            [
                'name' => 'Rinda Lailatul Arofah, S. Kom.',
                'phone_number' => '082256903956',
                'email' => 'riindalaiilatul@gmail.com',
                'password' => Hash::make('password'),
                'profile_picture' => 'employees/bj6dpcx8J1ny0cuy4OLXFWMeGsWYgJ4bB78y1mSw.jpg',
                'hired_date' => '2025-10-01',
                'role_id' => 2,
            ],
            [
                'name' => 'Febrina Wahyu Ibtyani, S. Kom.',
                'phone_number' => '0895336288283',
                'email' => 'febrina@kodingnext.com',
                'password' => Hash::make('password'),
                'hired_date' => '2024-07-27',
                'role_id' => 2,
            ],
            [
                'name' => 'Eko Kurnia Setya Gunawan, S. Kom.',
                'phone_number' => '085654827429',
                'email' => 'eko.workingtime@gmail.com',
                'password' => Hash::make('password'),
                'profile_picture' => 'employees/0nrCCkS76hF0peQ0znxKPsXvg8s0t4wj1IhfWUQ1.jpg',
                'hired_date' => '2023-07-15',
                'role_id' => 3,
            ],
            [
                'name' => 'Muhammad Rifaldi, S. Kom.',
                'phone_number' => '087810884296',
                'email' => ' rifaldi@kodingnext.com',
                'password' => Hash::make('password'),
                'profile_picture' => 'employees/lM67lROgyRTReRAPdHy2ay68prhznVd2nWP3rldD.jpg',
                'hired_date' => '2023-11-20',
                'role_id' => 3,
            ],
            [
                'name' => 'Aura Amellia, S. Kom.',
                'phone_number' => '082154197889',
                'email' => 'auraamellia08@koding.next',
                'password' => Hash::make('password'),
                'profile_picture' => 'employees/uwiRu4RLwCowDL6kV7HiU69lBzrpuPQJAwSzk7qk.jpg',
                'role_id' => 3,
            ],
            [
                'name' => 'Muhammad Kurnia Dewanto Ramadhansyah, S. Kom.',
                'phone_number' => '082148581483',
                'email' => 'dewodewo31104@gmail.com',
                'password' => Hash::make('password'),
                'profile_picture' => 'employees/LGRguexXp27tyhqpKx4NC5gn5QYvKjddusy283UO.jpg',
                'hired_date' => '2025-09-01',
                'role_id' => 4,
            ],
            [
                'name' => 'Muhammad Basith Algifari, S. Kom.',
                'phone_number' => '081257051404',
                'email' => 'muhammad.basith18@gmail.com',
                'password' => Hash::make('password'),
                'profile_picture' => 'employees/ViGqkUL6RefHySPf1rCl5TZEQ0mmsYHAjP9xd3VG.jpg',
                'role_id' => 4,
            ],
            [
                'name' => 'Ahmad Lutfi Alfares, S. Kom.',
                'phone_number' => '085787059687',
                'email' => 'ahmadlutfialfares7@gmail.com',
                'password' => Hash::make('password'),
                'profile_picture' => 'employees/4SOJuTspbUnYyYihp3JaHUo72l8ItQGGt8D8pvck.jpg',
                'hired_date' => '2024-11-20',
                'role_id' => 4,
            ],
            [
                'name' => 'Muhammad Nizar, S. Kom.',
                'phone_number' => '087810871445',
                'email' => 'nizares234@gmail.com',
                'password' => Hash::make('password'),
                'profile_picture' => 'employees/Xfl5P1dtU2fUzsBFudwMX1Cab3boCByuOKTiBpmh.jpg',
                'hired_date' => '2025-03-01',
                'role_id' => 4,
            ]
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }
    }
}
