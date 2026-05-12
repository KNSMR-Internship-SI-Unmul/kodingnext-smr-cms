<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CourseTypeSeeder::class,
            ModuleSeeder::class,
        ]);

        $this->call([
            PromotionSeeder::class,
            EventSeeder::class,
            StudentSeeder::class,
            StudentProjectSeeder::class,
            GeneralTestimonialSeeder::class,
        ]);

        if (app()->environment('local')) {
            $this->call([
                ProjectReviewSeeder::class
            ]);
        }
    }
}
