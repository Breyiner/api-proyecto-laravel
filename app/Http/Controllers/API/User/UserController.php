<?php

namespace App\Http\Controllers\API\User;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\PartialUpdateUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateOwnUserEmailRequest;
use App\Http\Requests\User\UpdateOwnUserPasswordRequest;
use App\Http\Requests\User\UpdateUserEmailRequest;
use App\Http\Requests\User\UpdateUserPasswordRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UpdateUserRoleRequest;
use App\Http\Requests\User\UpdateUserStatusRequest;
use App\Services\User\UserService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use AuthorizesRequests;
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = $this->userService->getAllUsers();

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    public function indexCount()
    {
        $response = $this->userService->getCountUsers();

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    public function indexAllInformation() {

        $response = $this->userService->getAllInformation();

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);   

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);

    }

    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = $this->userService->getUser($id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    public function showOwn(Request $request) {

        $user = Auth::user();

        $response = $this->userService->getUser($user->id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        
        $data = $request->validated();

        $response = $this->userService->createUser($data);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $data = $request->validated();

        $response = $this->userService->updateUser($data, $id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);

    }

    public function partialUpdate(PartialUpdateUserRequest $request, string $id) {

        $data = $request->validated();

        $response = $this->userService->updateUser($data, $id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code'], $response['errors']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);

    }

    public function updateRole(UpdateUserRoleRequest $request, string $id)
    {
        $data = $request->validated();

        $response = $this->userService->updateRole($data, $id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    public function updateOwnEmail(UpdateOwnUserEmailRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();

        $response = $this->userService->updateEmail($data, $user->id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    public function updateOwnPassword(UpdateOwnUserPasswordRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();

        $response = $this->userService->updatePassword($data, $user->id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = $this->userService->deleteUser($id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    public function softDelete($id)
    {
        $response = $this->userService->softDeleteUser($id);


        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }
}
