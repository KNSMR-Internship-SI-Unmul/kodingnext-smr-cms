<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StudentProject;

class StudentProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studentProjects = [
            [
            'title'          => 'Run Fly Run',
            'description'   => 'This project was made by Euginia.',
            'date'          => now(),
            'media'         => '',
            'is_published'  => true,
            'module_id'     => 4,
            'student_id'    => 1,
            ], 
            [
            'title'          => 'Aku Suka Bersih Bersih',
            'description'   => 'This project was made by Halwa.',
            'date'          => now(),
            'media'         => '',
            'is_published'  => true,
            'module_id'     => 4,
            'student_id'    => 2,
            ],
            [
            'title'          => '2D Games',
            'description'   => 'This project was made by Abdurrahman.',
            'date'          => now(),
            'media'         => '',
            'is_published'  => true,
            'module_id'     => 10,
            'student_id'    => 3,
            ],
            [
            'title'          => 'The Police Games',
            'description'   => 'This project was made by Aisyah.',
            'date'          => now(),
            'media'         => '',
            'is_published'  => true,
            'module_id'     => 10,
            'student_id'    => 4,
            ]
        ];

        foreach ($studentProjects as $studentProject) {
            StudentProject::create($studentProject);
        }
    }
}
