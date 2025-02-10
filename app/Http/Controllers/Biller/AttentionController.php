<?php

namespace App\Http\Controllers\Biller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Biller\Attention;

class AttentionController extends Controller
{
    public function index(Request $request, $type){
        $types = Attention::where('sunat_code', $type)->get();
        // dd($types);
        return view('admin.biller.voucher.index', compact('types'));
    }
}
