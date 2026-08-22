<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'jocelynpamposa05@gmail.com'], // TODO: change to your real email
            [
                'name' => 'Admin',
                'password' => Hash::make('Lumin123!'), // TODO: change this password
                'email_verified_at' => now(),
            ]
        );
    }
}
