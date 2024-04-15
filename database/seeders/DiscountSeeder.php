<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //manual input
        \App\Models\Discount::create([
            'name' => 'Grand Opening Discount',
            'description' => 'Grand Opening Discount 10% for all products',
            'type' => 'percentage',
            'value' => 10,
            'status' => 'active',
            'expired_date' => '2024-01-31'
        ]);

        \App\Models\Discount::create([
            'name' => 'Ramadhan Discount',
            'description' => 'Ramadhan Discount 10% for all products',
            'type' => 'percentage',
            'value' => 10,
            'status' => 'active',
            'expired_date' => '2024-02-12'
        ]);

        \App\Models\Discount::create([
            'name' => 'Christmas Discount',
            'description' => 'Christmas Discount 10% for all products',
            'type' => 'percentage',
            'value' => 10,
            'status' => 'active',
            'expired_date' => '2024-04-05'
        ]);
    }
}
