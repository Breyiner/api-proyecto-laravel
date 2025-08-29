<?php

namespace App\Services\GoalTransaction;

use App\Models\Goal;
use App\Models\GoalTransaction;
use App\Models\GoalTransactionType;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class   GoalTransactionService
{
    public static function getAll()
    {
        $transactions = GoalTransaction::all();

        if ($transactions->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay transacciones registradas",
                "data" => $transactions
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Transacciones obtenidas con éxito",
            "data" => $transactions
        ];
    }

    public function getOwnDate($user_id, $data) {

        $transactions = GoalTransaction::query()
                    ->join('goals', 'goal_transactions.goal_id', '=', 'goals.id')
                    ->join('goal_transaction_types as gtt', 'goal_transactions.transaction_type_id', '=', 'gtt.id')
                    ->join('colors as col', 'gtt.color_id', '=', 'col.id')
                    ->where('goals.user_id', $user_id)
                    ->whereDate('goal_transactions.created_at', $data['date'])
                    ->orderBy('goal_transactions.id', 'desc')
                    ->get([
                        'goal_transactions.id',
                        'goal_transactions.goal_id',
                        DB::raw("DATE(goal_transactions.created_at) as created_at"),
                        DB::raw("CAST(goal_transactions.amount AS SIGNED) as amount"),
                        'col.hex as color',
                    ]);


        if ($transactions->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay transacciones registradas",
                "data" => $transactions
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Transacciones obtenidas con éxito",
            "data" => $transactions
        ];

    }

    public function getOWnPeriod($user_id, $data) {

        $transactions = GoalTransaction::query()
                    ->join('goals', 'goal_transactions.goal_id', '=', 'goals.id')
                    ->join('goal_transaction_types as gtt', 'goal_transactions.transaction_type_id', '=', 'gtt.id')
                    ->join('colors as col', 'gtt.color_id', '=', 'col.id')
                    ->where('goals.user_id', $user_id)
                    ->whereMonth('goal_transactions.created_at', $data['month'])
                    ->whereYear('goal_transactions.created_at', $data['year'])
                    ->orderBy('goal_transactions.id', 'desc')
                    ->get([
                        'goal_transactions.id',
                        'goal_transactions.goal_id',
                        'goal_transactions.name',
                        DB::raw("DATE(goal_transactions.created_at) as created_at"),
                        DB::raw("CAST(goal_transactions.amount AS SIGNED) as amount"),
                        'col.hex as color',
                    ]);

        if ($transactions->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay transacciones registradas",
                "data" => $transactions
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Transacciones obtenidas con éxito",
            "data" => $transactions
        ];
    }

    public function getByGoalPeriod($goal_id, $data) {

        $transactions = GoalTransaction::query()
                    ->join('goal_transaction_types as gtt', 'goal_transactions.transaction_type_id', '=', 'gtt.id')
                    ->join('colors as col', 'gtt.color_id', '=', 'col.id')
                    ->where('goal_transactions.goal_id', $goal_id)
                    ->whereMonth('goal_transactions.created_at', $data['month'])
                    ->whereYear('goal_transactions.created_at', $data['year'])
                    ->orderBy('goal_transactions.id', 'desc')
                    ->get([
                        'goal_transactions.*',
                        'col.hex as color',
                    ]);

        if ($transactions->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay transacciones registradas",
                "data" => $transactions
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Transacciones obtenidas con éxito",
            "data" => $transactions
        ];

    }

    public function getGoalTransaction($id)
    {
        $transaction = GoalTransaction::find($id);

        if (!$transaction) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Esta transacción no existe",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Transacción obtenida con éxito",
            "data" => $transaction
        ];
    }

    public function createGoalTransaction(array $data)
    {

        $goal = Goal::find($data['goal_id']);

        $transcType = GoalTransactionType::find($data['transaction_type_id']);

        match ($transcType->id) {
            1 => $data['name'] = "Ingresaste dinero a la meta: $goal->name",
            2 => $data['name'] = "Retiraste dinero de la meta: $goal->name",
        };

        $transaction = GoalTransaction::create([
            'goal_id' => $data['goal_id'],
            'name' => $data['name'],
            'amount' => $data['amount'],
            'description' => $data['description'],
            'transaction_type_id' => $data['transaction_type_id'],
        ]);

        return [
            'error' => false,
            'code' => 201,
            'message' => 'Transacción creada con éxito',
        ];
    }

    public function updateGoalTransaction(array $data, $id)
    {
        $transaction = GoalTransaction::find($id);

        if (!$transaction) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Esta transacción no existe",
            ];
        }

        $transaction->update(Arr::only($data, ['amount', 'description', 'transaction_type_id']));

        return [
            "error" => false,
            "code" => 200,
            "message" => "Transacción actualizada con éxito",
        ];
    }

    public function partialUpdateGoalTransaction(array $entryData, $id)
    {
        $transaction = GoalTransaction::find($id);

        if (!$transaction) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Esta transacción no existe",
            ];
        }

        // goal_id nunca se debe actualizar
        unset($entryData['goal_id']);

        $transaction->update($entryData);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Transacción actualizada con éxito",
        ];
    }

    public function deleteGoalTransaction($id)
    {
        $transaction = GoalTransaction::find($id);

        if (!$transaction) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Esta transacción no existe",
            ];
        }

        $transaction->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Transacción eliminada con éxito",
        ];
    }
}