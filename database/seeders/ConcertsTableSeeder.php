<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ConcertsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('concerts')->insert([
            [
                'name' => 'Rock the Night',
                'description' => 'A night full of rock music',
                'date' => Carbon::now()->addDays(30),
                'venue' => 'Madison Square Garden',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jazz and Blues Fest',
                'description' => 'Experience the best of Jazz and Blues',
                'date' => Carbon::now()->addDays(45),
                'venue' => 'Sydney Opera House',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
