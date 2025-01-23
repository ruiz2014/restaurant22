<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Temp_Order;
use App\Models\Room\Room;
use App\Models\Room\Table;
use Illuminate\Http\Request;
use DB;

class DiningHallController extends Controller
{
    public function hall(Request $req){
        
        $group = 1;
        $dishes = $this->getProducts(2, $group); //Product::select(DB::raw("CONCAT(name,' ',price) AS name"),'id')->where('product_type', 1)->pluck('name', 'id');
        $drinks = $this->getProducts(3, $group); //Product::select(DB::raw("CONCAT(name,' ',price) AS name"),'id')->where('product_type', 2)->pluck('name', 'id');
        $fittings = $this->getProducts(4, $group); //Product::select(DB::raw("CONCAT(name,' ',price) AS name"),'id')->where('product_type', 3)->pluck('name', 'id');
        $others = $this->getProducts(5, $group); //Product::select(DB::raw("CONCAT(name,' ',price) AS name"),'id')->where('product_type', 4)->pluck('name', 'id');
        $rooms = Room::select('id', 'name')->get();
        $tables = Table::select('id', 'identifier', 'room_id')->get();
        
        return view('hall', compact('dishes', 'drinks', 'fittings', 'others', 'tables', 'rooms'));
    }

    public function check(Request $req){
        // select(DB::raw("cast(created_at AS DATE)"))
        
        $check = Temp_Order::where('table_id', $req->table)
                    ->where('status', '<=', 3)
                    ->where('business_id', 1)
                    ->where(DB::raw("CAST(created_at AS DATE)"), '=', DB::raw("DATE(now())"))
                    ->value('code');
        if($check){
            $orders = Product::select("products.name", "products.price", "to.id", "to.status", "to.amount")->join("temp_orders as to", "to.order_id", "=", "products.id")->where('to.code', $check)->get();
            // $orders = Temp_Order::where('')
            // dd($orders);
            $numberOrders = Temp_order::where('code', $check)->count();
            $ordersSent = Temp_order::where('code', $check)->where('status', 3)->count();
            $sign = $numberOrders == $ordersSent ? 1 : 0;

            return response()->json(['ok' => 1, 'orders' => $orders, 'sign'=> $sign]);
        }
        // dd($check);
        return response()->json(['ok' => 0, 'error' => "No se Encontro el cliente ...."]);
    }

    public function addOrder(Request $req){

        $code = date('YmdHis');
        $check = Temp_Order::where('table_id', $req->order['table'])
        ->where('status', '<=', 3)
        ->where('business_id', 1)
        ->where(DB::raw("CAST(created_at AS DATE)"), '=', DB::raw("DATE(now())"))
        ->value('code');
        
        if($check){
            $id_order=Temp_Order::create(['code'=>$check, 'table_id'=>$req->order['table'], 'order_id'=>$req->order['id'], 'amount'=>$req->order['cantidad'], 'price'=> $req->order['price'], 'status' => 1, 'business_id'=>1 ]);
            $orders = Product::select("products.name", "products.price", "to.id", "to.status", "to.amount")->join("temp_orders as to", "to.order_id", "=", "products.id")->where('to.code', $check)->get();
            return response()->json(['ok' => 1, 'orders' => $orders]);
        }else{

            $id_order=Temp_Order::create(['code'=>$code, 'table_id'=>$req->order['table'], 'order_id'=>$req->order['id'], 'amount'=>$req->order['cantidad'], 'price'=> $req->order['price'], 'status' => 1, 'business_id'=>1 ]);
            $orders = Product::select("products.name", "products.price", "to.id", "to.status", "to.amount")->join("temp_orders as to", "to.order_id", "=", "products.id")->where('to.code', $id_order->code)->get();
            return response()->json(['ok' => 1, 'orders' => $orders]);
        }

    }

    public function modifyAmount(Request $req){
        $orders = Temp_order::where('id', $req->id)->update(['amount' => $req->amount]);
        return response()->json(['ok' => 1, 'orders' => $orders]);
    }

    // public function modifyAmount(Request $req){
    //     Temp_order::where('id', $req->id)->update(['amount' => $req->amount]);
    //     $check = Temp_order::where('id', $req->id)->value('code');
    //     $orders = Product::select("products.name", "products.price", "to.id", "to.status", "to.amount")->join("temp_orders as to", "to.order_id", "=", "products.id")->where('to.code', $check)->get();
    //     return response()->json(['ok' => 1, 'orders' => $orders]);
    // }

    public function addNote(Request $req){
        $orders = Temp_order::where('id', $req->id)->update(['note' => $req->note]);
        return response()->json(['ok' => 1, 'orders' => $orders]);
    }
    
    public function deleteOrder(Request $req){
        $order = Temp_order::find($req->id);
        $check = $order->code;
        $order->delete();

        $numberOrders = Temp_order::where('code', $check)->count();
        $ordersSent = Temp_order::where('code', $check)->where('status', 3)->count();
        $sign = $numberOrders == $ordersSent ? 1 : 0;

        $orders = Product::select("products.name", "products.price", "to.id", "to.status", "to.amount")->join("temp_orders as to", "to.order_id", "=", "products.id")->where('to.code', $check)->get();
        return response()->json(['ok' => 1, 'orders' => $orders, 'sign'=> $sign]);
    }

    public function sendToKitchen(Request $req){
        $check = Temp_Order::where('table_id', $req->table)
            ->where('status', 1)
            ->where('business_id', 1)
            ->where(DB::raw("CAST(created_at AS DATE)"), '=', DB::raw("DATE(now())"))
            ->value('code');

        if($check){
            $sendOrders = Product::select("products.name", "products.price", "to.table_id", "to.id", "to.status", "to.amount", "to.note", "to.created_at", "ta.identifier", "ro.name as room")
                                ->join("temp_orders as to", "to.order_id", "=", "products.id")
                                ->join("tables as ta", "ta.id", "=", "to.table_id")
                                ->join("rooms as ro", "ro.id", "=", "ta.room_id")
                                ->where('to.code', $check)
                                ->where('to.status', 1)
                                ->get();
                                
            Temp_Order::where('code', $check)->where('status', 1)->update(['status'=> 2]);
            $orders = Product::select("products.name", "products.price", "to.table_id", "to.id", "to.status", "to.amount", "to.note")->join("temp_orders as to", "to.order_id", "=", "products.id")->where('to.code', $check)->get();
            // Temp_Order::where('code', $check)->where('status', 1)->update(['status'=> 2]);
            return response()->json(['ok' => 1, 'orders' => $orders, 'sendOrders'=> $sendOrders]);
        }       

        return response()->json(['ok' => 0, 'orders' => []]);
    }

    public function finalizeOrder(Request $req){
        $check = Temp_Order::where('table_id', $req->order_table)
            ->where('status', 3)
            ->where('business_id', 1)
            ->where(DB::raw("CAST(created_at AS DATE)"), '=', DB::raw("DATE(now())"))
            ->value('code');
// dd($check);
        if($check){ 
            Temp_order::where('code', $check)->update(['status' => 4]);
            return redirect()->route('hall')->with('success', 'La orden fue enviada a caja');
        }  
        
        return redirect()->route('hall')->with('danger', 'No se encontro la orden de la mesa');

    }

    protected function getProducts($type, $group){
        // $result = Product::select(DB::raw("CONCAT(name,' ',price) AS name"),'id')->where('category_id', $type)->where('group', $group)->where('status', 1)->pluck('name', 'id');
        // $result = Product::select(DB::raw("CONCAT(name,' ',price) AS name"),'id')->withTrashed()->where('category_id', $type)->where('group', $group)->pluck('name', 'id');
        $result = Product::select(DB::raw("CONCAT(name,' ',price) AS name"),'id')->where('category_id', $type)->where('group', $group)->pluck('name', 'id');
        return $result;
    }
}