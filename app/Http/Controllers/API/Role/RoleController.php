<?php

namespace App\Http\Controllers\API\Role;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Role\PartialUpdateRoleRequest;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Services\Role\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        $response = $this->roleService->getAll();

        if ($response['error']) 
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function show(string $id)
    {
        $response = $this->roleService->getRole($id);

        if ($response['error']) 
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function store(StoreRoleRequest $request)
    {
        $data = $request->validated();

        $response = $this->roleService->createRole($data);

        if ($response['error']) 
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function update(UpdateRoleRequest $request, string $id)
    {
        $data = $request->validated();

        $response = $this->roleService->updateRole($data, $id);

        if ($response['error']) 
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function partialUpdate(PartialUpdateRoleRequest $request, string $id)
    {
        $data = $request->validated();

        $response = $this->roleService->partialUpdateRole($data, $id);

        if ($response['error']) 
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function destroy(string $id)
    {
        $response = $this->roleService->deleteRole($id);

        if ($response['error']) 
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }
}
