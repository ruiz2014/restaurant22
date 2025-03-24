<?php

namespace App\Http\Controllers\Tool;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;

class ToolController extends Controller
{
    public function search(Request $req){
        $text = $req->customer;
        $result = Customer::where("name", "like", $text."%")
                        ->select("id", "name", "document")
                        ->take(20)
                        ->get();

        return response()->json($result);
    }

    public function registerCustomer(CustomerRequest $req){
        // dd("hola");
        // We are collecting all data submitting via Ajax
        $input = $req->all();
        // dd($input, $req->name);
        // Sending json response to client
        return response()->json([
            "status" => true,
            "data" => $input
        ]);
    }
}
