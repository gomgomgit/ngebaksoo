<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('types')->insert([
            'name' => 'Mie Ayam',
            'image' => 'images/types/mie-ayam.png'
        ]);
        DB::table('types')->insert([
            'name' => 'Mie Ayam Goreng Pedas',
            'image' => 'images/types/mie-ayam-goreng.png'
        ]);
        DB::table('types')->insert([
            'name' => 'Bakso',
            'image' => 'images/types/bakso.png'
        ]);
    }
}
