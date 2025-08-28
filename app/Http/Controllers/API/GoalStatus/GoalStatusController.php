<?php

namespace App\Http\Controllers\API\GoalStatus;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\GoalStatus\PartialUpdateGoalStatusRequest;
use App\Http\Requests\GoalStatus\StoreGoalStatusRequest;
use App\Http\Requests\GoalStatus\UpdateGoalStatusRequest;
use App\Services\GoalStatus\GoalStatusService;
use Illuminate\Http\Request;

class GoalStatusController extends Controller
{
    protected $goalStatusService;

    public function __construct(GoalStatusService $goalStatusService) {

        $this->goalStatusService = $goalStatusService;

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = $this->goalStatusService->getAll();

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = $this->goalStatusService->getStatus($id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGoalStatusRequest $request)
    {

        $data = $request->validated();

        $response = $this->goalStatusService->createStatus($data);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGoalStatusRequest $request, string $id)
    {

        $data = $request->validated();

        $response = $this->goalStatusService->updateStatus($data, $id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function partialUpdate(PartialUpdateGoalStatusRequest $request, string $id)
    {

        $data = $request->validated();

        $response = $this->goalStatusService->partialUpdateStatus($data, $id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = $this->goalStatusService->deleteStatus($id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }
}
