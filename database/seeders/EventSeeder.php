<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $userIds = User::pluck('id')->toArray();
        $categoryIds = Category::pluck('id')->toArray();

        $defaultImagePath = public_path('images/auth.jpg'); // path to your default image

        for ($i = 0; $i < 7; $i++) {
            $startDate = $faker->dateTimeBetween('-1 month', '+1 month');
            $endDate = $faker->boolean(70) ? $faker->dateTimeBetween($startDate, '+2 months') : null;

            // Copy default image to storage with a unique name
            $thumbnailName = 'thumbnails/'.Str::random(20).'.jpg';
            Storage::disk('public')->putFileAs('thumbnails', $defaultImagePath, basename($thumbnailName));

            $eventId = DB::table('events')->insertGetId([
                'title' => $faker->sentence(3),
                'description' => $faker->paragraph,
                'thumbnail' => $thumbnailName, // use storage path
                'location' => $faker->city,
                'userId' => $faker->randomElement($userIds),
                'coordination' => $faker->latitude.','.$faker->longitude,
                'price' => $faker->numberBetween(0, 500),
                'quantity' => $faker->numberBetween(0, 100),
                'validation' => $faker->randomElement(['pending', 'rejected', 'approved']),
                'started_at' => $startDate,
                'end_at' => $endDate,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Attach random categories (1 to 3 per event)
            $randomCategories = $faker->randomElements($categoryIds, rand(1, 3));
            foreach ($randomCategories as $catId) {
                DB::table('category_event')->insert([
                    'event_id' => $eventId,
                    'category_id' => $catId,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
