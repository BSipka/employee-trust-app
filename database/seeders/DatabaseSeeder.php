<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\AdvertisementStatus;
use App\Enums\Role;
use App\Models\Image;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $companies = \App\Models\Company::factory(10)->create();
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'password' => bcrypt('test'),
            'role' => Role::ADMIN
        ]);

        $applicants = \App\Models\User::applicants()->get();


        $advertisements = \App\Models\Advertisement::factory(10)->create();

        foreach ($advertisements as $ad) {
            Image::create([
                'imageable_id' => $ad->id,
                'imageable_type' => 'App\Models\Advertisement',
                'url' => 'https://picsum.photos/200/300'
            ]);
        }

        foreach ($companies as $company) {
            Image::create([
                'imageable_id' => $company->id,
                'imageable_type' => 'App\Models\Company',
                'url' => 'https://picsum.photos/200/300'
            ]);
        }

        \App\Models\Advertisement::all()->each(function ($ad) use ($applicants) {
            $ad->applicants()->attach(
                $applicants->random(rand(1, count($applicants)))->pluck('id')->toArray(),
                ['reviewed' => rand(0, 1)]
            );
        });

        \App\Models\Advertisement::all()->each(function ($ad) use ($applicants) {
            $ad->applicant_saved()->attach(
                $applicants->random(rand(1, count($applicants)))->pluck('id')->toArray()
            );
        });
    }
}
