<?php

namespace Database\Seeders;

use App\Models\Customer;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Factory::create('id_ID');

        Customer::create([
            'username' => 'customer',
            'phone_number' => 8989898989,
            'password' => Hash::make('password')
        ]);
        for ($i=0; $i < 10; $i++) {
            Customer::create([
                'username' => $faker->name(),
                'phone_number' => $faker->phoneNumber(),
                'password' => Hash::make('password')
            ]);
        }
    }
}
