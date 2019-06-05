<?php

namespace Tests\Feature;

use App\Invoice;
use App\Customer;
use Tests\TestCase;
use App\InvoiceItem;
use App\Jobs\SendInvoice;
use Illuminate\Support\Facades\Queue;
use App\Services\PaymentLinkGenerator;

class InvoiceTest extends TestCase
{
    /** @test */
    public function it_can_create_invoice()
    {
        $customer = factory(Customer::class)->create();

        $data = [
        'customer_id' => $customer->id,
        'amount' => $this->faker->randomNumber(),
        'description' => $this->faker->sentence(),
        'line_items' => factory(InvoiceItem::class, 2)->make()->toArray(),
        'channels' => ['phone'],
      ];

        $this->mockPaymentLinkGeneratorForInvoice();

        $this->actingAs($this->user)
            ->post(route('invoices.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('invoices.index'))
            ->assertSessionHas('message', 'Invoice created successfully');

        $this->assertDatabaseHas('invoices', [
          'user_id' => $this->user->id,
          'description' => $data['description'],
          'customer_id' => $customer->id,
      ]);
    }

    /** @test */
    public function it_can_send_invoice()
    {
        $invoice = factory(Invoice::class)->create();

        $customer = factory(Customer::class)->create();

        $invoice->customer()->associate($customer);

        $data = [
          'channels' => ['phone'],
        ];

        Queue::fake();

        $this->mockPaymentLinkGeneratorForInvoice($invoice);

        $this->actingAs($this->user)
              ->post(route('invoices.send', $invoice->id), $data)
              ->assertStatus(302)
              ->assertRedirect(route('invoices.show', $invoice->id))
              ->assertSessionHas('message', 'Invoice sent successfully');

        Queue::assertNotPushed(SendInvoice::class);
    }

    protected function mockPaymentLinkGeneratorForInvoice($invoice = null)
    {
        $this->mock(PaymentLinkGenerator::class, function ($mock) use ($invoice) {
            $mock->shouldReceive('link')->once()->andReturn($this->faker->url);
        });
    }
}
