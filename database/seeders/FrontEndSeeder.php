<?php

namespace Database\Seeders;

use App\Models\FrontEnd;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FrontEndSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FrontEnd::create([
            'hero_title' => 'Your Creative Team,',
            'hero_title2' => 'On Demand',
            'hero_description' => 'All-in-one Design Service for Ambitious Startups, SMBs & Growing Brands',
            'about_title' => 'About',
            'about_description' => 'We are a private, tech-powered design and on-demand creative services provider based in Indonesia, that deliver fast and high-quality design and creative output at scale.',
            'expertise_title' => 'Expertise',
            'expertise_heading' => 'Our Core Strengths',
            'expertise_description' => 'We combine innovative strategies with cutting-edge digital solutions to transform your vision into tangible success. Whether you’re scaling or already leading, our design solutions are built to meet your industry’s unique challenges',
            'industry_title' => 'Industries',
            'industry_heading' => 'Expertise in Various Industrial Fields',
            'industry_description' => 'We are proud to be trusted by various industries, ranging from automotive, IT, retail, manufacturing, food and beverage, skincare, insurance, etc.',
            'blog_title' => 'Blog',
            'blog_heading' => 'Latest News',
            'blog_description' => 'The latest updates from the creative industry, including design trends, technology, as well as recent projects and innovations.',
        ]);
    }
}
