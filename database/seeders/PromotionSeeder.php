<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Promotion;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promotions = [
            [
                'title' => 'Promo Special Ramadhan',
                'start_date' => '2026-02-23',
                'end_date' => '2026-03-28',
                'description' => 'Jika sudah lama ingin mengenalkan coding kepada anak, ini bisa jadi waktu yang tepat. Belajar coding bukan hanya tentang mengikuti perkembangan teknologi, tetapi juga melatih cara berpikir, kreativitas, dan problem solving yang akan bermanfaat dalam jangka panjang. Di momen spesial ini, kami juga menyiapkan kejutan menarik yang bisa parents pilih langsung saat mendaftar 😉 Karena belajar untuk masa depan juga bisa dibuat menyenangkan dan penuh semangat. Promo ini berlaku terbatas selama periode Ramadan, mulai 23 Februari hingga 28 Maret 2026. Jangan sampai terlewat ya!',
                'image' => 'promotions/koSwh8CdGDFB7z2dDdWUx4STIXdCCQycrrDxzZBC.jpg',
                'user_id' => 1,
            ], [
                'title' => 'Pick Your Lucky Angpao',
                'start_date' => '2026-02-13',
                'end_date' => '2026-02-22',
                'description' => 'Chinese New Year Promo – Pick Your Lucky Angpao! Celebrate the Lunar New Year with a fresh start for your child’s digital journey. Through this special promo, kids can enjoy a fun and meaningful learning experience while exploring coding at Koding Next Samarinda. Pick Your Lucky Angpao and get a registration discount of 500,000 for coding programs Available from February 13 to 22, 2026, this is the perfect opportunity to begin a creative and future-ready learning adventure. Don’t miss out.',
                'image' => 'promotions/589loNMVusVx8naHPue6nclWiquJkyl3qsYg4s9l.jpg',
                'user_id' => 2,
            ]
        ];

        foreach ($promotions as $promotion) {
            Promotion::create($promotion);
        }
    }
}
