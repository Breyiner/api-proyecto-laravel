<?php

namespace App\Http\Controllers\API\GoalTransactionType;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\GoalTransactionType\PartialUpdateGoalTransactionTypeRequest;
use App\Http\Requests\GoalTransactionType\StoreGoalTransactionTypeRequest;
use App\Http\Requests\GoalTransactionType\UpdateGoalTransactionTypeRequest;
use App\Services\GoalTransactionType\GoalTransactionTypeService;
use Illuminate\Http\Request;

class GoalTransactionTypeController extends Controller
{

    protected $goalTransacTypeService;

    public function __construct(GoalTransactionTypeService $goalTransacTypeService) {

        $this->goalTransacTypeService = $goalTransacTypeService;

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = $this->goalTransacTypeService->getAll();

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = $this->goalTransacTypeService->getGoalTransacType($id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGoalTransactionTypeRequest $request)
    {

        $data = $request->validated();

        $response = $this->goalTransacTypeService->createGoalTransacType($data);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGoalTransactionTypeRequest $request, string $id)
    {

        $data = $request->validated();

        $response = $this->goalTransacTypeService->updateGoalTransacType($data, $id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function partialUpdate(PartialUpdateGoalTransactionTypeRequest $request, string $id)
    {

        $data = $request->validated();

        $response = $this->goalTransacTypeService->partialUpdateGoalTransacType($data, $id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = $this->goalTransacTypeService->deleteGoalTransacType($id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }
}
