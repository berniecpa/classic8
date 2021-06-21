<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyConnectedAppRequest;
use App\Http\Requests\StoreConnectedAppRequest;
use App\Http\Requests\UpdateConnectedAppRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConnectedAppsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('connected_app_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.connectedApps.index');
    }

    public function create()
    {
        abort_if(Gate::denies('connected_app_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.connectedApps.create');
    }

    public function store(StoreConnectedAppRequest $request)
    {
        $connectedApp = ConnectedApp::create($request->all());

        return redirect()->route('admin.connected-apps.index');
    }

    public function edit(ConnectedApp $connectedApp)
    {
        abort_if(Gate::denies('connected_app_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.connectedApps.edit', compact('connectedApp'));
    }

    public function update(UpdateConnectedAppRequest $request, ConnectedApp $connectedApp)
    {
        $connectedApp->update($request->all());

        return redirect()->route('admin.connected-apps.index');
    }

    public function show(ConnectedApp $connectedApp)
    {
        abort_if(Gate::denies('connected_app_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.connectedApps.show', compact('connectedApp'));
    }

    public function destroy(ConnectedApp $connectedApp)
    {
        abort_if(Gate::denies('connected_app_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $connectedApp->delete();

        return back();
    }

    public function massDestroy(MassDestroyConnectedAppRequest $request)
    {
        ConnectedApp::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
