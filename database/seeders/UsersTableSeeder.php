<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
                'status' => 'Aktif',
                'avatar_img_url' => 'user/avatar.png',
            ],
            [
                'name' => 'user1',
                'email' => 'user1@user.com',
                'password' => bcrypt('password'),
                'status' => 'Aktif',
                'avatar_img_url' => 'user/avatar.png',
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
