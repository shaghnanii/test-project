<?php

namespace App\Traits;

use Carbon\Carbon;

trait CalculationTrait
{
    public function isInBetween($startTime, $endTime, $type = 'current'): bool
    {
        if ($type === 'current') {
            $now = Carbon::now()->timezone('Asia/Karachi')->format('H:i:s');
        }
        else {
            $now = Carbon::parse('11:00:00')->timezone('Asia/Karachi')->format('H:i:s');
        }
//        This condition will check weather the current time is between working hours or not.
        return strtotime($now) > strtotime($startTime) && strtotime($now) < strtotime($endTime);
    }
}
