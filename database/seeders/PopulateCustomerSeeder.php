<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PopulateCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_id = User::first()->id;
        $faker   = Faker::create();

        for ($i = 1; $i <= 10; $i++) {
            $customer = Customer::create( [
                'name'     => $faker->name(),
                'user_id'  => $user_id,
                'document' => Str::random(12),
            ]);

            for ($y = 1; $y <= 3; $y++) {
                $number = $customer->numbers()->create([ 'number' => $faker->phoneNumber()]);

                $number->preferences()->create(['name' => 'auto_attendant', 'value' => '1']);
                $number->preferences()->create(['name' => 'voicemail_enabled', 'value' => '1']);
            }
        }
    }
}
