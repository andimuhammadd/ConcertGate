<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tickets')->insert([
            [
                'concert_id' => 1,
                'type' => 'VIP',
                'price' => 200.00,
                'quantity' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'concert_id' => 1,
                'type' => 'General Admission',
                'price' => 100.00,
                'quantity' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'concert_id' => 2,
                'type' => 'VIP',
                'price' => 250.00,
                'quantity' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'concert_id' => 2,
                'type' => 'General Admission',
                'price' => 120.00,
                'quantity' => 150,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
