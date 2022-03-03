<?php

namespace App\Http\Controllers\Api\Orders;

use Braintree\Gateway;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Orders\OrderRequest;


class OrderController extends Controller
{
    public function generate(Request $request, Gateway $gateway){

        $token = $gateway->clientToken()->generate();

        $data = [
            'token' => $token
        ];
        

        return response()->json($data,200);
        
    }

    public function makePayment(OrderRequest $request, Gateway $gateway){

        $result = $gateway->transaction()->sale([
            'amount'=>$request->amount,
            'paymentMethodNonce' => $request->token,
            'options' => [
                'submitForSettlement'=>true
            ]
        ]);

        if($result->success){

            $data=[
                'success'=>true,
                'message'=>'transazione eseguita con successo'
            ];
            return response()->json($data,200);
        }else{

            $data=[
                'success'=>false,
                'message'=>'transazione fallita'
            ];
            return response()->json($data,200);
        }
        return 'make payment';
    }
}
