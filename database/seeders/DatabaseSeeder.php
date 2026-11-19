<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'System Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Abcd@1234'),
            'is_admin' => true,
        ]);

        $this->call(MenuItemsTableSeeder::class);
    }
}
