<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $about = Menu::create([
            'title' => 'About Us',
            'url' => '/about',
            'sort_order' => 2,
        ]);

        Menu::create([
            'title' => 'Home',
            'url' => '/',
            'sort_order' => 1,
        ]);

        Menu::create([
            'title' => 'Company Profile',
            'url' => '/about/profile',
            'parent_id' => $about->id,
            'sort_order' => 1,
        ]);

        Menu::create([
            'title' => 'Management',
            'url' => '/about/management',
            'parent_id' => $about->id,
            'sort_order' => 2,
        ]);

        Menu::create([
            'title' => 'Services',
            'url' => '/services',
            'sort_order' => 3,
        ]);

        Menu::create([
            'title' => 'Contact Us',
            'url' => '/contact',
            'sort_order' => 4,
        ]);
    }
}
