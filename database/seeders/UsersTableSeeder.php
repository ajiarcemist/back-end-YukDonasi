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
                'avatar_img_url' => 'user/default.jpg',
            ],
            [
                'name' => 'user1',
                'email' => 'user1@user.com',
                'password' => bcrypt('password'),
                'status' => 'Aktif',
                'avatar_img_url' => 'user/default.jpg',
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
