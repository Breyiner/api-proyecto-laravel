<?php

namespace App\Services\GoalTransaction;

use App\Models\GoalTransaction;
use Illuminate\Support\Arr;

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
        $transaction = GoalTransaction::create([
            'goal_id' => $data['goal_id'],
            'amount' => $data['amount'],
            'description' => $data['description'],
            'transaction_type_id' => $data['transaction_type_id'],
        ]);

        return [
            'error' => false,
            'code' => 201,
            'message' => 'Transacción creada con éxito',
            'data' => $transaction
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
            "data" => $transaction
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
            "data" => $transaction
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