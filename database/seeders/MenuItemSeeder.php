<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $home = MenuItem::create([
            'title' => 'Home',
            'url' => '/',
            'order' => 1,
            'icon' => 'home'
        ]);

        $services = MenuItem::create([
            'title' => 'Services',
            'url' => '#',
            'order' => 2,
            'icon' => 'briefcase'
        ]);

        $webDev = MenuItem::create([
            'parent_id' => $services->id,
            'title' => 'Web Development',
            'url' => '/services/web-development',
            'order' => 1
        ]);

        MenuItem::create([
            'parent_id' => $webDev->id,
            'title' => 'Laravel Apps',
            'url' => '/services/web-development/laravel',
            'order' => 1
        ]);

        MenuItem::create([
            'parent_id' => $webDev->id,
            'title' => 'API Integrations',
            'url' => '/services/web-development/apis',
            'order' => 2
        ]);

        MenuItem::create([
            'parent_id' => $services->id,
            'title' => 'UI / UX Design',
            'url' => '/services/design',
            'order' => 2
        ]);

        MenuItem::create([
            'title' => 'Manage Menus',
            'url' => '/admin/menus',
            'order' => 3,
            'icon' => 'settings'
        ]);
    }
}