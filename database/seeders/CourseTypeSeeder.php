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
                'description' => 'Kursus Coding ini dirancang untuk membantu siswa-siswi mengenal dunia pemrograman sejak dini dengan cara yang seru, interaktif, dan mudah dipahami. Melalui pembelajaran berbasis praktik langsung, peserta dapat mengembangkan kemampuan berpikir logis, kreativitas, serta keterampilan pemecahan masalah dan matematika. Didukung oleh pengajar berpengalaman dan metode belajar yang menarik, setiap siswa akan mendapatkan pengalaman belajar yang menyenangkan sekaligus bermanfaat untuk masa depan mereka.',
                'image' => 'courses/2rX0rVIdcRQ3GazNQYoA1D94jSDR0teqY7AjkeK0.jpg',
                'user_id' => 1,
            ], 
            [
                'name' => 'Junior Koders',
                'description' => 'Program ini dirancang khusus untuk siswa usia 8 hingga 16 tahun yang ingin mulai mengenal dunia teknologi dan pemrograman. Peserta akan belajar dari tingkat dasar menggunakan pemrograman berbasis blok untuk membuat game 2D dan aplikasi mobile sederhana, hingga tingkat lanjutan menggunakan bahasa pemrograman populer seperti Python dan JavaScript serta teknologi Smart Home IoT. Dengan materi yang mengikuti perkembangan tren digital terbaru, program ini membantu siswa mengembangkan keterampilan teknologi, kreativitas, dan kemampuan problem solving yang relevan untuk masa depan.',
                'image' => 'courses/zcUvNeEFMjBeWMFN9PjWzqPjAQ8LK4BnmsrJR8NL.jpg',
                'user_id' => 1,
            ], 
            [
                'name' => 'RoboNext',
                'description' => 'Program ini dirancang untuk mengenalkan dunia robotika dan teknologi kepada anak-anak melalui pembelajaran yang interaktif dan praktik langsung. Peserta akan belajar coding, merakit robot, serta memahami cara kerja teknologi untuk menciptakan solusi dari berbagai permasalahan di kehidupan sehari-hari. Dengan metode belajar yang seru dan kreatif, program ini membantu mengembangkan kemampuan berpikir logis, inovasi, dan keterampilan teknologi sejak dini.',
                'image' => 'courses/NPBXnFHquexMRfHNRlNNEvODhjSTUMsOHuV2kySp.jpg',
                'user_id' => 1,
            ]
        ];

        foreach ($courseTypes as $courseType) {
            CourseType::create($courseType);
        }
    }
}
