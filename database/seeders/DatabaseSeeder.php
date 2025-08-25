<?php

namespace Database\Seeders;

use App\Models\FrontEnd;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectGallery;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test Akun',
            'email' => 'akun_test@email.com',
            'password' => bcrypt('TestAkun!@#'),
        ]);

        ProjectCategory::factory(4)->create();

        Project::factory(10)->create();

        ProjectGallery::factory(40)->create();

        $this->call([
            FrontEndSeeder::class,
        ]);

        $this->call([
            AboutOptionSeeder::class,
        ]);
    }
}
