<?php

namespace App\Services\Goal;

use App\Models\Goal;
use Arr;

class GoalService
{
    public static function getAll() {
        $goals = Goal::all();
        if (count($goals) == 0) 
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay metas registradas",
                "data" => $goals
            ];
        return [
            "error" => false,
            "code" => 200,
            "message" => "Metas obtenidas con éxito",
            "data" => $goals
        ];
    }

    public function getGoal($id) {
        $goal = Goal::find($id);
        if (!$goal) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Esta meta no existe",
            ];
        return [
            "error" => false,
            "code" => 200,
            "message" => "Meta obtenida con éxito",
            "data" => $goal
        ];
    }

    public function getGoalsByUser($user_id) {

        $goals = Goal::where('user_id', $user_id)->get();

        if (count($goals) == 0) 
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay metas registradas por el usuario",
                "data" => $goals
            ];


        return [
            "error" => false,
            "code" => 200,
            "message" => "Metas obtenidas con éxito",
            "data" => $goals
        ];

    }

    public function getGoalsActiveByUser($user_id) {

        $goals = Goal::query()
                    ->where('user_id', $user_id)
                    ->where('status_id', 1)
                    ->orderBy('completed', 'asc')
                    ->orderBy('created_at', 'desc')
                    ->get();

        if (count($goals) == 0) 
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay metas registradas por el usuario",
                "data" => $goals
            ];


        return [
            "error" => false,
            "code" => 200,
            "message" => "Metas obtenidas con éxito",
            "data" => $goals
        ];

    }

    public function createGoal(array $data) {
        $goal = Goal::create([
            'name' => $data['name'],
            'target_amount' => $data['target_amount'],
            'description' => $data['description'] ?? null,
            'due_date' => $data['due_date'] ?? null,
        ]);
        return [
            'error' => false,
            'code' => 201,
            'message' => 'Meta creada con éxito',
            'data' => $goal
        ];
    }

    public function updateGoal(array $data, $id) {
        $goal = Goal::find($id);
        if (!$goal) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Esta meta no existe",
            ];
        $goal->update($data);
        return [
            "error" => false,
            "code" => 200,
            "message" => "Meta actualizada con éxito",
            "data" => $goal
        ];
    }

    public function partialUpdateGoal(array $entryData, $id) {
        $goal = Goal::find($id);
        if (!$goal) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Esta meta no existe",
            ];
        $goal->update($entryData);
        return [
            "error" => false,
            "code" => 200,
            "message" => "Meta actualizada con éxito",
            "data" => $goal
        ];
    }

    public function deleteSafeGoal($id) {
        $goal = Goal::find($id);
        
        if (!$goal) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Esta meta no existe",
            ];
        $goal->update(['status_id' => 2]);
        return [
            "error" => false,
            "code" => 200,
            "message" => "Meta eliminada con éxito",
        ];
    }

    public function deleteGoal($id) {
        $goal = Goal::find($id);
        
        if (!$goal) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Esta meta no existe",
            ];
        $goal->delete();
        return [
            "error" => false,
            "code" => 200,
            "message" => "Meta eliminada con éxito",
        ];
    }
}
