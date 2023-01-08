<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public $today = "2023-01-07";

    public function test()
    {
        $firstDate = Carbon::parse($this->today);
        $limit = '2023-03-30';

        foreach ($firstDate->range($limit, '') as $date) {
            $day = Carbon::parse($date)->format('D');
            $isOff = ((int) Carbon::parse($this->today)->diffInDays($date)) % 14 === 0;
            $isOff = $isOff === true ? 'OFF' : '';
            $date = Carbon::parse($date)->format('l M, Y');
            echo "<html><h4>{$date} - <span style='color:red'>{$isOff}</span></h4></html>";
        }
        return '.';
    }
}
