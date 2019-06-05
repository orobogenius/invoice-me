<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;

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
