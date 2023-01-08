<?php

namespace Database\Seeders;

use App\Models\OpeningHour;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OpeningHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = [
            [
                'day' => 'Sunday',
                'is_on' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'day' => 'Monday',
                'is_on' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'day' => 'Tuesday',
                'is_on' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'day' => 'Wednesday',
                'is_on' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'day' => 'Thursday',
                'is_on' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'day' => 'Friday',
                'is_on' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'day' => 'Saturday',
                'is_on' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        $count = OpeningHour::query()->count();
        if ($count <= 0) {
            OpeningHour::query()->insert($days);
        }
    }
}
