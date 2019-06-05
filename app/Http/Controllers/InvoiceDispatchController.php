<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InvoiceDispatchController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Invoice $invoice)
    {
        $this->validate($request, [
            'channels' => [
                'array', 'required',
                Rule::in(Invoice::$channels)
            ]
        ]);

        $invoice->send($request->input('channels'));

        session()->flash('message', 'Invoice sent successfully');

        return redirect()->route('invoices.show', $invoice->id);
    }
}
