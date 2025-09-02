<?php

namespace App\Services\Transaction;

use App\Models\Transaction;
use App\Models\TransactionCategory;
use Illuminate\Support\Facades\DB;

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

    public function getCountTransactions() {

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
            "data" => count($transactions)
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
                ->join('transaction_categories as c', 'transactions.transaction_category_id', '=', 'c.id')
                ->join('transaction_types as tt', 'c.transaction_type_id', '=', 'tt.id')
                ->join('colors as col', 'tt.color_id', '=', 'col.id')
                ->leftJoin('icons as i', 'c.icon_id', '=', 'i.id') // left join: icono opcional
                ->where('transactions.user_id', $user_id)
                ->where('transactions.transaction_category_id', $data['transaction_category_id'])
                ->whereMonth('transactions.created_at', $data['month'])
                ->whereYear('transactions.created_at', $data['year'])
                ->orderBy('transactions.id', 'desc')
                ->select(
                    'transactions.*',
                    'col.hex as color',
                    DB::raw('COALESCE(i.icon, "") as icon')
                )
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


    public function getTransactionsByPeriod($user_id, $data) {

        $transactions = Transaction::query()
                    ->leftJoin('transaction_categories as c', 'transactions.transaction_category_id', '=', 'c.id')
                    ->leftJoin('transaction_types as tt', 'c.transaction_type_id', '=', 'tt.id')
                    ->leftJoin('colors as col', 'tt.color_id', '=', 'col.id')
                    ->where('transactions.user_id', $user_id)
                    ->where('tt.id', $data['transaction_type_id'])
                    ->whereMonth('transactions.created_at', $data['month'])
                    ->whereYear('transactions.created_at', $data['year'])
                    ->select(
                        'transactions.*',
                        'col.hex as color'
                    )
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
            ->leftJoin('transaction_categories as c', 'transactions.transaction_category_id', '=', 'c.id')
            ->leftJoin('transaction_types as tt', 'c.transaction_type_id', '=', 'tt.id')
            ->leftJoin('colors as col', 'tt.color_id', '=', 'col.id')
            ->leftJoin('icons as ic', 'c.icon_id', '=', 'ic.id')
            ->where('transactions.user_id', $user_id)
            ->where('tt.id', $data['type_id'])
            ->whereDate('transactions.created_at', $data['date'])
            ->select(
                'transactions.*',
                'col.hex as color',
                'ic.icon as icon'
            )
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

        $category = TransactionCategory::find($data['transaction_category_id']);

        $transcType = $category->transactionType;

        match ($transcType->id) {
            1 => $data['name'] = "Recibiste dinero por $category->name",
            2 => $data['name'] = "Gastaste dinero en $category->name",
        };

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
