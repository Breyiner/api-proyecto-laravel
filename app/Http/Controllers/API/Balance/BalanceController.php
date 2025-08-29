<?php

namespace App\Http\Controllers\API\Balance;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Balance\BalancePeriodRequest;
use App\Services\Balance\BalanceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    protected $balanceService;

    public function __construct(BalanceService $balanceService) {

        $this->balanceService = $balanceService;

    }

    /**
     * Display a listing of the resource.
     */
    public function showPeriod(BalancePeriodRequest $request)
    {

        $data = $request->validated();

        $user = Auth::user();

        $response = $this->balanceService->showPeriod($user->id, $data);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }
}
