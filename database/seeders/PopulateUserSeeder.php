<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class PopulateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id'       => 1,
            'name'     => 'Jean Carlos Dalcero',
            'email'    => 'jeandalcero@gmail.com',
            'password' => bcrypt('123456')
        ]);
    }
}
