<?php

namespace App;

use App\Jobs\SendInvoice;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The supported channels to send invoices through.
     *
     * @var array
     */
    public static $channels = [
        'phone', 'whatsapp', 'email',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'customer', 'items',
    ];

    /**
     * Get the line items of the invoice.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    /**
     * Get the customer who owns this invoice.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Send invoice to customer.
     *
     * @param  array  $channels
     * @return void
     */
    public function send(array $channels)
    {
        SendInvoice::dispatchNow($this, $channels);
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value)
    {
        return $this->where('id', $value)->orWhere('number', $value)->first() ?? abort(404);
    }
}
