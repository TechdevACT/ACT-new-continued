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
            'heading_big' => 'It’s all about creativity,',
            'heading_big2' => 'technology and everything in between',
            'heading' => "Creativity that Moves Businesses Forward.",
            'description' => "Founded as boutique design and development. in 2006, we’re transforming into below the line advertising agency.",
            'approach_title' => 'About',
            'approach_heading' => 'Think Big. Start Small. Act Faster.',
            'approach_description' => 'We are a private, tech-powered design and on-demand creative services provider based in Indonesia, that deliver fast and high-quality design and creative output at scale.<br><br>Many of our clients think that we are the magician, sometimes we are, but in fact, we are not. We are just a human who love to solve problems in creative ways.  <br><br>So, start now. take an action. Challenge us',
            'expertise_title' => 'Expertise',
            'emphasis_title' => 'Our Client',
            'emphasis_heading' => 'Partnerships',
            'emphasis_description' => "We're proud to partner with diverse clients, from innovative startups to established brands. These collaborations prove our commitment to creative digital solutions that exceed expectations. Your success is our success; we're dedicated to helping your business thrive in the digital world. Join our satisfied clients and achieve your long-term goals.",
        ]);
    }
}
