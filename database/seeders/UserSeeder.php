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
                'email' => 'riindalaiilatul@gmail.com',
                'password' => Hash::make('password'),
                'profile_picture' => 'employees/bj6dpcx8J1ny0cuy4OLXFWMeGsWYgJ4bB78y1mSw.jpg',
                'hired_date' => '2025-10-01',
                'role_id' => 2,
            ],
            [
                'name' => 'Febrina Wahyu Ibtyani, S. Kom.',
                'email' => 'febrina@dummy.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
            ],
            [
                'name' => 'Eko Kurnia Setya Gunawan, S. Kom.',
                'email' => 'eko.workingtime@gmail.com',
                'password' => Hash::make('password'),
                'profile_picture' => 'employees/0nrCCkS76hF0peQ0znxKPsXvg8s0t4wj1IhfWUQ1.jpg',
                'hired_date' => '2023-07-15',
                'role_id' => 3,
            ],
            [
                'name' => 'Muhammad Rifaldi, S. Kom.',
                'email' => 'rifal@dummy.com',
                'password' => Hash::make('password'),
                'profile_picture' => 'employees/lM67lROgyRTReRAPdHy2ay68prhznVd2nWP3rldD.jpg',
                'role_id' => 3,
            ],
            [
                'name' => 'Aura Amellia, S. Kom.',
                'email' => 'aura@dummy.com',
                'password' => Hash::make('password'),
                'profile_picture' => 'employees/uwiRu4RLwCowDL6kV7HiU69lBzrpuPQJAwSzk7qk.jpg',
                'role_id' => 3,
            ],
            [
                'name' => 'Muhammad Kurnia Dewanto Ramadhansyah, S. Kom.',
                'email' => 'dewodewo31104@gmail.com',
                'password' => Hash::make('password'),
                'profile_picture' => 'employees/LGRguexXp27tyhqpKx4NC5gn5QYvKjddusy283UO.jpg',
                'hired_date' => '2025-09-01',
                'role_id' => 4,
            ],
            [
                'name' => 'Muhammad Basith Algifari, S. Kom.',
                'email' => 'gial@dummy.com',
                'password' => Hash::make('password'),
                'profile_picture' => 'employees/ViGqkUL6RefHySPf1rCl5TZEQ0mmsYHAjP9xd3VG.jpg',
                'role_id' => 4,
            ],
            [
                'name' => 'Ahmad Lutfi Alfares, S. Kom.',
                'email' => 'lutfi@dummy.com',
                'password' => Hash::make('password'),
                'profile_picture' => 'employees/4SOJuTspbUnYyYihp3JaHUo72l8ItQGGt8D8pvck.jpg',
                'role_id' => 4,
            ],
            [
                'name' => 'Muhammad Nizar, S. Kom',
                'email' => 'nizares234@gmai.com',
                'password' => Hash::make('password'),
                'profile_picture' => 'employees/Xfl5P1dtU2fUzsBFudwMX1Cab3boCByuOKTiBpmh.jpg',
                'hired_date' => '2025-03-01',
                'role_id' => 4,
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
