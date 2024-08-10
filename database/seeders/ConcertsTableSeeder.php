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
            [
                'name' => 'Pop Explosion',
                'description' => 'An electrifying pop music event',
                'date' => Carbon::now()->addDays(60),
                'venue' => 'Los Angeles Coliseum',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Classical Evening',
                'description' => 'Enjoy a night of classical music',
                'date' => Carbon::now()->addDays(90),
                'venue' => 'Royal Albert Hall',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hip Hop Jam',
                'description' => 'A celebration of hip hop culture',
                'date' => Carbon::now()->addDays(120),
                'venue' => 'Brooklyn Nets Stadium',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Electronic Dance Festival',
                'description' => 'Dance the night away to electronic beats',
                'date' => Carbon::now()->addDays(150),
                'venue' => 'Ultra Music Festival Grounds',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Indie Music Night',
                'description' => 'Discover new indie artists',
                'date' => Carbon::now()->addDays(75),
                'venue' => 'The Fillmore',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Country Music Festival',
                'description' => 'A weekend filled with country music',
                'date' => Carbon::now()->addDays(200),
                'venue' => 'Nashville Fairgrounds',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Reggae Vibes',
                'description' => 'Feel the rhythm of reggae music',
                'date' => Carbon::now()->addDays(210),
                'venue' => 'Reggae Beach Club',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Folk Music Gathering',
                'description' => 'An evening of folk songs and stories',
                'date' => Carbon::now()->addDays(230),
                'venue' => 'The Folk House',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
