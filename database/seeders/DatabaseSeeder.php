<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Panggil seeder lainnya di sini
        $this->call([
            SubjectSeeder::class,
            ClassroomSeeder::class, 
            TeachersSeeder::class,
            

        ]);

        // Contoh membuat user admin, jika Anda tidak menggunakan UserSeeder
        User::create([
            'name' => 'admin',
            'email' => 'admin@ram.com',
            'password' => Hash::make('mypassword321'),
            'role' => 'admin',
        ]);

    }
}
