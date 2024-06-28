<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesSeeder::class);
        
        User::create([
            'role_id' => 1,
            'name' => 'admin',
            'email' => 'admin@info.id',
            'password' => Hash::make('admin'),
            'status' => true
        ]);

        $classroom = Classroom::create([
            'name' => 'Matematika'
        ]);

        $classroom->user()->create([
            'role_id' => 2,
            'name' => 'Zidan',
            'email' => 'zidan@info.id',
            'status' => true,
            'password' => Hash::make('zidan')
        ]);

        User::factory(20)->create();
    }
}
