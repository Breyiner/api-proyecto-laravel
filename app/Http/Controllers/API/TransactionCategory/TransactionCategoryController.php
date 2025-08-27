<?php

namespace App\Http\Controllers\API\TransactionCategory;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionCategory\PartialUpdateTransactionCategoryRequest;
use App\Http\Requests\TransactionCategory\StoreTransactionCategoryRequest;
use App\Http\Requests\TransactionCategory\UpdateTransactionCategoryRequest;
use App\Services\TransactionCategory\TransactionCategoryService;
use Illuminate\Http\Request;

class TransactionCategoryController extends Controller
{

    protected $transactionCategoryService;

    public function __construct(TransactionCategoryService $transactionCategoryService) {

        $this->transactionCategoryService = $transactionCategoryService;

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = $this->transactionCategoryService->getAll();

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = $this->transactionCategoryService->getTransactionCategory($id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionCategoryRequest $request)
    {

        $data = $request->validated();

        $response = $this->transactionCategoryService->createTransactionCategory($data);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionCategoryRequest $request, string $id)
    {

        $data = $request->validated();

        $response = $this->transactionCategoryService->updateTransactionCategory($data, $id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function partialUpdate(PartialUpdateTransactionCategoryRequest $request, string $id)
    {

        $data = $request->validated();

        $response = $this->transactionCategoryService->partialUpdateTransactionCategory($data, $id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = $this->transactionCategoryService->deleteTransactionCategory($id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }
}
