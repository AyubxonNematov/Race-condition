<?php

namespace Database\Seeders;

use App\Models\Mock;
use App\Models\User;
use App\Models\MockTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'test@test.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
            ]
        );

        echo 'user email: ' . $user->email . PHP_EOL;
        echo 'user token: ' . $user->createToken('Test Token')->plainTextToken . PHP_EOL;
        
        Mock::factory()
            ->has(
                MockTime::factory() 
                    ->count(5)
            )
            ->create();
    }
}
