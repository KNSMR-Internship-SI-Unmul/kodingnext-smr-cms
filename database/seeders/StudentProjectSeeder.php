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
            'description'   => 'Game ini merupakan student project berupa game sederhana di mana pemain harus mengontrol karakter agar tetap terbang dengan cara men-tap karakter untuk melompat. Pemain harus menghindari kaktus dan berbagai rintangan yang muncul, karena jika karakter terkena rintangan maka permainan akan berakhir.',
            'media'         => 'student-projects/OCEb2oG9rOLm3XedisoS0H873Ui3J7D8lQcB61ZB.mp4',
            'is_published'  => true,
            'module_id'     => 4,
            'student_id'    => 1,
            ], 
            [
            'title'          => 'Aku Suka Bersih Bersih',
            'description'   => 'Game sederhana tentang kucing yang mengikuti perintah dari peri menggunakan tombol panah. Pemain menggerakkan kucing untuk menjalankan tugas seperti mengambil sampah. Game ini dibuat untuk belajar arah dan logika dengan cara yang seru.',
            'media'         => 'student-projects/urZ4OKf60pRcNcyhxUJbLfIfhjPrfchCrgWYJ2Q3.mp4',
            'is_published'  => true,
            'module_id'     => 4,
            'student_id'    => 2,
            ],
            [
            'title'          => '2D Games',
            'description'   => 'Game robot sederhana dimana pemain mengendalikan robot untuk menembak musuh. Pemain harus menghindari serangan lawan sambil mendapatkan score sebanyak mungkin. Game ini memiliki fitur score dan live untuk menambah tantangan permainan.',
            'media'         => 'student-projects/QdEgP20KrXmQQuDruritr4o1giwHcaxMzfkb2WZ3.mp4',
            'is_published'  => true,
            'module_id'     => 10,
            'student_id'    => 3,
            ],
            [
            'title'          => 'The Police Games',
            'description'   => 'Game edukasi sederhana dimana pemain harus menjawab pertanyaan dengan benar agar mobil polisi bisa maju dan menangkap penjahat. Semakin banyak jawaban benar, semakin dekat polisi untuk memenangkan permainan.',
            'media'         => 'student-projects/uSy9R0HwZ8zOmLvtRvRZuk2XMXuhnN5wwLKkPiKj.mp4',
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
