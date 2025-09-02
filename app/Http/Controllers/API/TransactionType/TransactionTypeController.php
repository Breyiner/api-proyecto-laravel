<?php

namespace App\Http\Controllers\API\TransactionType;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionType\PartialUpdateTransactionTypeRequest;
use App\Http\Requests\TransactionType\StoreTransactionTypeRequest;
use App\Http\Requests\TransactionType\UpdateTransactionTypeRequest;
use App\Services\TransactionType\TransactionTypeService;
use Illuminate\Http\Request;

class TransactionTypeController extends Controller
{

    protected $transactionTypeService;

    public function __construct(TransactionTypeService $transactionTypeService) {

        $this->transactionTypeService = $transactionTypeService;

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = $this->transactionTypeService->getAll();

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    public function indexWithGoal()
    {
        $response = $this->transactionTypeService->getWithGoal();

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = $this->transactionTypeService->getTransactionType($id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionTypeRequest $request)
    {

        $data = $request->validated();

        $response = $this->transactionTypeService->createTransactionType($data);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionTypeRequest $request, string $id)
    {

        $data = $request->validated();

        $response = $this->transactionTypeService->updateTransactionType($data, $id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function partialUpdate(PartialUpdateTransactionTypeRequest $request, string $id)
    {

        $data = $request->validated();

        $response = $this->transactionTypeService->partialUpdateTransactionType($data, $id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = $this->transactionTypeService->deleteTransactionType($id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }
}
