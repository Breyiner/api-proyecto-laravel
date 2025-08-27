<?php

namespace App\Http\Controllers\API\Profile;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\PartialUpdateProfileRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Services\Profile\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService) {

        $this->profileService = $profileService;

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = $this->profileService->getAll();

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = $this->profileService->getProfile($id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Display the specified resource.
     */
    public function showOwn()
    {

        $user = Auth::user();

        $response = $this->profileService->getProfile($user->id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Display the specified resource.
     */
    public function showByUser(string $user_id)
    {
        $response = $this->profileService->getProfileByUser($user_id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateOwn(UpdateProfileRequest $request)
    {

        $data = $request->validated();

        $user = Auth::user();

        $response = $this->profileService->updateProfile($data, $user->id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request, string $user_id)
    {

        $data = $request->validated();

        $response = $this->profileService->updateProfile($data, $user_id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function partialUpdateOwn(PartialUpdateProfileRequest $request)
    {

        $data = $request->validated();

        $user = Auth::user();

        $response = $this->profileService->partialUpdateProfile($data, $user->id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function partialUpdate(PartialUpdateProfileRequest $request, string $user_id)
    {

        $data = $request->validated();

        $response = $this->profileService->partialUpdateProfile($data, $user_id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }
}
