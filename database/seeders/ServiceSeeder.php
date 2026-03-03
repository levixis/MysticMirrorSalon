<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            // Men's Packages
            ['name' => 'Haircut + Beard & Scrub', 'price' => 449, 'gender' => 'men', 'description' => 'Classic haircut with beard grooming and refreshing scrub treatment'],
            ['name' => 'Haircut + Beard, Head Massage & Cleanup', 'price' => 499, 'gender' => 'men', 'description' => 'Haircut, beard styling, relaxing head massage and full face cleanup'],
            ['name' => 'Haircut + Beard, Head Massage & D-Tan', 'price' => 799, 'gender' => 'men', 'description' => 'Complete grooming with de-tan treatment for brighter skin'],
            ['name' => 'Haircut + Beard & Hair Spa', 'price' => 999, 'gender' => 'men', 'description' => 'Premium haircut and beard with nourishing hair spa treatment'],
            ['name' => 'Haircut + Beard & O3+ Facial', 'price' => 1299, 'gender' => 'men', 'description' => 'Luxury package with O3+ professional facial treatment'],

            // Women's Packages
            ['name' => 'Haircut & Blow Dry', 'price' => 449, 'gender' => 'women', 'description' => 'Professional haircut with blow dry styling'],
            ['name' => 'Haircut, Head Massage & Cleanup', 'price' => 499, 'gender' => 'women', 'description' => 'Haircut with relaxing head massage and full face cleanup'],
            ['name' => 'Haircut, Head Massage & D-Tan', 'price' => 799, 'gender' => 'women', 'description' => 'Complete hair care with de-tan treatment for glowing skin'],
            ['name' => 'Haircut & Hair Spa', 'price' => 999, 'gender' => 'women', 'description' => 'Premium haircut with deep conditioning hair spa'],
            ['name' => 'Haircut, Facial & Makeup', 'price' => 1299, 'gender' => 'women', 'description' => 'Luxury package with professional facial and makeup session'],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
