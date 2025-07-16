<?php

namespace App\Http\Controllers\Biller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Biller\Attention;
use DB;

class AttentionController extends Controller
{
    public function index(Request $request, $type){
        $title = '';
        switch($type){
            case '01':
                $title = 'Facturas';
            break;
            case '03':
                $title = 'Boletas';
            break;
            default :
                $title = 'Tickets';

        }
        $search = $request->search;
        $select = ['attentions.id', 'attentions.identifier', 'attentions.cdr', 'attentions.success', 'attentions.total', 'attentions.created_at', 'ct.name'];
        
        $types = Attention::select($select)
                ->where('attentions.sunat_code', $type) 
                ->join('customers as ct', 'ct.id', '=', 'attentions.customer_id')
                ->Where(function($query) use ($select, $search) {
                    foreach($select as $col){
                        $query->orWhere($col,'LIKE',"%$search%");
                    }
                })->paginate(); 
//  dd($types);
        return view('admin.biller.voucher.index', compact('title', 'types', 'search'));
    }
}
