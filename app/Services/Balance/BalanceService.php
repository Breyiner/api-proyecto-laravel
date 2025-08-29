<?php

namespace App\Services\Balance;

use Illuminate\Support\Facades\DB;

class BalanceService
{
    public function showPeriod($user_id, $data) {

        $month = $data['month'];
        $year = $data['year'];


        $transactionsSummary = DB::table('transaction_types as tt')
                    ->join('colors as col', 'tt.color_id', '=', 'col.id')
                    ->leftJoin('transaction_categories as c', 'c.transaction_type_id', '=', 'tt.id')
                    ->leftJoin('transactions as t', function ($join) use ($user_id, $month, $year) {
                        $join->on('t.transaction_category_id', '=', 'c.id')
                            ->where('t.user_id', $user_id)
                            ->whereMonth('t.created_at', $month)
                            ->whereYear('t.created_at', $year);
                    })
                    ->select(
                        'tt.name as name',
                        DB::raw('CAST(COALESCE(SUM(t.amount), 0) AS SIGNED) as total'),
                        'col.hex as color'
                    )
                    ->groupBy('tt.id', 'tt.name', 'col.hex');

        $goalsSummary = DB::table('goal_transactions as gt')
                    ->join('goals as g', 'gt.goal_id', '=', 'g.id')
                    ->where('g.user_id', $user_id)
                    ->where('g.status_id', 1) // solo metas activas
                    ->whereMonth('gt.created_at', $month)
                    ->whereYear('gt.created_at', $year)
                    ->select(
                        DB::raw('"Metas" as name'),
                        DB::raw('CAST(COALESCE(SUM(CASE 
                                        WHEN gt.transaction_type_id = 1 THEN gt.amount
                                        WHEN gt.transaction_type_id = 2 THEN -gt.amount
                                        ELSE 0
                                    END), 0) AS SIGNED) as total'),
                        DB::raw('NULL as color')
                    );


        $finalSummary = $transactionsSummary
            ->unionAll($goalsSummary)
            ->get();

        if ($finalSummary->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay registradas",
                "data" => $finalSummary
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Transacciones obtenidas con éxito",
            "data" => $finalSummary
        ];

    }
}
