<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        
        $stripe = new \Stripe\StripeClient("sk_test_51JqwPVSBqQ3Slb1tmQumTgPrm7i5XRdcpdWPs8vTPsqj6B93UjphxU3ZiTcizMXjRynxyGhXWfzwhFPunnB06isS00yKwMdOuj");
        
        if(isset($_POST['cno'])){
            $token = $stripe->tokens->create([
                'card' => [
                  'number' => $_POST['cno'],
                  'exp_month' => $_POST['emonth'], 
                  'exp_year' => $_POST['eyear'],
                  'cvc' => $_POST['cvv'],
                ],
              ]);
            $res = $stripe->paymentIntents->create([
                'amount' =>$_POST['boat'] * 100,
                'currency' => 'inr',
                'payment_method_types' => ['card'],
            ]);
            
            
            $re_con = $stripe->paymentIntents->confirm(
                $res->id,
                [
                'payment_method_data' => [
                    'type' => 'card',
                    'card' => [
                        'token' => $token
                        ]
                    ],
                'return_url' => 'http://localhost:4200/paymentSuccess/'
                ],
            );
            echo json_encode($re_con);
        }
        
    
    }

}
