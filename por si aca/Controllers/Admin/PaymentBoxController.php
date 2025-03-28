<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Temp_Order;
use App\Models\Biller\Attention;
use App\Models\Biller\Log_Receipt;
use DB;

use Illuminate\Support\Facades\Validator;
use App\Traits\BillingConfigurationTrait;
use App\Traits\BillingToolsTrait;

use Greenter\Model\Response\BillResult;
use Greenter\Model\Sale\FormaPagos\FormaPagoContado;
use Greenter\Model\Sale\Invoice;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Model\Sale\Legend;

use Greenter\Model\Summary\Summary;
use Greenter\Model\Summary\SummaryDetail;


// use Greenter\Ws\Services\SunatEndpoints;
use App\Http\Controllers\NumeroALetras;

use DateTime;
use DOMDocument;
// use \PDF;
// use Exception;
use Illuminate\Support\Facades\Log;

class PaymentBoxController extends Controller
{
    use BillingConfigurationTrait, BillingToolsTrait;

    public function index(Request $request){
        $attentions = Temp_Order::where('status', 4)
                    ->where(DB::raw("CAST(created_at AS DATE)"), '=', DB::raw("DATE(now())"))
                    ->orderBy('id', 'desc')
                    ->get();

        return view('cash_register.index', compact('attentions'));
    }

    public function show(Request $request, $order){
        // dd($order);
        $attentions = Temp_Order::join('products as p', 'p.id', '=', 'temp_orders.order_id')
                    ->where('temp_orders.status', 4)
                    ->where('temp_orders.code', $order)
                    // ->where(DB::raw("CAST(created_at AS DATE)"), '=', DB::raw("DATE(now())"))
                    // ->orderBy('id', 'desc')
                    ->get();
        $total = Temp_Order::where('code', $order)->sum('amount');

        return view('cash_register.bill', compact('attentions', 'total', 'order'));
    }

    public function store(Request $request){

        $campos = [
            "customer_id"=>"required",
            "customer_doc"=>"required",
            "receipt"=>"required",
            "code"=>"required",
            // "postal"=>"required|digits:5",
        ];
        // $mensajes =[
        // ]; 

        // $validator = Validator::make($request->all(), $campos);
        Validator::make($request->all(), $campos)->validate();
        // if ($validator->fails()) {
        //     $errors = $validator->errors();
        //     return response()->json([
        //         'nombre'=> $errors->get('nombre'),
        //     ]);
        // }

        if (Temp_Order::where('code', $request->code)->exists()) {

            $attentions = Temp_Order::where('temp_orders.code', $request->code)->first();
            $total = Temp_Order::select(DB::raw('SUM(price * amount) as total'))->where('code', $request->code)->value('total');
            $numeration = $this->setCorrelative('attentions', 'sunat_code', $request->receipt);

            // foreach($attentions as $attention){
                
            // }

            $attention_id = Attention::create([
                'customer_id'=>$request->customer_id,
                'document_type'=>1,
                'sunat_code'=>$request->receipt,
                'document_code'=>$request->code,
                'reference _document'=>'',
                'currency'=>1,
                'product_id'=>0, //$attention->order_id,
                'amount'=> 0, //$attention->amount,
                'price'=> 0, //$attention->price,
                'total'=>$total,
                'seller'=>1,
                'serie'=>1,
                'numeration'=> $numeration,
            ]);

            if($attention_id->id){
                $resp = null;
                // dd($request->receipt);
                switch($request->receipt){
                    case '03' :
                            $respo = $this->boleta($request->code);
                            if($respo['success'])
                                return redirect()->route('pay.index')->with($respo['alert'], 'Boleta '.$respo['nameId'].' '.$respo['message']);  
                            else
                                return redirect()->route('pay.index')->with($respo['alert'], $respo['message']); 
                            break;
                    case '01' :
                            $respo = $this->facturacion($request->code);
                            return redirect()->route('pay.index')->with($respo['alert'], $respo['message']);   
                        break; 
                    default :
                            $respo = $this->ticket($request->code);
                            return redirect()->route('pay.index')->with($respo['alert'], $respo['message']);        
                }
            }

            // $customer_id';
            // $document_type';
            // $sunat_code', 4);
            // // $table->string('document_code', 17)->nullable();
            // // $table->string('reference _document', 17)->nullable();
            // $currency';
            // $product_id;
            // $table->float('amount', 4,1);
            // $table->double('price', 8,2);
            // $table->double('total', 8,2);
            // $seller;
            // $serie->default(1);
            // // $table->string('identifier', 20)->nullable();
            // $numeration;
            // $table->('date') timestamp NOT NULL DEFAULT current_timestamp(),
            // $table->string('hash', 50)->nullable();
            // $table->string('resume', 100)->nullable();
            // $table->string('cdr', 5)->nullable();
            // $table->unsignedTinyInteger('success')->nullable();
            // $table->string('message', 70)->nullable();
            // $table->string('low_motive', 200)->nullable();
            // $table->unsignedTinyInteger('low')->default(0);
            // $table->unsignedTinyInteger('guide')->default(0);
            // $table->unsignedTinyInteger('completed')->default(0);
            // $table->unsignedTinyInteger('dispatched')->default(0);
            // $table->unsignedTinyInteger('received')->default(0);
            // $table->timestamps();

            
    
            // dd($request->all());
            // dd($this->config());
        }

        return redirect()->route('pay.index')->with('danger', 'No se encontro la orden de la mesa');

    }

    public function boleta($order){

        $response = [
            'success' => false,
            'alert' => 'danger',
            'message' => 'No se encontro ninguna orden ',
            'nameId' => ''
        ];

        if (Attention::where('document_code', $order)->exists()) {
            try {
                $items = [];

                $codigo =null;
                $mensaje = '';

                $attentionData = Attention::where('document_code', $order)->orderBy('id', 'desc')->first();
                $attentionItems = Temp_Order::join('products as pr', 'temp_orders.order_id', '=', 'pr.id')
                                            ->where('temp_orders.code', $order)->get();

                $serie = $this->formatSerie($attentionData->serie, $attentionData->sunat_code);
                $number = str_pad($attentionData->numeration, 8, "0", STR_PAD_LEFT);

                $total = $attentionData->total;
                $subTotal = $total/1.18;
                $igv = $total - $subTotal;
            
                $invoice = new Invoice();
                $invoice
                    ->setUblVersion('2.1')
                    ->setTipoOperacion('0101')
                    ->setTipoDoc($attentionData->sunat_code)
                    ->setSerie($serie)
                    ->setCorrelativo($number)
                    ->setFechaEmision(new DateTime())
                    ->setTipoMoneda('PEN')
                    ->setCompany($this->companyData())
                    ->setClient($this->customerData())
                    ->setMtoOperGravadas(number_format($subTotal,2,'.', ''))
                    ->setMtoIGV(number_format($igv,2,'.', ''))
                    ->setTotalImpuestos(number_format($igv,2,'.', ''))
                    ->setValorVenta(number_format($subTotal,2,'.', ''))
                    ->setSubTotal(number_format($total,2,'.', ''))
                    ->setMtoImpVenta(number_format($total,2,'.', ''));
    
                foreach($attentionItems as $item){

                    // $trueQua = $item->amount * 100;
                    // $unitario = $item->price / $trueQua;

                            // $igv_base = $item->Costo / 1.18; //igv del valor unitario
                            // $montoBase = $igv_base * $item->Cantidad; //multiplicamos el valor unitario por la cantidad
                            // $igv_item = $item->Costo - $igv_base; //sacamos igv de producto unitario
                            // $igv_set = $igv_item * $item->Cantidad; // igv unitario total
                
                    $igv_base = $item->price / 1.18; //igv del valor unitario
                    $montoBase = $igv_base * $item->amount; //multiplicamos el valor unitario por la cantidad
                    $igv_item = $item->price - $igv_base; //sacamos igv de producto unitario
                    $igv_set = $igv_item * $item->amount; // igv unitario total

                    $item = (new SaleDetail())
                    ->setCodProducto($item->product_id)
                    ->setUnidad('NIU') // Unidad - Catalog. 03
                    ->setDescripcion($item->name)
                    ->setCantidad(intval($item->amount))
                    ->setMtoValorUnitario($igv_base)
                    ->setMtoValorVenta(number_format($montoBase,2,'.', ''))
                    ->setMtoBaseIgv(number_format($montoBase,2,'.', ''))
                    ->setPorcentajeIgv(18.00) // 18%
                    ->setIgv($igv_set)
                    ->setTipAfeIgv('10') // Gravado Op. Onerosa - Catalog. 07
                    ->setTotalImpuestos($igv_set) // Suma de impuestos en el detalle 
                    ->setMtoPrecioUnitario(number_format($item->price, 2,'.', ''));
                
                    array_push($items, $item);
                    $igv_base= 0;
                    $montoBase = 0;
                    $igv_item = 0;
                    $igv_set = 0; 
                }

                $convertirLetras = new NumeroALetras();
                $importeLetras = $convertirLetras->convertir($total , 'soles');
            
                $legend = (new Legend())
                    ->setCode('1000')
                    ->setValue($importeLetras);
            
                $invoice->setDetails($items)
                        ->setLegends([$legend]);
                
                $see = $this->config();
            // ****** file_put_contents(public_path().'/Sunat/Boletas/'.$invoice->getName().'.xml', $see->getFactory()->getLastXml());

                $xml_string = $see->getXmlSigned($invoice);

                $doc = new DOMDocument();
                $doc->loadXML($xml_string);
                $hash = $doc->getElementsByTagName('DigestValue')->item(0)->nodeValue;
                $date = new DateTime();
                $_fecha = $date->format('Y-m-d');
                $resumen = '20000000001|03|'.$serie.'|'.$number.'|'.round($igv, 2).'|'.round($total, 2).'|'.$_fecha.'|06|48712312';
                // $config = new config();        
                // $see = $config->config();
                // $xml = $this->getXmlSign($invoice, $see);
                // $xml =$this->getIdDocXml($invoice, $see); 
                $xml = $doc->getElementsByTagName('ID')->item(0)->nodeValue;
                $mensaje = 'Guardado para envio en resumen';

                Temp_order::where('code', $order)->update(['status'=> 5]);
                Attention::where('id', $attentionData->id)->update(['hash'=>$hash, 'identifier'=>$xml, 'cdr'=>'', 'message'=>$mensaje, 'resume' => $resumen, 'received'=>0, 'completed'=>1]);
                
                $response = [
                    'success' => true,
                    'alert' => 'success',
                    'message' => $mensaje,
                    'nameId' => $xml
                ];
                
                return $response; 
            } catch (\Throwable $th) {
                // dd(get_class_methods($th));
                Log::info("Line No : ".__LINE__." : File Path : ".__FILE__." message ".$th->getMessage()." linea : ".$th->getLine()." codigo :".$th->getCode());
                Log::error('Velocity CartController: ' . $th->getMessage(), ["hola"=>"hola"]);
                // dd("error en base ". $th->getMessage());//throw $th;
                
                $response['message'] = 'Hubo error al generar la boleta : '.$th->getMessage();
                
                return $response;
            }
        }

        return $response;

        // try {
        //     // $n1 = 7;
        //     // $n2 = 0;

        //     // $divi = $n1 / $n2;

        //     // dd("Aver ");
            
        // // } catch (Exception $th) {
        // } catch (\Throwable $th) {

        // }

        // // dd($items, $invoice, $see, $xml, $hash);        
    }

    public function facturacion($order){
        
        $response = [
                    'success' => false,
                    'alert' => 'danger',
                    'message' => 'No se encontro ninguna orden ',
                    'cdr' => null,
                    'nameId' => ''
                ];

        if (!Attention::where('document_code', $order)->exists()) {
            
            return  $response;
        }

        try {
            $items = [];
 
            $codigo ='';
            $mensaje = '';

            $attentionData = Attention::where('document_code', $order)->orderBy('id', 'desc')->first();
            // $attentionItems = Attention::join('products as pr', 'attentions.product_id', '=', 'pr.id')
            //                         ->where('attentions.document_code', $order)->get();

            $attentionItems = Temp_Order::join('products as pr', 'temp_orders.order_id', '=', 'pr.id')
                                            ->where('temp_orders.code', $order)->get();
            
            $serie = $this->formatSerie($attentionData->serie, $attentionData->sunat_code);
            $number = str_pad($attentionData->numeration, 8, "0", STR_PAD_LEFT);

            $total = $attentionData->total;
            $subTotal = $total/1.18;
            $igv = $total - $subTotal;
            // Venta
            $invoice = new Invoice();
            $invoice
                ->setUblVersion('2.1')
                ->setFecVencimiento(new DateTime())
                ->setTipoOperacion('0101')
                ->setTipoDoc($attentionData->sunat_code)
                ->setSerie($serie)
                ->setCorrelativo($number)
                ->setFechaEmision(new DateTime())
                ->setFormaPago(new FormaPagoContado())
                ->setTipoMoneda('PEN')
                ->setCompany($this->companyData())
                ->setClient($this->customerData())
                ->setMtoOperGravadas(number_format($subTotal,2,'.', ''))
                // ->setMtoOperExoneradas(100)
                ->setMtoIGV(number_format($igv,2,'.', ''))
                ->setTotalImpuestos(number_format($igv,2,'.', ''))
                ->setValorVenta(number_format($subTotal,2,'.', ''))
                ->setSubTotal(number_format($total,2,'.', ''))
                ->setMtoImpVenta(number_format($total,2,'.', ''));
                

            foreach($attentionItems as $item){

                // $trueQua = $item->Cantidad * 100;
                // $unitario = $item->Costo / $trueQua;

                // $new = round($item->Costo / $item->Cantidad, 2);
                // $qua = 1;
                // dd($trueQua, $unitario);

                // $igv_base = $item->Costo / 1.18; //igv del valor unitario
                // $montoBase = $igv_base * $item->Cantidad; //multiplicamos el valor unitario por la cantidad
                // $igv_item = $item->Costo - $igv_base; //sacamos igv de producto unitario
                // $igv_set = $igv_item * $item->Cantidad; // igv unitario total

                // $igv_base = $unitario / 1.18; //igv del valor unitario
                // $montoBase = $igv_base * $trueQua; //multiplicamos el valor unitario por la cantidad
                // $igv_item = $unitario - $igv_base; //sacamos igv de producto unitario
                // $igv_set = $igv_item * $trueQua; // igv unitario total

                $igv_base = $item->price / 1.18; //igv del valor unitario
                $montoBase = $igv_base * $item->amount; //multiplicamos el valor unitario por la cantidad
                $igv_item = $item->price - $igv_base; //sacamos igv de producto unitario
                $igv_set = $igv_item * $item->amount; // igv unitario total

                $item = (new SaleDetail())
                ->setCodProducto($item->product_id)
                ->setUnidad('NIU') // Unidad - Catalog. 03
                ->setDescripcion($item->name)
                ->setCantidad(intval($item->amount))
                ->setMtoValorUnitario($igv_base)
                ->setMtoValorVenta(number_format($montoBase,2,'.', ''))
                ->setMtoBaseIgv(number_format($montoBase,2,'.', ''))
                ->setPorcentajeIgv(18.00) // 18%
                ->setIgv($igv_set)
                ->setTipAfeIgv('10') // Gravado Op. Onerosa - Catalog. 07
                ->setTotalImpuestos($igv_set) // Suma de impuestos en el detalle 
                ->setMtoPrecioUnitario(number_format($item->price, 2,'.', ''));

                array_push($items, $item);
                $igv_base= 0;
                $montoBase = 0;
                $igv_item = 0;
                $igv_set = 0; 
            } 
            
            $convertirLetras = new NumeroALetras();
            $importeLetras = $convertirLetras->convertir($total , 'soles');
        
            $legend = (new Legend())
                ->setCode('1000')
                ->setValue($importeLetras);
        
            $invoice->setDetails($items)
                    ->setLegends([$legend]);

            // $config = new config();        
            // $see = $config->config();

            $see = $this->config();

            $xml_string = $see->getXmlSigned($invoice);
            $doc = new DOMDocument();
            $doc->loadXML($xml_string);
            $hash = $doc->getElementsByTagName('DigestValue')->item(0)->nodeValue;
            $date = new DateTime();
            $_fecha = $date->format('Y-m-d');
            $resumen = '20000000001|01|'.$serie.'|'.$number.'|'.round($igv, 2).'|'.round($total, 2).'|'.$_fecha.'| 01 | 29781231232';

            $xml = $doc->getElementsByTagName('ID')->item(0)->nodeValue;
        
            // *****if (!is_dir(public_path().'/Sunat/Facturas')) {
            //     mkdir(public_path().'/Sunat/Facturas');
            // }

            // file_put_contents(public_path().'/Sunat/Facturas/'.$invoice->getName().'.xml', $see->getFactory()->getLastXml());
            
            
            // $config->writeXml($invoice, $see->getFactory()->getLastXml(), $empresa->Ruc, 1);

            $result = $see->send($invoice);
            // file_put_contents($invoice->getName().'.xml', $see->getFactory()->getLastXml());
            
            // Verificamos que la conexión con SUNAT fue exitosa.

            
            
            if (!$result->isSuccess()) {
                // Mostrar error al conectarse a SUNAT.
                $cdr = $result->getError()->getCode();
                $message = $result->getError()->getMessage();
                // echo 'Codigo Error: '.$result->getError()->getCode();
                // echo 'Mensaje Error: '.$result->getError()->getMessage();

                // return redirect()->route('venta.index')->with('error', $mensaje.' con Codigo '.$codigo);
                // exit();
                $response['message'] = $message;
                $response['cdr'] = $cdr;

                return $response;
                // exit();
            }

            // Guardamos el CDR
            // file_put_contents('R-'.$invoice->getName().'.zip', $result->getCdrZip());
    //*** **** file_put_contents(public_path().'/Sunat/Facturas/R-'.$invoice->getName().'.zip', $result->getCdrZip());

            $cdr = $result->getCdrResponse();
            $code = (int)$cdr->getCode();
            // dd("aqui");
            // dd($result, $invoice, $see, $hash, $resumen);
            if ($code === 0) {

                $message = 'ACEPTADA ';
                $alert='success';

                Log_Receipt::create([ 'user_id'=>1, 'customer_id'=>$attentionData->customer_id, 'document_code'=>$order, 'identifier'=>$xml, 'total'=>$total, 'hash'=>$hash, 'resume'=>$resumen, 'cdr'=>$code]);
                Temp_order::where('code', $order)->update(['status'=> 5]);
                
                // echo 'ESTADO: ACEPTADA'.PHP_EOL;
                // if (count($cdr->getNotes()) > 0) {
                //     echo 'OBSERVACIONES:'.PHP_EOL;
                //     // Corregir estas observaciones en siguientes emisiones.
                //     var_dump($cdr->getNotes());
                // }  
            } else if ($code >= 2000 && $code <= 3999) {
                $message = 'RECHAZADA ';
                $alert='danger';
                Log_Receipt::create([ 'user_id'=>1, 'customer_id'=>$attentionData->customer_id, 'document_code'=>$order, 'identifier'=>$xml, 'total'=>$total, 'hash'=>$hash, 'resume'=>$resumen, 'cdr'=>$code]);
            } else {
                /* Esto no debería darse, pero si ocurre, es un CDR inválido que debería tratarse como un error-excepción. */
                /*code: 0100 a 1999 */
                // echo 'Excepción';
                $message = 'Excepción ';
                $alert='info';
                Log_Receipt::create([ 'user_id'=>1, 'customer_id'=>$attentionData->customer_id, 'document_code'=>$order, 'identifier'=>$xml, 'total'=>$total, 'hash'=>$hash, 'resume'=>$resumen, 'cdr'=>$code]);
                Temp_order::where('code', $order)->update(['status'=> 5]);
            }

            $message .=''.$cdr->getDescription().PHP_EOL;
            Attention::where('id', $attentionData->id)->update(['hash'=>$hash, 'identifier'=>$xml, 'resume' => $resumen, 'cdr'=>$code, 'message'=>$message, 'dispatched'=>1, 'received'=>1, 'completed'=>1]);

            $response = [
                'success' => true,
                'alert' => 'success',
                'message' => $message,
                'cdr' => $code,
                'nameId' => $xml
            ];

            return $response; 
            // exit();
        
        } catch (\Throwable $th) {
            // dd(get_class_methods($th));
            Log::info("Line No : ".__LINE__." : File Path : ".__FILE__." message ".$th->getMessage()." linea : ".$th->getLine()." codigo :".$th->getCode());
            Log::error('Velocity CartController: ' . $th->getMessage(), ["hola"=>"hola"]);
            // dd("error en base ". $th->getMessage());//throw $th;
            
            $response['message'] = 'Hubo error al generar la factura : '.$th->getMessage();
            
            return $response;
            // exit();
        }

    }

    public function ticket($order){

        $response = [
            'success' => false,
            'alert' => 'danger',
            'message' => 'No se encontro ninguna orden ',
            'cdr' => null,
            'nameId' => ''
        ];

        if (!Attention::where('document_code', $order)->exists()) {
            
            return  $response;
        }

        try {
            $attentionData = Attention::where('document_code', $order)->orderBy('id', 'desc')->first();

            $serie = $this->formatSerie($attentionData->serie, $attentionData->sunat_code);
            $number = str_pad($attentionData->numeration, 8, "0", STR_PAD_LEFT);

            Attention::where('id', $attentionData->id)->update(['hash'=>'', 'identifier'=>$serie.'-'.$number, 'resume' => '', 'cdr'=>'', 'message'=>'Sin Valor Tribitario', 'dispatched'=>0, 'received'=>0, 'completed'=>1]);
            Temp_order::where('code', $order)->update(['status'=> 5]);

            $response['success'] = true;
            $response['alert'] = 'success';
            $response['message'] = 'Se genero corectamente el ticket';


            return $response;
        } catch (\Throwable $th) {
            // dd(get_class_methods($th));
            Log::info("Line No : ".__LINE__." : File Path : ".__FILE__." message ".$th->getMessage()." linea : ".$th->getLine()." codigo :".$th->getCode());
            Log::error('Velocity CartController: ' . $th->getMessage(), ["hola"=>"hola"]);
            // dd("error en base ". $th->getMessage());//throw $th;
            
            $response['message'] = 'Hubo error al generar el ticket';
            
            return $response;
        }
    }
}
