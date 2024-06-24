<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => 'qwerty',
                'roles' => [
                    'admin'
                ]
            ], [
                'name' => 'Manager',
                'email' => 'manager@example.com',
                'password' => 'qwerty',
                'roles' => [
                    'manager'
                ]
            ], [
                'name' => 'User',
                'email' => 'user@example.com',
                'password' => 'qwerty'
            ]
        ];

        foreach ($users as $user) {
            User::updateOrCreate([
                'email' => $user['email']
            ], [
                'name' => $user['name'],
                'email_verified_at' => now(),
                'password' => $user['password'],
                'remember_token' => Str::random(10)
            ])->syncRoles($user['roles'] ?? []);
        }
    }
}
