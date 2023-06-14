<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodayOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        $customers = Customer::pluck('id');
        $menus = Menu::pluck('id');

        for ($i=0; $i < 5; $i++) {
            $date = $faker->dateTime('now');
            $order = Order::create([
                'customer_id' => $faker->randomElement($customers),
                'address' => $faker->address(),
                'total' => 1,
                'status' => 'pending',
                'date' => $date,
                'order_code' => 'NB-' . $faker->date('dmy') .'-'. $i
            ]);
            $total = 0;
            for ($j=0; $j < rand(1,3); $j++) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'menu_id' => $faker->randomElement($menus),
                    'quantity' => $qty = rand(1,3),
                    'price' => $price = rand(10, 18) * 1000,
                    'subtotal' => $subtotal = $price * $qty
                ]);
                $total += $subtotal;
            }
            $order->update([
                'total' => $total
            ]);
        }
    }
}
