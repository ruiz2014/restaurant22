<?php

namespace App\Http\Controllers\Biller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Biller\Attention;
use App\Models\Biller\Summary as Summ;
use App\Models\Biller\Log_Receipt;
use DB;

use Greenter\Model\Response\SummaryResult;
use Greenter\Model\Sale\Document;
use Greenter\Model\Summary\Summary;
use Greenter\Model\Summary\SummaryDetail;
use Greenter\Model\Summary\SummaryPerception;
use Greenter\Ws\Services\SunatEndpoints;

use App\Traits\BillingConfigurationTrait;
use App\Traits\BillingToolsTrait;

use DateTime;
use DOMDocument;

ini_set('default_socket_timeout', 12600);
class SummaryController extends Controller
{
    use BillingConfigurationTrait, BillingToolsTrait;
    //
    public function index(Request $request){
         //
        // $request->session()->forget('empleado');
        // $documentos=[];

        // if($fecha!=null){
        //     $documentos = Attention::where('document_type', 3)->where(DB::raw("CAST(created_at as date)"), $fecha)->get();
        //     // dd('paso');
        // }
        $search = $request->search;
        $select = ['id', 'date_created', 'date_sent', 'identifier', 'hash', 'message', 'cdr'];
        $summaries = Summ::select($select)
                        ->Where(function($query) use ($select, $search) {
                            foreach($select as $col){
                                $query->orWhere($col,'LIKE',"%$search%");
                            }
                        })->paginate();
        // dd($summaries);
        return view('admin.biller.summary.index', compact('summaries', 'search'))
                    ->with('i', ($request->input('page', 1) - 1) * $summaries->perPage());
    }

    public function search(Request $request){
        // "hi";
        
        $document = Attention::select('identifier', DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y') as date"), 'total')->where('sunat_code', '03')->where(DB::raw("CAST(created_at as date)"), $request->date)->get();
        $qt = $document->count();
        return response()->json(['ok' => $qt, 'document'=>$document]);

    }

    public function summary(Request $request){

        $documents = Attention::select('attentions.id', 'attentions.document_code', 'attentions.total', 'attentions.identifier', 'cu.tipo_doc', 'cu.document')
                    ->join('customers as cu', 'cu.id', '=', 'attentions.customer_id')
                    ->where('attentions.sunat_code', '03')->where(DB::raw("CAST(attentions.created_at as date)"), $request->date_form)->get();
                    // ->where('attentions.sunat_code', '03')->where(DB::raw("CAST(attentions.created_at as date)"), '2025-04-12')->get();


        if($documents->isEmpty()){
            return redirect()->route('pay.index')->with('danger', 'no hay registros a mostrar...'); 
        }  
        
        // dd($document);

        $correlative = $this->getCorrelative();
        $summary = $this->setSummary($request->date_form, $correlative, $documents);

        $see = $this->config();

        $xml_string = $see->getXmlSigned($summary);
        $doc = new DOMDocument();
        $doc->loadXML($xml_string);
        $hash = $doc->getElementsByTagName('DigestValue')->item(0)->nodeValue;
        $xml = $doc->getElementsByTagName('ID')->item(0)->nodeValue;
        // $date = new DateTime();

        $result = $see->send($summary);
        // dd($result, $xml, $summary, $see, $hash);

        if (!$result->isSuccess()) {
            // Mostrar error al conectarse a SUNAT.
            // $cdr = $result->getError()->getCode();
            // $message = $result->getError()->getMessage();

            // $response['message'] = $message;
            // $response['cdr'] = $cdr;

            // return $response;

            $resp = $result->getError();
            dd($resp);

        }
        // sleep(5);
        $ticket = $result->getTicket();
        // dd($ticket);
        usleep(100000);
        $result = $see->getStatus($ticket);
        // dd($result, $ticket);
        if (!$result->isSuccess()) {

            $resp = $result->getError();
            // dd($resp->getCode());
            // dd($resp->getMessage());
            dd($resp);
            // echo $util->getErrorResponse($res->getError());
            // return;
        }

        $cdr = $result->getCdrResponse();
        // sleep(2);
        // dd($cdr);
        $code = (int)$cdr->getCode();
        if ($code === 0) {

            $message = 'ACEPTADA';
            $alert='success';
            foreach($documents as $doc){
                Log_Receipt::create(['user_id'=>1, 'customer_id'=>0, 'document_code'=>$doc->document_code, 'identifier'=>$doc->identifier, 'total'=>0, 'hash'=>'', 'type_receipt'=>1, 'resume'=>'summary', 'ticket'=>$ticket, 'cdr'=>$code]); 
                Attention::where('id', $doc->id)->update(['cdr'=>$code, 'status'=>'RESUMEN '.$message, 'success'=>1, 'message'=>$message, 'dispatched'=>1, 'received'=>1, 'completed'=>1]);
            }
        } else if ($code >= 2000 && $code <= 3999) {
            $message = 'RECHAZADA ';
            $alert='danger';
            //Log_Receipt::create([ 'user_id'=>1, 'customer_id'=>0, 'document_code'=>'', 'identifier'=>$xml, 'total'=>0, 'hash'=>$hash, 'resume'=>'summary', 'cdr'=>$code]);
        } else {
            $message = 'Excepción ';
            $alert='info';
            //Log_Receipt::create([ 'user_id'=>1, 'customer_id'=>0, 'document_code'=>'', 'identifier'=>$xml, 'total'=>0, 'hash'=>$hash, 'resume'=>'summary', 'cdr'=>$code]);

        }

        $status = $message;
        $message .=' '.$cdr->getDescription().PHP_EOL;
        //Summ::create(['hash'=>$hash, 'identifier'=>$xml, 'resume' => $resumen, 'cdr'=>$code, 'status'=>$status, 'message'=>$message, 'dispatched'=>1, 'received'=>1, 'completed'=>1]);

        Summ::create([
            'sunat_code'=>'RC',
            'hash'=>$hash,
            'date_created'=>$request->date_form,
            'date_sent'=>date('Y-m-d'),
            'identifier'=>$xml,
            'ticket'=>$ticket,
            'cdr'=> $code,
            'message'=>$message,
            'dispatched'=>1,
            'received'=>1,
            'status'=> 1,
        ]);

        return redirect()->route('summary.index')->with($alert, $message); 
    }

    public function setSummary($date, $correlative, $tickets){
        $sum = new Summary();

        $sum->setFecGeneracion(new DateTime($date))
            ->setFecResumen(new DateTime())//'-1days' ENTENDER ESTA PARTE DE LAS FECHAS ... OJOOOOOO
            ->setCorrelativo($correlative)
            ->setCompany($this->companyData())
            ->setDetails($this->setSummaryDetails($tickets));

        return $sum;

        // Envio a SUNAT.
        // $see = $util->getSee(SunatEndpoints::FE_BETA);

        // $res = $see->send($sum);
        // $util->writeXml($sum, $see->getFactory()->getLastXml());


        /**@var $res SummaryResult*/
        // $ticket = $res->getTicket();
        // echo 'Ticket :<strong>' . $ticket .'</strong>';

        $res = $see->getStatus($ticket);
        if (!$res->isSuccess()) {
            echo $util->getErrorResponse($res->getError());
            return;
        }

        $cdr = $res->getCdrResponse();
        $util->writeCdr($sum, $res->getCdrZip());

        $util->showResponse($sum, $cdr);

    }

    public function setSummaryDetails($tickets){
 
        $array = [];

        foreach($tickets as $ticket)
        {
            // $variableDoc = str_pad($ticket->numeration, 11, "0", STR_PAD_LEFT);
            // $serie = 'B'.substr($variableDoc, 0, 3);
            // $numero = substr($variableDoc, -8);
            $status = $ticket->low == 0 ? '1' : '3';

            $detail = new SummaryDetail();
                $detail->setTipoDoc('03')
                ->setSerieNro($ticket->identifier)
                ->setEstado($status)
                ->setClienteTipo($ticket->tipo_doc) // $ticket->document_type aqui se debe arreglar a tipo de documento del cliente
                ->setClienteNro($ticket->document)
                ->setTotal($ticket->total)
                ->setMtoOperGravadas(number_format($ticket->total/1.18, 2,'.', ''))
                ->setMtoOperInafectas(0.00)
                ->setMtoOperExoneradas(0.00)
                ->setMtoOtrosCargos(0.00)
                ->setMtoIGV(number_format($ticket->total - ($ticket->total/1.18), 2,'.', ''));
                
                array_push($array, $detail);
            //array_push($denegado, $boleta->id_boleta); //para actualizar las boletas a estado "Resumen aceptado"
            // $denegado[$boleta->id_boleta] = $estado;
            //array_push($baja, $estado); //para actualizar las boletas a estado "Resumen aceptado"
        }

        return $array;
    }

    protected function getCorrelative(){
        $number = Summ::orderBy('id', 'Desc')->first();

        if($number)
        {
        	$correlative=(int)$number->id;
        	$correlative=str_pad($correlative+1 , 5, "0", STR_PAD_LEFT);

            return $correlative;
        }

        return $correlative = '00001';
    }
}