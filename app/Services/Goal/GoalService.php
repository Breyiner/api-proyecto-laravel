<?php

namespace App\Services\Goal;

use App\Models\Color;
use App\Models\Goal;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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

    public function getCountGoals() {

        $goals = Goal::where('status_id', 1)->get();

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
            "message" => "Metas obtenidos con éxito",
            "data" => count($goals)
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

        $goal['progress'] = $goal->progress;
        $goal['total_transactions'] = $goal->total_transactions;

        // $goal->makeHidden('transactions');
        // $goal->makeHidden('status_id');
        $goal->makeHidden('updated_at');

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
                    ->with('transactions')
                    ->orderBy('completed', 'asc')
                    ->orderBy('created_at', 'desc')
                    ->select('id', 'name', 'target_amount', "due_date", "completed")
                    ->get();

        if (count($goals) == 0) 
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay metas registradas por el usuario",
                "data" => $goals
            ];
        
        foreach ($goals as $goal) {
            $goal['progress'] = $goal->progress;

            if ($goal->progress >= $goal->target_amount) $goal['message'] = "¡Lo lograste!, Felicidades";
            elseif ($goal->due_date && $goal->due_date->lt(Carbon::today()) && !$goal->completed) $goal['status_message'] = "Tu meta venció";
            else $goal['message'] = "¡Tu puedes lograrlo!, Suerte";

            $goal->makeHidden('completed');
            $goal->makeHidden('transactions');
        }


        return [
            "error" => false,
            "code" => 200,
            "message" => "Metas obtenidas con éxito",
            "data" => $goals
        ];

    }

    public function getGoalsSummaryByUser($user_id, $data) {

        $metasColor = Color::where('name', 'Metas')->first()?->hex ?? null;

        $goals = DB::select("
                            SELECT 
                                g.id,
                                g.name,
                                COUNT(*) as total_transactions,
                                CAST(SUM(
                                    CASE 
                                        WHEN gt.transaction_type_id = 1 THEN gt.amount
                                        WHEN gt.transaction_type_id = 2 THEN -gt.amount
                                        ELSE 0
                                    END
                                ) AS SIGNED) as sum_transactions,
                                ? as color,
                                i.icon as icon
                            FROM goals g
                            INNER JOIN goal_transactions gt ON g.id = gt.goal_id
                            LEFT JOIN icons i ON i.name = 'Metas'
                            WHERE g.user_id = ?
                                AND g.status_id = 1
                                AND MONTH(gt.created_at) = ?
                                AND YEAR(gt.created_at) = ?
                            GROUP BY g.id, g.name, i.icon
                            ORDER BY total_transactions DESC
                        ", [$metasColor, $user_id, (int)$data['month'], (int)$data['year']]);


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

    public function createGoal(array $data) {
        $goal = Goal::create([
            'user_id' => $data['user_id'],
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

    public static function updateCompleted($goal_id, bool $completed) {

        $goal = Goal::find($goal_id);

        $goal->update(["completed" => $completed]);

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
