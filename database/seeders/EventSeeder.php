<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'name' => 'Koders Lunar Party',
                'event_date' => '2026-02-14',
                'description' => 'Happy Lunar New Year Rayakan keseruan Imlek bersama Koding Next dengan berbagai aktivitas menarik yang siap membuat suasana semakin meriah! Anak-anak akan diajak bermain sambil belajar melalui kegiatan seru seperti chopstick game, sticky hands vs angpao, hingga CNY coding class menggunakan Scratch dan Roblox. Semua aktivitas dirancang untuk memberikan pengalaman yang menyenangkan sekaligus edukatif, ditambah dengan games dan hadiah yang membuat perayaan semakin berkesan. Menariknya, acara ini GRATIS untuk diikuti!',
                'image' => 'events/Km5CQEa5qyS9knRelIJIvILLvtJqYciThUGwXq7m.jpg',
                'user_id' => 1,
            ]
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    } 
}
