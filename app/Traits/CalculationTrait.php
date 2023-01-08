<?php

namespace App\Traits;

use Carbon\Carbon;

trait CalculationTrait
{
    public function isInBetween($startTime, $endTime): bool
    {
        $now = Carbon::now()->timezone('Asia/Karachi')->format('H:i:s');
//        $now = Carbon::parse('11:00:59')->timezone('Asia/Karachi')->format('H:i:s'); // for testing working hours and lunch timing. But Make sure when enable this the (from now will not work correctly, because we are forcing the time to a specific time and there is a recursive function which is looking for days)
//        This condition will check weather the current time is between working hours or not.
        return strtotime($now) > strtotime($startTime) && strtotime($now) < strtotime($endTime);
    }
}
