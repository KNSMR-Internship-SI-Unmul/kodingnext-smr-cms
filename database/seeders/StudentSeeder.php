<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            [
            'name' => 'John Doe',
            'school' => 'SMA Kristen Cita Hati',
            'address' => 'Jl. Juanda, Perumahan Batu Alam Permai, No. 1',
            'is_profile_complete' => false,
            'user_id' => 1,
            ], [
            'name' => 'Jane Doe',
            'school' => 'SMAN 1 Samarinda',
            'phone_number' => '0812987654',
            'address' => 'Jl. Siradj Salman, Perumahan Grand Mahakam, Blok A No. 1',
            'is_profile_complete' => true,
            'user_id' => 1, 
            ]
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
