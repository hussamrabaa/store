<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@store.local',
            'password' => 'Admin123!',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Editor',
            'email' => 'editor@store.local',
            'password' => 'Editor123!',
            'role' => 'editor',
        ]);

        User::factory()->create([
            'name' => 'Customer',
            'email' => 'user@store.local',
            'password' => 'User123!',
            'role' => 'user',
        ]);

        $samples = [
            ['name' => 'Classic Tee', 'description' => 'A comfortable everyday t-shirt.', 'price' => 19.99, 'file' => 'shirt2.png'],
            ['name' => 'Summer Shirt', 'description' => 'Lightweight shirt for warm days.', 'price' => 24.50, 'file' => 'shirt3.png'],
            ['name' => 'Premium Tee', 'description' => 'Soft premium cotton t-shirt.', 'price' => 29.00, 'file' => 'shirt4.png'],
        ];

        foreach ($samples as $sample) {
            $source = public_path('images/'.$sample['file']);
            $path = 'products/'.$sample['file'];

            if (file_exists($source)) {
                Storage::disk('public')->put($path, file_get_contents($source));

                Product::create([
                    'name' => $sample['name'],
                    'description' => $sample['description'],
                    'price' => $sample['price'],
                    'image' => $path,
                    'user_id' => $admin->id,
                ]);
            }
        }
    }
}
