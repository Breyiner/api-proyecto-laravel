<?php

namespace App\Http\Controllers\API\User;

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
        $users = $this->userService->getAllUsers();

        return response()->json([
            'success' => true,
            'message' => 'Usuarios obtenidos con éxito',
            'data' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        
        $data = $request->validated();

        $user = $this->userService->createUser($data);

        return response()->json([
            'success' => true,
            'message' => 'Usuario creado con éxito',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(["message" => "aquí no es"]);
    }

    public function showOwn(Request $request) {

        $user = Auth::user();

        $userData = $this->userService->getUser($user->id);

        return response()->json([
            'success' => true,
            'message' => 'Usuario obtenido con éxito',
            'data' => $userData
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $data = $request->validated();
    }

    public function partialUpdate(PartialUpdateUserRequest $request, string $id) {

    }

    public function updateEmail(UpdateUserEmailRequest $request, string $id)
    {
        $data = $request->validated();
    }

    public function updatePassword(UpdateUserPasswordRequest $request, string $id)
    {
        $data = $request->validated();
    }

    public function updateStatus(UpdateUserStatusRequest $request, string $id)
    {
        $data = $request->validated();
    }

    public function updateRole(UpdateUserRoleRequest $request, string $id)
    {
        $data = $request->validated();
    }

    public function updateOwnEmail(UpdateOwnUserEmailRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();
    }

    public function updateOwnPassword(UpdateOwnUserPasswordRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->userService->deleteUser($id);

        return response()->json([
            'success' => true,
            'message' => 'Usuario eliminado con éxito',
        ]);
    }
}
