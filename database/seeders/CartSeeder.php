<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Menu;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');
        $menus = Menu::pluck('id');
        $customers = Customer::pluck('id');

        foreach ($customers as $customer) {
            for ($i=0; $i < 3; $i++) {
                Cart::create([
                    'customer_id' => $customer,
                    'menu_id' => $faker->randomElement($menus),
                    'quantity' => rand(1,4),
                    'notes' => $faker->randomElement(['ga pedes', 'sambelnya dipisah'])
                ]);
            }
        }
    }
}
