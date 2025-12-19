<?php

namespace Database\Seeders;

use App\Models\NewsCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Technology', 'description' => 'Technology related news'],
            ['name' => 'Business', 'description' => 'Business and finance news'],
            ['name' => 'Design', 'description' => 'Design and creative news'],
            ['name' => 'Development', 'description' => 'Web and app development news']
        ];

        foreach ($categories as $category) {
            NewsCategory::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
            ]);
        }
    }
}
