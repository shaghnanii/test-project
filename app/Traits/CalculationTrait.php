<?php

namespace App\Traits;

use Carbon\Carbon;

trait CalculationTrait
{
    public function isInBetween($startTime, $endTime): bool
    {
        $now = Carbon::now()->timezone('Asia/Karachi')->format('H:i:s');
//        This condition will check weather the current time is between working hours or not.
        return strtotime($now) > strtotime($startTime) && strtotime($now) < strtotime($endTime);
    }
}
