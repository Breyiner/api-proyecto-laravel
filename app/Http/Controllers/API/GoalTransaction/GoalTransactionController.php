<?php

namespace App\Http\Controllers\API\GoalTransaction;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\GoalTransaction\StoreGoalTransactionRequest;
use App\Http\Requests\GoalTransaction\UpdateGoalTransactionRequest;
use App\Http\Requests\GoalTransaction\PartialUpdateGoalTransactionRequest;
use App\Services\GoalTransaction\GoalTransactionService;

class GoalTransactionController extends Controller
{
    protected $goalTransactionService;

    public function __construct(GoalTransactionService $goalTransactionService)
    {
        $this->goalTransactionService = $goalTransactionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = $this->goalTransactionService->getAll();

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = $this->goalTransactionService->getGoalTransaction($id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGoalTransactionRequest $request)
    {
        $data = $request->validated();

        $response = $this->goalTransactionService->createGoalTransaction($data);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGoalTransactionRequest $request, string $id)
    {
        $data = $request->validated();

        $response = $this->goalTransactionService->updateGoalTransaction($data, $id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Partially update the specified resource in storage.
     */
    public function partialUpdate(PartialUpdateGoalTransactionRequest $request, string $id)
    {
        $data = $request->validated();

        $response = $this->goalTransactionService->partialUpdateGoalTransaction($data, $id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = $this->goalTransactionService->deleteGoalTransaction($id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }
}
