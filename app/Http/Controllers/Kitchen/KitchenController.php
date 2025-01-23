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
        $orders = Product::select("products.name", "to.table_id", "to.id", "to.status", "to.amount", "to.note", "to.created_at", "ta.identifier", "ro.name as room" ) //DB::raw("CAST(to.created_at AS TIME) as time")
                            ->join("temp_orders as to", "to.order_id", "=", "products.id")                    
                            ->join("tables as ta", "ta.id", "=", "to.table_id")
                            ->join("rooms as ro", "ro.id", "=", "ta.room_id")
                            ->where('to.status', '>=', 2)
                            ->where('to.business_id', 1)
                            ->where(DB::raw("CAST(to.created_at AS DATE)"), '=', DB::raw("DATE(now())"))
                            ->orderBy('to.id', 'desc')
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

        // $orders = Product::select("products.name", "to.table_id", "to.id", "to.status", "to.amount", "to.note", "ta.identifier", "ro.name as room")
        // ->join("temp_orders as to", "to.order_id", "=", "products.id")
        // ->join("tables as ta", "ta.id", "=", "to.table_id")
        // ->join("rooms as ro", "ro.id", "=", "ta.room_id")
        // ->where('to.code', $check)->get();
        // dd($check);
        return response()->json(['ok' => 0, 'error' => "No se Encontro el cliente ...."]);
    }

    public function dishReady(Request $req){
        $order = Temp_order::find($req->id);
        $order->update(['status' => 3]);

        // dd($order);
        // return response()->json(['order'=>$order]);
        // Temp_order::where('id', $req->id)->update(['status' => 3]);
        $resp = Temp_order::select("ta.identifier", "ro.name as room" ) //DB::raw("CAST(to.created_at AS TIME) as time")                  
                            ->join("tables as ta", "ta.id", "=", "temp_orders.table_id")
                            ->join("rooms as ro", "ro.id", "=", "ta.room_id")
                            ->first();
        $orders =[];
        return response()->json(['ok' => 1, 'id'=>$req->id, 'message' => 'Plato para el '.$resp->room.' la mesa '.$resp->identifier.' esta listo']);
    }
}
