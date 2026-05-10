<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProjectReview;

class ProjectReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = [
            [
                'review_content'     => 'Game-nya seru dan cukup menantang untuk anak seusianya. Saya suka bagaimana anak sudah memahami konsep obstacle dan timing untuk melompat. Penjelasan project juga cukup jelas dan terlihat bahwa anak memahami alur permainan yang dibuat. Ke depannya mungkin bisa ditambahkan level atau variasi rintangan supaya lebih menarik lagi.',
                'rating'             => 4,
                'is_approved'        => 1,
                'student_project_id' => 1,
            ],
            [
                'review_content'     => 'Project ini sangat menarik karena tidak hanya membuat game tetapi juga mengajarkan kebiasaan baik menjaga kebersihan. Kontrol game mudah dipahami dan konsepnya kreatif untuk anak usia dini. Saya senang melihat anak dapat menggabungkan unsur edukasi dan permainan dengan baik.',
                'rating'             => 5,
                'is_approved'        => 1,
                'student_project_id' => 2,
            ],
            [
                'review_content'     => 'Saya terkesan karena game sudah memiliki fitur score dan life sehingga terasa seperti game sungguhan. Anak terlihat memahami logika dasar game dan tantangan dalam permainan. Akan lebih bagus jika nantinya ditambahkan variasi musuh atau background agar tampilannya semakin hidup.',
                'rating'             => 4,
                'is_approved'        => 1,
                'student_project_id' => 3,
            ],
            [
                'review_content'     => 'Ide game edukasinya sangat bagus dan interaktif. Konsep menjawab pertanyaan untuk membantu polisi menangkap penjahat membuat belajar terasa menyenangkan. Anak juga terlihat percaya diri saat menjelaskan project-nya. Sangat bangga melihat kreativitas dan keberanian anak dalam presentasi.',
                'rating'             => 5,
                'is_approved'        => 1,
                'student_project_id' => 4,
            ]

        ];

        foreach ($reviews as $review) {
            ProjectReview::create($review);
        }
    } 
}
