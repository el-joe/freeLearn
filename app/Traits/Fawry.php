<?php

namespace App\Traits;

class Fawry {

    private $liveMode,$merchantCode,$hashKey;

    function __construct()
    {
        $this->liveMode = $liveMode = false;
        if($liveMode){
            $this->merchantCode = '770000015904';
            $this->hashKey = '95aa9b63-185d-406b-a16e-3d2ebeb585da';
        }else{
            $this->merchantCode = '770000015904';
            $this->hashKey = '95aa9b63-185d-406b-a16e-3d2ebeb585da';
        }
    }

    function checkout($orderId,$amount,$customerData = [
        'name'=>'',
        'phone'=>'',
        'email'=>'',
        'id'=>''
    ]){
        $merchantCode    = $this->merchantCode;
        $merchantRefNum  = $orderId;
        $merchant_cust_prof_id  = $customerData['id'];
        $payment_method = 'PayAtFawry';
        $merchant_sec_key =  $this->hashKey; // For the sake of demonstration
        $signature = hash('sha256' , $merchantCode . $merchantRefNum . $merchant_cust_prof_id . $payment_method . $amount . $merchant_sec_key);
        $httpClient = new \GuzzleHttp\Client(); // guzzle 6.3
        $response = $httpClient->request('POST', 'https://atfawry.fawrystaging.com/ECommerceWeb/Fawry/payments/charge', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json'
            ],
            "http_errors" => false,
            'body' => json_encode(   [
                'merchantCode' => $merchantCode,
                'merchantRefNum' => $merchantRefNum,
                'customerName' => $customerData['name'],
                'customerMobile' => $customerData['phone'],
                'customerEmail' => $customerData['email'],
                'customerProfileId'=> $customerData['id'],
                'amount' => $amount,
                'paymentExpiry' => now()->getTimestampMs(),
                'currencyCode' => 'EGP',
                'language' => 'ar-eg',
                'chargeItems' => [
                                    [
                                      'itemId' => '1',
                                      'description' => 'Video Purchase',
                                      'price' => $amount,
                                      'quantity' => '1'
                                    ]
                                  ],
                'signature' => $signature,
                'paymentMethod' => $payment_method,
                'description' => 'Purchase Video',
            ] , true)
        ]);
        $response = json_decode($response->getBody()->getContents(), true);

        if($response['statusCode'] != 200){
            return NULL;
        }
        return $response;
    }

    function checkPayment($merchantRefNum) {
        $merchantCode    = $this->merchantCode;
        $merchantRefNumber  = $merchantRefNum;
        $merchant_sec_key =  $this->hashKey; // For the sake of demonstration
        $signature = hash('sha256' , $merchantCode . $merchantRefNumber . $merchant_sec_key);
        $httpClient = new \GuzzleHttp\Client(); // guzzle 6.3
        $response = $httpClient->request('GET', 'https://atfawry.fawrystaging.com/ECommerceWeb/Fawry/payments/status/v2', [
            'query' => [
                'merchantCode' => $merchantCode,
                'merchantRefNumber' => $merchantRefNumber,
                'signature' => $signature
            ],
            "http_errors" => false,
        ]);

        if($response->getStatusCode() != 200){
            return NULL;
        }

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }

}

