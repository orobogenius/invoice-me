<?php

namespace App\Services;

use App\Invoice;
use GuzzleHttp\Client;

class PaymentLinkGenerator
{
    /**
     * Create a new job instance.
     *
     * @var  \GuzzleHttp\Client
     */
     protected $client;

     /**
     * Ravepay API URL.
     *
     * @var  string
     */
     const API_URL = 'https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay';

    /**
     * Create a new generator instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new Client([        
          'headers' => [
              'content-type' => 'application/json',
              'cache-control' => 'no-cache'
          ]
      ]);
    }

    /**
     * Generate an invoice payment link for customer.
     *
     * @param  \App\Invoice  $invoice
     * @return string
     */
    public function link(Invoice $invoice)
    {
      $response = $this->client->post(self::API_URL, [
        'form_params' => [
          'amount' => $invoice->amount,
          'currency' => 'NGN',
          'customer_email'=> $invoice->customer->email ?? $invoice->user->email,
          'txref' => $invoice->reference,
          'PBFPubKey' => config('services.ravepay.pk'),
          'redirect_url' => route('invoices.view', $invoice->number),
          'custom_title' => "Pay invoice ({$invoice->number}) for "  . config('app.name'),
          'meta' => [
            ['metaname' => 'invoice_number', 'metavalue' => $invoice->number],
            ['metaname' => 'invoice_reference', 'metavalue' => $invoice->reference],
            ['metaname' => 'customer', 'metavalue' => $invoice->customer->id]
          ]
        ]
      ]);

      $transaction = json_decode($response->getBody(), true);

      return $transaction['data']['link'];
    }
}