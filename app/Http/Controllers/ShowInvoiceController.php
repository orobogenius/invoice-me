<?php

namespace App\Http\Controllers;

use App\Invoice;

class ShowInvoiceController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return view('invoice.show', compact('invoice'));
    }
}
