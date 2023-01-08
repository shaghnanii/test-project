<?php

namespace App\Http\Controllers\Calculate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Calculate\CalculateIndexRequest;
use App\Http\Requests\Calculate\CalculateStoreRequest;
use App\Models\BusinessHour;
use App\Services\BusinessDaysService;
use App\Traits\ApiResponse;
use App\Traits\CalculationTrait;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CalculateController extends Controller
{
//    This trail will manage the API response and the http code as well against each time of response back
    use ApiResponse;
//    This trait is used for checking the status of the days
    use CalculationTrait;

    protected string $closed_message = "Store is close.";
    protected string $open_message  = "Store is open.";

    public function index(CalculateIndexRequest $request, BusinessDaysService $service): JsonResponse
    {
        try {
            $today = Carbon::now()->timezone('Asia/Karachi')->format('Y-m-d');

            $day = Carbon::parse($today)->format('l');

            $workingDay = $service->isWorkingDay($day, $today);

            if (empty($workingDay)) {
                // checking for next working day.
                $next_day = $service->nextWorkingDay($day, $today);
                return $this->response404($this->closed_message . " Next Working Day: {$next_day}");
            }

//            checking for the store opening and closing time
            if (!$this->isInBetween($workingDay->open_time, $workingDay->close_time)) {
                return $this->response404($this->closed_message . ' Store is going be open soon/already closed.');
            }

//            checking for the store lunch timings
            if ($this->isInBetween($workingDay->lunch_break_open, $workingDay->lunch_break_close))
                return $this->response404("Store is closed now (Break Time)");

            return $this->response200($this->open_message, $workingDay);
        }
        catch (\Exception $exception) {
            return $this->response500($exception->getMessage());
        }
    }

    public function store(CalculateStoreRequest $request, BusinessDaysService $service)
    {
        try {
            $today = $request->selected_date;

            $day = Carbon::parse($today)->format('l');

            $workingDay = $service->isWorkingDay($day, $today);

            if (empty($workingDay)) {
                // checking for next working day.
                $next_day = $service->nextWorkingDay($day, $today);
                return $this->response404($this->closed_message . " Next Working Day: {$next_day}");
            }

//            checking for the store opening and closing time
            if (!$this->isInBetween($workingDay->open_time, $workingDay->close_time)) {
                return $this->response404($this->closed_message . ' Store is going be open soon/already closed.');
            }

            return $this->response200($this->open_message, $workingDay);
        }
        catch (\Exception $exception) {
            return $this->response500($exception->getMessage());
        }
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
