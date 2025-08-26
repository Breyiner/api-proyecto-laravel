<?php

namespace App\Http\Controllers\API\Gender;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Gender\PartialUpdateGenderRequest;
use App\Http\Requests\Gender\StoreGenderRequest;
use App\Http\Requests\Gender\UpdateGenderRequest;
use App\Services\Gender\GenderService;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    protected $genderService;

    public function __contruct(GenderService $genderService) {

        $this->genderService = $genderService;

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = $this->genderService->getAll();

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = $this->genderService->getGender($id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGenderRequest $request)
    {

        $data = $request->validated();

        $response = $this->genderService->createGender($data);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGenderRequest $request, string $id)
    {

        $data = $request->validated();

        $response = $this->genderService->updateGender($data, $id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function partialUpdate(PartialUpdateGenderRequest $request, string $id)
    {

        $data = $request->validated();

        $response = $this->genderService->partialUpdateGender($data, $id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = $this->genderService->deleteGender($id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }
}