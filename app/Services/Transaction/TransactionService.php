<?php

namespace App\Services\Transaction;

use App\Models\Transaction;

class TransactionService
{
    public function getAll() {

        $transactions = Transaction::all();

        if (count($transactions) == 0) 
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay movimientos registrados",
                "data" => $transactions
            ];


        return [
            "error" => false,
            "code" => 200,
            "message" => "Movimientos obtenidos con éxito",
            "data" => $transactions
        ];
    }

    public function getTransaction($id) {
        $transaction = Transaction::find($id);

        if (!$transaction) 
            return [
                "error" => false,
                "code" => 200,
                "message" => "Este movimiento no existe",
                "data" => $transaction
            ];


        return [
            "error" => false,
            "code" => 200,
            "message" => "Movimiento obtenido con éxito",
            "data" => $transaction
        ];
    }

    public function getTransactionsByCategory($category_id) {

        $transactions = Transaction::where('transaction_category_id', $category_id)->get();

        if (count($transactions) == 0) 
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay movimientos registrados para la categoría",
                "data" => $transactions
            ];


        return [
            "error" => false,
            "code" => 200,
            "message" => "Movimientos obtenidos con éxito",
            "data" => $transactions
        ];

    }

    public function getTransactionsByUser($user_id) {

        $transactions = Transaction::where('user_id', $user_id)->get();

        if (count($transactions) == 0) 
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay movimientos registrados para el usuario",
                "data" => $transactions
            ];


        return [
            "error" => false,
            "code" => 200,
            "message" => "Movimientos obtenidos con éxito",
            "data" => $transactions
        ];

    }

    public function getTransactionsByCategoryPeriod($user_id, $data) {

        $transactions = Transaction::query()
                                ->where('user_id', $user_id)
                                ->where('transaction_category_id', $data['transaction_category_id'])
                                ->whereMonth('created_at', $data['month'])
                                ->whereYear('created_at', $data['year'])
                                ->get();

        if (count($transactions) == 0) 
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay movimientos registrados para estos parámetros",
                "data" => $transactions
            ];


        return [
            "error" => false,
            "code" => 200,
            "message" => "Movimientos obtenidos con éxito",
            "data" => $transactions
        ];
    }

    public function getTransactionsByDate($user_id, $data) {

        $transactions = Transaction::query()
                                ->where('user_id', $user_id)
                                ->whereDate('created_at', $data['date'])
                                ->get();

        if (count($transactions) == 0) 
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay movimientos registrados para estos parámetros",
                "data" => $transactions
            ];


        return [
            "error" => false,
            "code" => 200,
            "message" => "Movimientos obtenidos con éxito",
            "data" => $transactions
        ];

    }

    public function createTransaction($data) {

        $transaction = Transaction::create($data);

        return [
            'error' => false,
            'code' => 201,
            'message' => 'Movimiento creado con éxito',
        ];
    }

    public function updateTransaction($transaction_id, $data) {
    
        $transaction = Transaction::find($transaction_id);

        if (!$transaction) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este movimiento no existe",
            ];
    
        $transaction->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Movimiento actualizado con éxito",
        ];
    }

    public function partialUpdateTransaction($transaction_id, $data) {
    
        $transaction = Transaction::find($transaction_id);

        if (!$transaction) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este movimiento no existe",
            ];
    
        $transaction->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Movimiento actualizado con éxito",
        ];
    }

        public function deleteTransaction($id) {

        $transaction = Transaction::find($id);
        
        if (!$transaction) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este movimiento no existe",
            ];

        $transaction->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Movimiento eliminado con éxito",
        ];
    }
}
