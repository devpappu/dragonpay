<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Crazymeeks\Foundation\PaymentGateway\Dragonpay;
use Crazymeeks\Foundation\PaymentGateway\Dragonpay\Token;
use Crazymeeks\Foundation\PaymentGateway\Options\Processor;

class DragonpayController extends Controller
{
    public function meke_payment(){

        
    //   $bodyData = [
    //     'txnid' => 'TXNID6', # Varchar(40) A unique id identifying this specific transaction from the merchant site
    //     'amount' => 10, # Numeric(12,2) The amount to get from the end-user (XXXX.XX)
    //     'ccy' => 'PHP', # Char(3) The currency of the amount
    //     'description' => 'Test', # Varchar(128) A brief description of what the payment is for
    //     'email' => 'some@merchant.ph', # Varchar(40) email address of customer
    //     'param1' => 'param1', # Varchar(80) [OPTIONAL] value that will be posted back to the merchant url when completed
    //     'param2' => 'param2', # Varchar(80) [OPTIONAL] value that will be posted back to the merchant url when completed

    // ];

    $bodyData = '{"txnid":"TXNID6","amount":30,"ccy":"PHP","description":"tesr","email":"some@merchant.ph","param1":"tesr","param2":"some@merchant.ph"}';

    $client = new \GuzzleHttp\Client();

      $response = $client->request('POST', 'https://test.dragonpay.ph/api/collect/v1', [
        'body' => $bodyData,
        'headers' => [
          'Accept' => 'application/json',
          'Authorization' => 'Basic UEFLQkVUVFY6',
          'Content-Type' => 'application/json',
        ],
      ]);
      
      return $response();
    }



    public function payment(){

        
      $parameters = [
        'txnid' => 'TXNID', # Varchar(40) A unique id identifying this specific transaction from the merchant site
        'amount' => 1, # Numeric(12,2) The amount to get from the end-user (XXXX.XX)
        'ccy' => 'PHP', # Char(3) The currency of the amount
        'description' => 'Test', # Varchar(128) A brief description of what the payment is for
        'email' => 'some@merchant.ph', # Varchar(40) email address of customer
        'param1' => 'param1', # Varchar(80) [OPTIONAL] value that will be posted back to the merchant url when completed
        'param2' => 'param2', # Varchar(80) [OPTIONAL] value that will be posted back to the merchant url when completed

      ];

      $merchant_account = [
          'merchantid' => 'PAKBETTV',
          'password'   => 'ySSVh2nsjRvXjwv'
      ];

      $dragonpay = new Dragonpay($merchant_account);

       // Set parameters, then redirect to dragonpay
       $dragonpay->setParameters($parameters)
       ->withProcid(Processor::PAYPAL)
       ->away();

        // // Initialize Dragonpay
        // $dragonpay = new Dragonpay($merchant_account);
        // // Filter payment channel
        // $dragonpay->filterPaymentChannel( Dragonpay::GCASH );
        // // Set parameters, then redirect to dragonpay
        // $dragonpay->setParameters($parameters)->away();

    }
}
