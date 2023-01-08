<?php

namespace Database\Seeders;

use App\Models\BusinessHour;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessHourSeeder extends Seeder
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
                'open_time' => null,
                'close_time' => null,
                'lunch_break_open' => null,
                'lunch_break_close' => null,
                'is_on' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'day' => 'Monday',
                'open_time' => '08:00:00',
                'close_time' => '18:00:00',
                'lunch_break_open' => '12:00:00',
                'lunch_break_close' => '14:45:00',
                'is_on' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'day' => 'Tuesday',
                'open_time' => null,
                'close_time' => null,
                'lunch_break_open' => null,
                'lunch_break_close' => null,
                'is_on' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'day' => 'Wednesday',
                'open_time' => '08:00:00',
                'close_time' => '18:00:00',
                'lunch_break_open' => '12:00:00',
                'lunch_break_close' => '14:45:00',
                'is_on' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'day' => 'Thursday',
                'open_time' => null,
                'close_time' => null,
                'lunch_break_open' => null,
                'lunch_break_close' => null,
                'is_on' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'day' => 'Friday',
                'open_time' => '08:00:00',
                'close_time' => '18:00:00',
                'lunch_break_open' => '12:00:00',
                'lunch_break_close' => '14:45:00',
                'is_on' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'day' => 'Saturday',
                'open_time' => '08:00:00',
                'close_time' => '18:00:00',
                'lunch_break_open' => '12:00:00',
                'lunch_break_close' => '14:45:00',
                'is_on' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        $count = BusinessHour::query()->count();
        if ($count <= 0) {
            BusinessHour::query()->insert($days);
        }
    }
}
