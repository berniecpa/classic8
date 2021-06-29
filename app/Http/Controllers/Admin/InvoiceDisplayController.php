<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyInvoiceDisplayRequest;
use App\Http\Requests\StoreInvoiceDisplayRequest;
use App\Http\Requests\UpdateInvoiceDisplayRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InvoiceDisplayController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('invoice_display_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.invoiceDisplays.index');
    }

    public function create()
    {
        abort_if(Gate::denies('invoice_display_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.invoiceDisplays.create');
    }

    public function store(StoreInvoiceDisplayRequest $request)
    {
        $invoiceDisplay = InvoiceDisplay::create($request->all());

        return redirect()->route('admin.invoice-displays.index');
    }

    public function edit(InvoiceDisplay $invoiceDisplay)
    {
        abort_if(Gate::denies('invoice_display_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.invoiceDisplays.edit', compact('invoiceDisplay'));
    }

    public function update(UpdateInvoiceDisplayRequest $request, InvoiceDisplay $invoiceDisplay)
    {
        $invoiceDisplay->update($request->all());

        return redirect()->route('admin.invoice-displays.index');
    }

    public function show(InvoiceDisplay $invoiceDisplay)
    {
        abort_if(Gate::denies('invoice_display_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.invoiceDisplays.show', compact('invoiceDisplay'));
    }

    public function destroy(InvoiceDisplay $invoiceDisplay)
    {
        abort_if(Gate::denies('invoice_display_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoiceDisplay->delete();

        return back();
    }

    public function massDestroy(MassDestroyInvoiceDisplayRequest $request)
    {
        InvoiceDisplay::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
