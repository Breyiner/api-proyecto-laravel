<?php

namespace App\Http\Controllers\API\Icon;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Icon\StoreIconRequest;
use App\Http\Requests\Icon\UpdateIconRequest;
use App\Http\Requests\Icon\PartialUpdateIconRequest;
use App\Services\Icon\IconService;

class IconController extends Controller
{
    protected $iconService;

    public function __construct(IconService $iconService)
    {
        $this->iconService = $iconService;
    }

    public function index()
    {
        $response = $this->iconService->getAll();
        if ($response['error']) return ResponseFormatter::error($response['message'], $response['code']);
        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function show(string $id)
    {
        $response = $this->iconService->getIcon($id);
        if ($response['error']) return ResponseFormatter::error($response['message'], $response['code']);
        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function store(StoreIconRequest $request)
    {
        $data = $request->validated();
        $response = $this->iconService->createIcon($data);
        if ($response['error']) return ResponseFormatter::error($response['message'], $response['code']);
        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function update(UpdateIconRequest $request, string $id)
    {
        $data = $request->validated();
        $response = $this->iconService->updateIcon($data, $id);
        if ($response['error']) return ResponseFormatter::error($response['message'], $response['code']);
        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function partialUpdate(PartialUpdateIconRequest $request, string $id)
    {
        $data = $request->validated();
        $response = $this->iconService->partialUpdateIcon($data, $id);
        if ($response['error']) return ResponseFormatter::error($response['message'], $response['code']);
        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function destroy(string $id)
    {
        $response = $this->iconService->deleteIcon($id);
        if ($response['error']) return ResponseFormatter::error($response['message'], $response['code']);
        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }
}
