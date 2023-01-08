<?php

namespace App\Http\Controllers\Calculate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Calculate\CalculateIndexRequest;
use App\Models\BusinessHour;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CalculateController extends Controller
{
//    This trail will manage the API response and the http code as well against each time of response back
    use ApiResponse;

    protected string $closed_message = "Store is closed today";
    protected string $open_message  = "Store is open.";
    public string $startingDay = '2023-01-07';

    public function isInBetween($startTime, $endTime): bool
    {
        $now = Carbon::parse('09:45:59')->timezone('Asia/Karachi')->format('H:i:s');
//        This condition will check weather the current time is between working hours or not.
        return strtotime($now) > strtotime($startTime) && strtotime($now) < strtotime($endTime);
    }

    public function index(CalculateIndexRequest $request): JsonResponse
    {
        try {
            $today = Carbon::now()->timezone('Asia/Karachi')->format('Y-m-d');
//            $today = '2023-02-04'; // for testing purpose, we can change the current(today) date here.
            $day = Carbon::parse($today)->format('l');

//            Here if the day is saturday it will check for the alternate saturday and generate result based on that
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
            if (!$workingDay)
                return $this->response404($this->closed_message);

//            checking for the store opening and closing time
            if (!$this->isInBetween($workingDay->open_time, $workingDay->close_time))
                return $this->response404($this->closed_message);

//            checking for the store lunch timings
            if ($this->isInBetween($workingDay->lunch_break_open, $workingDay->lunch_break_close))
                return $this->response404("Store is closed now (Break Time)");

            return $this->response200($this->open_message, $workingDay);
        }
        catch (\Exception $exception) {
            return $this->response500($exception->getMessage());
        }
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
