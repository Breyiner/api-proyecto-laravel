<?php

namespace App\Http\Controllers\API\Goal;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Goal\PartialUpdateGoalRequest;
use App\Http\Requests\Goal\StoreGoalRequest;
use App\Http\Requests\Goal\UpdateGoalRequest;
use App\Models\Goal;
use App\Services\Goal\GoalService;
use Auth;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class GoalController extends Controller
{

    use AuthorizesRequests;
    
    protected $goalService;

    public function __construct(GoalService $goalService) {

        $this->goalService = $goalService;

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = $this->goalService->getAll();

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $goal = Goal::find($id);

            $this->authorize('view', $goal);

            $response = $this->goalService->getGoal($id);

            if($response['error'])
                return ResponseFormatter::error($response['message'], $response['code']);

            return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
        } catch (ModelNotFoundException | AuthorizationException $e) {
            
            return ResponseFormatter::error('Esta meta no existe', 404);
        }
    }

    /**
     * Display goals by user.
     */
    public function indexGoalsByUser(string $user_id)
    {
        $response = $this->goalService->getGoalsByUser($user_id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Display active goals by user.
     */
    public function indexGoalsActiveByUser()
    {
        $user = Auth::user();

        $response = $this->goalService->getGoalsActiveByUser($user->id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGoalRequest $request)
    {

        $data = $request->validated();

        $response = $this->goalService->createGoal($data);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGoalRequest $request, string $id)
    {

        $data = $request->validated();

        $response = $this->goalService->updateGoal($data, $id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function partialUpdate(PartialUpdateGoalRequest $request, string $id)
    {

        $data = $request->validated();

        $response = $this->goalService->partialUpdateGoal($data, $id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    public function destroySafe(string $id)
    {
        $response = $this->goalService->deleteSafeGoal($id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = $this->goalService->deleteGoal($id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data']??[]);
    }
}