<?php

namespace Database\Seeders;

use App\Models\Ad;
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

        Ad::factory()->create([
            'id' => 1,
            'title' => 'Test Ad',
            'description' => 'Ad description',
            'price' => 100.50,
            'photo' => 'https://en.wiktionary.org/wiki/kitty#/media/File:Stray_kitten_Rambo002.jpg',
            'photos' => [
                'https://www.uspca.co.uk/media/uploads/11847481931666379167768075554147634861869145o.jpg',
                'https://www.uspca.co.uk/media/uploads/11847481931666379167768075554147634861869145o.jpg',
                'https://www.uspca.co.uk/media/uploads/11847481931666379167768075554147634861869145o.jpg'
            ],
        ]);

        Ad::factory(100)->create();
    }
}
