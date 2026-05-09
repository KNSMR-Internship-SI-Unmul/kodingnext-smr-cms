<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GeneralTestimonial;

class GeneralTestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'parents_name'  => 'Alya Rizqi Ramadhani',
                'review_content'=> 'Anak saya jadi lebih tertarik belajar teknologi sejak ikut kelas coding di sini. Cara mengajarnya seru dan mudah dipahami, jadi anak tidak cepat bosan. Sekarang dia juga lebih percaya diri saat membuat project sendiri.',
                'is_published'  => true,
                'user_id'       => 1,
            ],
            [
                'parents_name'  => 'Alyssa Dwiana Mulia',
                'review_content'=> 'Program pembelajarannya sangat bagus untuk anak-anak. Selain belajar coding, anak saya juga jadi lebih terlatih berpikir logis dan kreatif dalam menyelesaikan masalah. Pengajarnya juga ramah dan sabar.',
                'is_published'  => true,
                'user_id'       => 1,
            ],
            [
                'parents_name'  => 'Nova Nur Fauziah',
                'review_content'=> 'Awalnya anak saya hanya suka bermain game, tetapi setelah mengikuti kursus ini dia mulai tertarik membuat game sederhana sendiri. Saya senang karena kegiatan belajarnya terasa menyenangkan sekaligus bermanfaat untuk perkembangan skill anak.',
                'is_published'  => true,
                'user_id'       => 1,
            ],
            [
                'parents_name'  => 'Najla Nayla Putri',
                'review_content'=> 'Menurut saya biaya kursusnya memang cukup mahal dibanding beberapa tempat lain, jadi awalnya saya sempat ragu untuk mendaftarkan anak saya. Tetapi setelah melihat materi, fasilitas, dan perkembangan kemampuan anak selama belajar, saya merasa kualitas yang diberikan cukup sebanding.',
                'is_published'  => false,
                'user_id'       => 1,
            ]
        ];

        foreach ($testimonials as $testimonial) {
            GeneralTestimonial::create($testimonial);
        }
    }
}
