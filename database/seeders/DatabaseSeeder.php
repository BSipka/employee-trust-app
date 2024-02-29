<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Company::factory(10)->create();
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'password' => bcrypt('test'),
            'role' => Role::ADMIN
        ]);

        $applicants = \App\Models\User::applicants()->get();

        \App\Models\Advertisement::factory(10)->create();



        \App\Models\Advertisement::all()->each(function ($ad) use ($applicants) {
            $ad->applicants()->attach(
                $applicants->random(rand(1, count($applicants)))->pluck('id')->toArray()
            );
        });
    }
}
