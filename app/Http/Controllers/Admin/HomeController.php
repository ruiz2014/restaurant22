<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Biller\PaymentMethod;
use App\Models\Biller\PaymentLog;
use App\Models\Biller\Attention;
use App\Models\Temp_Order;

use DB;


class HomeController extends Controller
{
    
    public function index(Request $req){
        $currentMonth = date('n');
        $currentWeek = date("W");
        $currentDay = date("d");

        $receipts = $this->receipts($currentMonth)->pluck('cod');
        $pays = $this->paymentMethods($currentMonth);
        $months = $this->monthlyCare()->pluck('months');
        $monthlyCare = $this->monthlyCare()->pluck('total');
        //$amountAttention = $this->monthlyCare()->where('month', $currentMonth)->first(); //where('month', DB::raw('MONTH(now()'));
        // $weekAttention = $this->monthlyCare()->where('week', $currentWeek)->first();
        
        $attentionDay = $this->currentDay($currentMonth, $currentDay);
        $attentionWeek = $this->currentWeek($currentWeek);
        $bestSeller = $this->selling($currentMonth)->pluck('name');
        $bestSellerQty = $this->selling($currentMonth)->pluck('dish');
        // dd($this->currentDay($currentMonth, $currentDay), $weekAttention, $currentWeek, $currentDay, $currentMonth);
        // dd($monthlyCare, $receipts, $currentWeek );
        return view('admin.home.index', compact('receipts', 'pays', 'attentionDay', 'monthlyCare', 'months', 'bestSeller', 'bestSellerQty', 'attentionWeek'));
    }

    public function paymentMethods($month){

        $methods = PaymentMethod::select(DB::raw('SUM(pl.total) as total'), 'payment_methods.name', 'payment_methods.image')
                    ->leftJoin('payment_logs as pl', 'payment_methods.id', '=', 'pl.method_id')
                    ->join('attentions as at', 'pl.attention_id', '=', 'at.id')
                    ->where(DB::raw('MONTH(at.created_at)'), $month)
                    ->groupBy('payment_methods.name')
                    ->get();
        return $methods;         
    }

    public function monthlyCare(){
        $attentions = Attention::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(id) as attentions'), DB::raw('SUM(total) as total'), DB::raw('ELT(MONTH(created_at), "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre") as months'), 'created_at')
                    ->orderBy('month')            
                    ->groupBy('months')
                    ->get();
        // dd($attentions);            
        return $attentions;                
    }

    public function currentDay($month, $day){
        $attentions = Attention::select(DB::raw('COUNT(id) as attentions'), DB::raw('SUM(total) as total'), DB::raw('DAY(created_at) as day'))
                    ->where(DB::raw('MONTH(created_at)'), $month)
                    ->where(DB::raw('DAY(created_at)'), $day)
                    ->first();
        return $attentions;            
    }

    public function currentWeek($week){
        $week = Attention::select(DB::raw('SUM(total) as total'), DB::raw('COUNT(id) as attentions'))
                    ->where(DB::raw('WEEK(created_at, 1)'), $week)
                    ->first();
        // dd($week);
        return $week;            
    }

    public function receipts($month){
        $receipts = Attention::select(DB::raw('COUNT(sunat_code) as cod'), 'sunat_code')
                    ->where(DB::raw('MONTH(created_at)'), $month)
                    ->orderBy('sunat_code')
                    ->groupBy('sunat_code')
                    ->get();
                    // dd($receipts);
        return  $receipts;          
    }

    public function selling($month){
        $dishes = Temp_Order::select(DB::raw('COUNT(temp_orders.order_id) as dish'), 'name')
                ->join('products as pd', 'temp_orders.order_id', '=', 'pd.id')
                // ->where('pd.category_id', 2)
                ->where(DB::raw('MONTH(temp_orders.created_at)'), $month)
                // ->orderBy('dish', 'desc')
                ->orderBy('dish', 'desc')
                ->groupBy('order_id')
                ->get();
                // ->where('')
            // dd($dishes);        
        return $dishes;        
    }
}
