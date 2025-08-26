<?php

namespace App\Http\Controllers\API\Status;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Status\PartialUpdateStatusRequest;
use App\Http\Requests\Status\StoreStatusRequest;
use App\Http\Requests\Status\UpdateStatusRequest;
use App\Services\Status\StatusService;
use Illuminate\Http\Request;

class StatusController extends Controller
{

    protected $statusService;

    public function __contruct(StatusService $statusService) {

        $this->statusService = $statusService;

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = $this->statusService->getAll();

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = $this->statusService->getStatus($id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStatusRequest $request)
    {

        $data = $request->validated();

        $response = $this->statusService->createStatus($data);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStatusRequest $request, string $id)
    {

        $data = $request->validated();

        $response = $this->statusService->updateStatus($data, $id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function partialUpdate(PartialUpdateStatusRequest $request, string $id)
    {

        $data = $request->validated();

        $response = $this->statusService->partialUpdateStatus($data, $id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = $this->statusService->deleteStatus($id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }
}
