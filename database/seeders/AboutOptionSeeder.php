<?php

namespace Database\Seeders;

use App\Models\AboutOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutOption::create([
            'heading_big' => 'From idea to reality',
            'heading_big2' => 'your vision, our theme.',
            'heading' => "FANKY team is not just a design, it's a family",
            'description' => "FANKY team is not just a design, it's a family",
            'approach_title' => 'Approach',
            'approach_heading' => 'We solve problems to help businesses grow',
            'approach_description' => 'No matter what you bring—be it a landing page, a mobile app, or a full-scale e-commerce platform—we approach every project with the business’s growth and success as our top priority.',
            'expertise_title' => 'Expertise',
            'emphasis_title' => 'Emphasis',
            'emphasis_heading' => 'From small tasks to lasting partnerships',
            'emphasis_description' => 'We believe that every collaboration has the potential to grow into something bigger. Whether you come to us with a small task or a large-scale project, we are committed to building long-term relationships based on trust, quality, and shared success.',
        ]);
    }
}
