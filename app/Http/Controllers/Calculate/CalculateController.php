<?php

namespace App\Http\Controllers\Calculate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Calculate\CalculateIndexRequest;
use App\Models\BusinessHour;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalculateController extends Controller
{
    public $startingDay = '2023-01-07';

    public function index(CalculateIndexRequest $request)
    {
        try {
            $today = Carbon::now()->format('Y-m-d');
            $today = '2023-01-04';
            $day = Carbon::parse($today)->format('l');
            if ($day === 'Saturday') {
                $isOff = ((int) Carbon::parse($this->startingDay)->diffInDays($today)) % 14 === 0;
                $isOff = $isOff === true ? 'OFF' : 'ON';
                $workingDay  = '';
            }
            else {
                $workingDay = BusinessHour::query()
                    ->activeDay()    // here on is a local scope to get only the working days.
                    ->where('day', $day)
                    ->first();
            }
            if (!$workingDay)
                return response()->json(['message' => 'Today is not working day.'], 404);

            return response()->json(['message' => 'Result fetched successfully.', 'data' => $workingDay]);
        }
        catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 500);
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
