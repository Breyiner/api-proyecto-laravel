<?php

namespace App\Services\Balance;

use App\Models\Color;
use App\Models\Icon;
use Illuminate\Support\Facades\DB;

class BalanceService
{
    public function showPeriod($user_id, $data) {

        $month = $data['month'];
        $year = $data['year'];


        $transactionsSummary = DB::table('transaction_types as tt')
                ->join('colors as col', 'tt.color_id', '=', 'col.id')
                ->leftJoin('icons as i', 'tt.icon_id', '=', 'i.id')
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
                    DB::raw('MAX(col.hex) as color'),
                    DB::raw('MAX(i.icon) as icon')
                )
                ->groupBy('tt.id', 'tt.name');



        // Aquí se usa cross join para traer los colores independiente de no haber relación
        $goalsSummary = DB::table('goals as g')
                ->leftJoin('goal_transactions as gt', function($join) use ($month, $year) {
                    $join->on('gt.goal_id', '=', 'g.id')
                        ->whereMonth('gt.created_at', $month)
                        ->whereYear('gt.created_at', $year);
                })
                ->leftJoin('icons as i', function($join) {
                    $join->where('i.name', 'Metas');
                })
                ->crossJoin('colors as col')
                ->where('g.user_id', $user_id)
                ->where('g.status_id', 1)
                ->where('col.name', 'Metas')
                ->select(
                    DB::raw('"Metas" as name'),
                    DB::raw('CAST(COALESCE(SUM(CASE 
                                WHEN gt.transaction_type_id = 1 THEN gt.amount
                                WHEN gt.transaction_type_id = 2 THEN -gt.amount
                                ELSE 0
                            END), 0) AS SIGNED) as total'),
                    DB::raw('MAX(col.hex) as color'),
                    DB::raw('MAX(i.icon) as icon') 
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

        $ingresos = $finalSummary->firstWhere('name', 'Ingresos')->total ?? 0;
        $gastos   = $finalSummary->firstWhere('name', 'Gastos')->total ?? 0;
        $metas    = $finalSummary->firstWhere('name', 'Metas')->total ?? 0;

        $balance = $ingresos - $gastos - $metas;

        $balanceObj = new \stdClass();
        $balanceObj->name = 'Balance';
        $balanceObj->total = $balance;

        // Traer color
        $colorBalance = Color::where('name', 'Balance')->first();
        $balanceObj->color = $colorBalance->hex ?? '#2e73b9ffff';

        // Traer icono
        $iconBalance = Icon::where('name', 'Balance')->first();
        $balanceObj->icon = $iconBalance->icon ?? 'ri-stack-line';

        $finalSummary->prepend($balanceObj);


        return [
            "error" => false,
            "code" => 200,
            "message" => "Transacciones obtenidas con éxito",
            "data" => $finalSummary
        ];

    }
}
