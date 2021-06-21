<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyInvoiceTemplateRequest;
use App\Http\Requests\StoreInvoiceTemplateRequest;
use App\Http\Requests\UpdateInvoiceTemplateRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InvoiceTemplateController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('invoice_template_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.invoiceTemplates.index');
    }

    public function create()
    {
        abort_if(Gate::denies('invoice_template_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.invoiceTemplates.create');
    }

    public function store(StoreInvoiceTemplateRequest $request)
    {
        $invoiceTemplate = InvoiceTemplate::create($request->all());

        return redirect()->route('admin.invoice-templates.index');
    }

    public function edit(InvoiceTemplate $invoiceTemplate)
    {
        abort_if(Gate::denies('invoice_template_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.invoiceTemplates.edit', compact('invoiceTemplate'));
    }

    public function update(UpdateInvoiceTemplateRequest $request, InvoiceTemplate $invoiceTemplate)
    {
        $invoiceTemplate->update($request->all());

        return redirect()->route('admin.invoice-templates.index');
    }

    public function show(InvoiceTemplate $invoiceTemplate)
    {
        abort_if(Gate::denies('invoice_template_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.invoiceTemplates.show', compact('invoiceTemplate'));
    }

    public function destroy(InvoiceTemplate $invoiceTemplate)
    {
        abort_if(Gate::denies('invoice_template_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoiceTemplate->delete();

        return back();
    }

    public function massDestroy(MassDestroyInvoiceTemplateRequest $request)
    {
        InvoiceTemplate::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
