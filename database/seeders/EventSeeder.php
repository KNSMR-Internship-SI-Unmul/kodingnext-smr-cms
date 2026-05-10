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
                'description' => 'Perayaan Imlek di Koding Next Samarinda berlangsung meriah dan penuh keseruan! Anak-anak menikmati berbagai aktivitas seru seperti chopstick game, sticky hands vs angpao, serta CNY coding class menggunakan Scratch dan Roblox. Suasana semakin ramai dengan games, hadiah menarik, dan dresscode merah emas yang membuat acara semakin berkesan.',
                'image' => 'events/NI72Zc461XTEsj1qfaGEmCnzCwVKXpzj86W1nAuk.jpg',
                'user_id' => 1,
            ]
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    } 
}
