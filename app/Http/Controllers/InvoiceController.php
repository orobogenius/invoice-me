<?php

namespace App\Http\Controllers;

use Auth;
use App\Invoice;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StroreInvoiceRequest;

class InvoiceController extends Controller
{
    /**
     * Show the invoices page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $invoices = Auth::user()->invoices;

        return view('invoice.index', compact('invoices'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return view('invoice.show', $invoice);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Auth::user()->customers;

        return view('invoice.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StroreInvoiceRequest $request)
    {
        $invoice = DB::transaction(function () use ($request) {
            $amount = collect($request->input('line_items'))->sum(function ($item) {
                return $item['quantity'] * $item['unit_price'];
            });

            $invoice = Auth::user()->invoices()->create([
                'amount' => $amount,
                'number' => $request->input('invoice_number') ?: Str::random(10),
                'reference' => $request->input('reference') ?: Str::random(10),
                'customer_id' => $request->input('customer_id'),
                'description' => $request->input('description'),
                'due_date' => $request->input('due_date'),
            ]);

            $invoice->items()->createMany($request->input('line_items'));

            return $invoice;
        });

        if (! $invoice) {
            return response()->json([
                'message' => 'Could not create invoice, please try again',
            ], 500);
        }

        if ($request->has('send')) {
            $invoice->send($request->input('channels'));
        }

        session()->flash('message', 'Invoice created successfully');

        return redirect()->route('invoices.index');
    }
}
