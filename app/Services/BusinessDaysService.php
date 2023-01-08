<?php

namespace App\Services;

use App\Models\BusinessHour;
use Carbon\Carbon;

class BusinessDaysService
{
    protected string $startingDay = '2023-01-07'; // starting date. We can also save this in db somewhere in settings table of in config or as a gloabal variable.

    public function isWorkingDay($day, $today)
    {
        // Here if the day is saturday it will check for the alternate saturday and generate result based on that
        if ($day === 'Saturday') {
            $isOff = ((int) Carbon::parse($this->startingDay)->diffInDays($today)) % 14 === 0;
            $workingDay  = $isOff === true ? null : BusinessHour::query()->where('day', $day)->first();
        }
        else {
            $workingDay = BusinessHour::query()
                ->activeDay()    // here on is a local scope to get only the working days.
                ->where('day', $day)
                ->first();
        }
        return $workingDay;
    }

    // recursive function to check next working day
    public function nextWorkingDay($day, $today)
    {
        $today = Carbon::parse($today)->addDay(1)->format('Y-m-d');
        $day = Carbon::parse($today)->format('l');
        $workingDay = $this->isWorkingDay($day, $today);
        if (!collect($workingDay)->isEmpty()) {
            $today .= ' 00:00:00';
            return Carbon::parse($today)->timezone('Asia/Karachi')->diffForHumans();
        }
        $this->nextWorkingDay($day, $today);

    }
}
