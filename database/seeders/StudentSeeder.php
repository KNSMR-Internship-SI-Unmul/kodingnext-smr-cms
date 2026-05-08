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
            'name' => 'Eugenia Goshen Kurniawan',
            'school' => 'Nido Montessori School',
            'user_id'       => 1,
            ], 
            [
            'name' => 'Faiha Farzana Halwa',
            'school' => 'TK ABA 7 Samarinda',
            'user_id'       => 1,
            ],
            [
            'name' => 'Abdurahman Nur Tajri',
            'school' => 'SDIT Al Firdaus samarinda',
            'user_id'       => 1,
            ],
            [
            'name' => 'Aisyah Ayudia Inara',
            'school' => 'SD Muhamadiyah',
            'user_id'       => 1,
            ],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
