<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'user role',
            'email' => 'user@role.test',
            'password' => bcrypt('12345678'),
            'profile' => 'images/profile/default.png',
        ]);
        $user->assignRole('user');

        $admin = User::create([
            'name' => 'admin role',
            'email' => 'admin@role.test',
            'password' => bcrypt('12345678'),
            'profile' => 'images/profile/default.png',
        ]);
        $admin->assignRole('admin');

        $superadmin = User::create([
            'name' => 'super admin role',
            'email' => 'super@role.test',
            'password' => bcrypt('12345678'),
            'profile' => 'images/profile/default.png',
        ]);
        $superadmin->assignRole('super admin');
    }
}
