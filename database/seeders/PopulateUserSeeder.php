<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PopulateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'superadmin']);
        Role::create(['name' => 'admin']);

        $user1 = User::create([
            'id'       => 1,
            'name'     => 'Owner Arena Test 1',
            'email'    => 'test1@vaitel.com',
            'password' => bcrypt('123456')
        ]);
        $user1->assignRole('superadmin');

        $user2 = User::create([
            'id'       => 2,
            'name'     => 'Writer Arena Test 2',
            'email'    => 'test2@vaitel.com',
            'password' => bcrypt('123456')
        ]);
        $user2->assignRole('admin');
    }
}
