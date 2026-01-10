<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    $categories = [
    "Music & Concerts",
    "Festivals",
    "Sports & Fitness",
    "Conferences & Summits",
    "Workshops & Training",
    "Tech & Startups",
    "Business & Networking",
    "Art & Culture",
    "Theater & Comedy",
    "Education & Classes",
    "Community & Social",
    "Religious & Spiritual",
    "Food & Drink",
    "Exhibitions & Fairs",
    "Gaming & Esports",
    "Movies & Cinema",
    "Charity & Fundraising",
    "Health & Wellness",
    "Travel & Outdoor",
    "Kids & Family",
];

    foreach ($categories as $category){
        Category::updateOrCreate(["name"=>$category]);
    }

    }
}
