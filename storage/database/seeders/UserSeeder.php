<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@pks.test'],
            [
                'name' => 'Admin PKS',
                'role' => User::ROLE_ADMIN,
                'password' => 'admin12345',
            ]
        );

        User::updateOrCreate(
            ['email' => 'pengurus@pks.test'],
            [
                'name' => 'Pengurus PKS',
                'role' => User::ROLE_PENGURUS,
                'password' => 'pengurus12345',
            ]
        );
    }
}
