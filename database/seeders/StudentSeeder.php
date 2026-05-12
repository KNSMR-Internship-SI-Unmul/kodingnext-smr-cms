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
            'phone_number' => '082152784817',
            'user_id' => 1,
            ], 
            [
            'name' => 'Faiha Farzana Halwa',
            'school' => 'TK ABA 7 Samarinda',
            'phone_number' => '082329303555',
            'user_id' => 1,
            ],
            [
            'name' => 'Abdurahman Nur Tajri',
            'school' => 'SDIT Al Firdaus samarinda',
            'phone_number' => '081350113256',
            'user_id' => 1,
            ],
            [
            'name' => 'Aisyah Ayudia Inara',
            'school' => 'SD Muhamadiyah',
            'phone_number' => '082211352840',
            'user_id' => 1,
            ],
        ];

        foreach ($students as $student) {
            Student::updateOrCreate(
                ['name' => $student['name']],
                $student
            );
        }
    }
}