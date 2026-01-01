<?php

namespace Database\Seeders;

use App\Models\GlobalData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GlobalDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        GlobalData::updateOrCreate(
            ['id' => 1],
            [
                'website_name' => 'My Website',
                'website_logo' => '/public/images/logo.png',
                'contact_numbers' => null,
                'contact_email' => null,
                'address' => null,
                'about_us' => null,
            ]
        );
    }
}
