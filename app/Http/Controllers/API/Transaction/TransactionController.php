<?php

namespace App\Http\Controllers\API\Transaction;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\PartialUpdateTransactionRequest;
use App\Http\Requests\Transaction\StoreTransactionRequest;
use App\Http\Requests\Transaction\TransactionPeriodRequest;
use App\Http\Requests\Transaction\TransactionDateRequest;
use App\Http\Requests\Transaction\UpdateTransactionRequest;
use App\Models\Transaction;
use App\Services\Transaction\TransactionService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    use AuthorizesRequests;
    protected $transactionService;

    public function __construct(TransactionService $transactionService) {

        $this->transactionService = $transactionService;

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = $this->transactionService->getAll();

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $transaction = Transaction::find($id);

        $this->authorize('view', $transaction);

        $response = $this->transactionService->getTransaction($id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Display the specified resource.
     */
    public function indexByCategory(string $category_id)
    {
        $response = $this->transactionService->getTransactionsByCategory($category_id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Display the specified resource.
     */
    public function indexByUser(string $user_id)
    {
        $response = $this->transactionService->getTransactionsByUser($user_id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }


    public function indexByPeriod(TransactionPeriodRequest $request) {

        $data = $request->validated();

        $user = Auth::user();
        
        $response = $this->transactionService->getTransactionsByPeriod($user->id, $data);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);

    }

    public function indexByCategoryPeriod(TransactionPeriodRequest $request, $category_id) {

        $data = $request->validated();

        $user = Auth::user();
        $data['transaction_category_id'] = $category_id;
        
        $response = $this->transactionService->getTransactionsByCategoryPeriod($user->id, $data);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    public function indexByDate(TransactionDateRequest $request) {

        $data = $request->validated();

        $user = Auth::user();
        
        $response = $this->transactionService->getTransactionsByDate($user->id, $data);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {

        $data = $request->validated();

        $response = $this->transactionService->createTransaction($data);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, string $id)
    {

        $data = $request->validated();

        $response = $this->transactionService->updateTransaction($data, $id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function partialUpdate(PartialUpdateTransactionRequest $request, string $id)
    {

        $data = $request->validated();

        $response = $this->transactionService->partialUpdateTransaction($data, $id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = $this->transactionService->deleteTransaction($id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }
}
