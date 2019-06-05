<?php

namespace App\Http\Controllers;

use App\Invoice;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ProcessInvoiceController extends Controller
{
    /**
     * Process Invite.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $signature = $request->server('HTTP_VERIF_HASH');

        if (! $signature) {
            return;
        }

        if ($signature !== config('app.key')) {
            return;
        }

        if ($request->input('status') != 'successful') {
            return;
        }

        $data = $this->verifyPayment($request->input('txRef'));

        $invoiceMeta = collect($data['meta'])->firstWhere('metaname', 'invoice_number');

        if (! $data || ! $invoiceMeta) {
            return;
        }

        $invoice = Invoice::whereNumber($invoiceMeta['metavalue'])->first();

        if ($invoice && $invoice->status !== 'paid') {
            $invoice->status = 'paid';
            $invoice->save();

            // Once payment has been successfully verify, we will now give
            // payment to the merchant by sending the received monies into
            // their bank account.
        }
    }

    /**
     * Verify rave payment.
     *
     * @param  string  $ref
     * @return array|null
     */
    protected function verifyPayment(string $ref)
    {
        $client = new Client([
            'headers' => [
                'content-type' => 'application/json',
                'cache-control' => 'no-cache',
            ],
        ]);

        $response = $client->post('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify', [
            'form_params' => [
                'SECKEY' => config('services.ravepay.secret'),
                'txref' => $ref,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        $chargeCode = $data['data']['chargecode'];

        return $chargeCode == '00' || $chargeCode == '0' ? $data['data'] : null;
    }
}
