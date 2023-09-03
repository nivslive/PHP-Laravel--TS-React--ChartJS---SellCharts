<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Sell, SellForecast};
use Carbon\{Carbon};

class SellController extends Controller
{
    
    public function get_sales($perYear = false, $year = null) {
        if(!$perYear) {
            return Sell::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(price) as total_price, COUNT(*) as product_count')
                ->groupBy('year', 'month')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get();
        }

        return Sell::selectRaw('YEAR(created_at) as year, SUM(price) as total_price, COUNT(*) as product_count')
            ->whereRaw('YEAR(created_at) = ?', [$year])
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->get();
    }

    public function get_sales_by_all_times() {
        $sales = $this->get_sales();
        $totalPrices = $sales->pluck('total_price')->toArray();
        $productCounts = $sales->pluck('product_count')->toArray();
    
        // Determinar períodos
        $periods = $sales->map(function ($item) {
            return sprintf('%02d/%02d', $item->month, $item->year);
        })->toArray();
    
        // Obter projeções de lucro
        $sellForecasts = SellForecast::select('price')->get()->pluck('price')->toArray();
    
        return response()->json([
            'sales_by_month' => $sales,
            'total_price_sells' => $totalPrices,
            'product_counts' => $productCounts,
            'periods' => $periods,
            'sell_forecasts' => $sellForecasts,
        ]);
    }


    public function get_sales_by_year($year) {
        $salesByYear = $this->get_sales(perYear: true, year: $year);
    
        $totalPrices = $salesByYear->pluck('total_price')->toArray();
        $productCounts = $salesByYear->pluck('product_count')->toArray();
        $years = $salesByYear->pluck('year')->toArray();
    
        // Obter projeções de lucro
        $sellForecasts = SellForecast::select('price')->get()->pluck('price')->toArray();
    
        return response()->json([
            'sales_by_year' => $salesByYear,
            'total_price_sells' => $totalPrices,
            'product_counts' => $productCounts,
            'years' => $years,
            'sell_forecasts' => $sellForecasts,
        ]);
    }


    // public function count_all_price_sells_by_year($year) {
    //     $startDate = Carbon::create($year, 1, 1, 0, 0, 0)->startOfYear();
    //     $endDate = $startDate->copy()->endOfYear();
    
    //     $sales = Sell::whereBetween('created_at', [$startDate, $endDate])->get();
    //     $totalPrice = $sales->sum('price');
    
    //     return response()->json([
    //         'total_price' => $totalPrice,
    //         'sales' => $sales,
    //     ]);
    // }


    // public function count_all_price_sells_by_period($month, $year) {
    //     $startDate = Carbon::create($year, $month, 1, 0, 0, 0)->startOfMonth();
    //     $endDate = $startDate->copy()->endOfMonth();
    
    //     $sales = Sell::whereBetween('created_at', [$startDate, $endDate])->get();
    //     $totalPrice = $sales->sum('price');
    
    //     return response()->json([
    //         'total_price' => $totalPrice,
    //         'sales' => $sales,
    //     ]);
    // }
    
    
    // public function get_sales_by_period($startMonth, $startYear, $endMonth, $endYear) {
    //     $startDate = Carbon::create($startYear, $startMonth, 1, 0, 0, 0)->startOfMonth();
    //     $endDate = Carbon::create($endYear, $endMonth, 1, 0, 0, 0)->endOfMonth();
        
    //     $salesByMonth = Sell::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(price) as total_price')
    //         ->whereBetween('created_at', [$startDate, $endDate])
    //         ->groupBy('year', 'month')
    //         ->get();
    
    //     return response()->json([
    //         'sales_by_month' => $salesByMonth,
    //     ]);
    // }


    // private function getPeriodDates($month, $year)
    // {

    //     $date = Carbon::create($year, $month);

    //     // $sameMonthLastYear = $date->subYear()->format('Ym'); //202009
    //     $lastMonthYear =  $date->subMonth(); //202108

    //     $startDate = Carbon::create($year, $month, 1, 0, 0, 0)->startOfMonth();
    //     $endDate = $lastMonthYear->copy()->endOfMonth();
    
    //     return [$lastMonthYear->format('Y-m-d')." 00:00:00", $endDate->format('Y-m-d')." 00:00:00"];
    // }

    
    // private function quantifySales($sales)
    // {
    //     $quantifiedData = [];

    //     foreach ($sales as $sale) {
    //         $date = Carbon::parse($sale->created_at);
    //         $year = $date->format('Y');
    //         $month = $date->format('m');
            
    //         if (!isset($quantifiedData[$year])) {
    //             $quantifiedData[$year] = [];
    //         }
            
    //         if (!isset($quantifiedData[$year][$month])) {
    //             $quantifiedData[$year][$month] = [
    //                 'quantity' => 0,
    //             ];
    //         }
            
    //         $quantifiedData[$year][$month]['quantity'] += 1;
    //     }

    //     return $quantifiedData;
    // }

    // public function forecast_sells() {

    // }
}
