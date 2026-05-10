<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CourseType;

class CourseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courseTypes = [
            [
                'name' => 'Little Koders',
                'description' => 'Kursus coding ini dirancang untuk mengajarkan siswa sejak usia 4-8 tentang pemrograman dan meningkatkan pemikiran logis serta keterampilan matematika mereka.',
                'image' => 'courses/2rX0rVIdcRQ3GazNQYoA1D94jSDR0teqY7AjkeK0.jpg',
                'user_id' => 1,
            ], 
            [
                'name' => 'Junior Koders',
                'description' => 'Kursus coding ini diperuntukkan bagi siswa berusia 8 hingga 16 tahun. Program ini menawarkan kursus pemula dalam pemrograman blok, seperti Game 2D dan Pengembangan Aplikasi Mobile, dan kursus lanjutan dalam pemrograman berbasis teks, seperti Python, JavaScript, dan Smart Home IoT.',
                'image' => 'courses/zcUvNeEFMjBeWMFN9PjWzqPjAQ8LK4BnmsrJR8NL.jpg',
                'user_id' => 1,
            ], 
            [
                'name' => 'RoboNext',
                'description' => 'Kursus robotika dari Koding Next ini dirancang untuk memperkenalkan teknologi melalui pengalaman langsung. Siswa tidak hanya belajar coding dan merakit robot, tetapi juga memahami cara teknologi bekerja untuk menyelesaikan masalah dunia nyata.',
                'image' => 'courses/NPBXnFHquexMRfHNRlNNEvODhjSTUMsOHuV2kySp.jpg',
                'user_id' => 1,
            ]
        ];

        foreach ($courseTypes as $courseType) {
            CourseType::create($courseType);
        }
    }
}
