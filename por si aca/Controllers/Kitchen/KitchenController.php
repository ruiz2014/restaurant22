<?php

namespace App\Http\Controllers\Kitchen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Temp_Order;
use DB;

class KitchenController extends Controller
{
    public function index(Request $req){
        $orders = Product::select("products.name", "to.table_id", "to.id", "to.status", "to.amount", "to.note", "to.created_at" ) //DB::raw("CAST(to.created_at AS TIME) as time")
                            ->join("temp_orders as to", "to.order_id", "=", "products.id")
                            ->where('to.status', '>=', 2)
                            ->where('to.business_id', 1)
                            ->where(DB::raw("CAST(to.created_at AS DATE)"), '=', DB::raw("DATE(now())"))
                            ->orderBy('id', 'desc')
                            ->get();
        // dd($orders);                    
        return view('kitchen.index', compact('orders'));                    
    }

    public function check(Request $req){
        // select(DB::raw("cast(created_at AS DATE)"))
        $check = Temp_Order::where('status', 2)
                    ->where('business_id', 1)
                    ->where(DB::raw("CAST(created_at AS DATE)"), '=', DB::raw("DATE(now())"))
                    ->value('code');
        if($check){
            $orders = Product::select("products.name", "to.table_id", "to.id", "to.status", "to.amount", "to.note")->join("temp_orders as to", "to.order_id", "=", "products.id")->where('to.code', $check)->get();

            return response()->json(['ok' => 1, 'orders' => $orders]);
        }
        // dd($check);
        return response()->json(['ok' => 0, 'error' => "No se Encontro el cliente ...."]);
    }

    public function dishReady(Request $req){
        $order = Temp_order::find($req->id);
        $order->update(['status' => 3]);

        // dd($order);
        // return response()->json(['order'=>$order]);
        // Temp_order::where('id', $req->id)->update(['status' => 3]);
        $orders =[];
        return response()->json(['ok' => 1, 'id'=>$req->id, 'message' => 'Un Plato para la mesa '.$order->table_id.' esta listo']);
    }
}
