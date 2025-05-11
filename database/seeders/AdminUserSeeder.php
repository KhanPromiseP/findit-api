<?php


namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Import your User model
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User', 
            'email' => 'admin@example.com', 
            'password' => Hash::make('admin1234'), 
            'id_number' => 'ADMIN123', 
            'contact' => '123-456-7890', 
            'is_admin' => true,
        ]);
    }
}