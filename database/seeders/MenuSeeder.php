<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = Type::pluck('name', 'id');

        // dd($types);
        foreach ($types as $index => $type) {
            for ($i=0; $i < 5; $i++) {
                DB::table('menus')->insert([
                    'type_id' => $index,
                    'name' => $type.$i,
                    'description' => 'menu'.$i,
                    'price' => rand(5, 15) * 1000,
                    'status' => 1,
                ]);
            }
        }
    }
}
