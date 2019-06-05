<?php

namespace App\Services;

use App\Customer;
use GuzzleHttp\Client;

class SmsGateway
{
    /**
     * Create a new Nexmo SmsGateway.
     *
     * @var  \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Nexmo API URL.
     *
     * @var  string
    */
    const API_URL = 'https://rest.nexmo.com/sms';

    /**
     * Country code.
     *
     * @var  string
    */
    const COUNTRY_CODE = '+234';

    /**
     * Create a new generator instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new Client([
          'base_uri' => self::API_URL,
          'headers' => [
              'content-type' => 'application/json',
              'cache-control' => 'no-cache'
          ]
      ]);
    }

    /**
     * Send payment link to customer's phone.
     *
     * @param  \App\Customer  $customer
     * @param  array  $data
     * @return void
     */
    public function sendTo(Customer $customer, $data)
    {
        $this->client->post(self::API_URL . '/json', [
          'form_params' => [
            'api_key' => config('services.nexmo.key'),
            'api_secret' => config('services.nexmo.secret'),
            'from'=> config('services.nexmo.sender'),
            'to' => $this->formatPhoneNumber($customer->phone),
            'text' => "Hello {$customer->name}, your invoice is ready, click to pay: {$data['payment_link']}"
          ]
        ]);
    }

    /**
     * Attempt to format the phone number according to E.164 rules.
     * 
     * @param  string  $phoneNumber
     * @return string
    */
    public function formatPhoneNumber($phoneNumber)
    {
      if (strpos($phoneNumber, self::COUNTRY_CODE) === false) {
        $phoneNumber = self::COUNTRY_CODE . $phoneNumber;
      }
      
      return preg_replace(sprintf("/(\%s)(0)(\d+)/", self::COUNTRY_CODE), '$1$3', $phoneNumber);
    }
}