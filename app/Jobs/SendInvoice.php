<?php

namespace App\Jobs;

use App\Invoice;
use App\Services\SmsGateway;
use Illuminate\Bus\Queueable;
use App\Services\PaymentLinkGenerator;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendInvoice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The invoice instance.
     *
     * @var  Invoice
     */
    protected $invoice;

    /**
     * Array of channels to send invoice to.
     *
     * @var  array
     */
    protected $channels;

    /**
     * Create a new job instance.
     *
     * @param  Invoice  $invoice
     * @param  array  $channels
     * @return void
     */
    public function __construct(Invoice $invoice, array $channels)
    {
        $this->invoice = $invoice;
        $this->channels = $channels;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $link = app(PaymentLinkGenerator::class)->link($this->invoice);

        if (! $link) {
            return;
        }

        foreach ($this->channels as $channel) {
            $this->{'sendTo'.ucfirst($channel)}(
            $this->invoice, $link
          );
        }
    }

    /**
     * Send invoice to customer's phone number.
     *
     * @param  \App\Invoice  $invoice
     * @param  string  $paymentLink
     * @return void
     */
    protected function sendToPhone(Invoice $invoice, $paymentLink)
    {
        $customer = $invoice->customer;

        app(SmsGateway::class)->sendTo($customer, [
          'invoice_number' => $invoice->number,
          'payment_link' => $paymentLink,
        ]);
    }
}
