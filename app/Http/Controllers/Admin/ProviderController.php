<?php

namespace App\Http\Controllers\Admin;

use App\Models\Provider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ProviderRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $providers = Provider::paginate();

        return view('admin.common.provider.index', compact('providers'))
            ->with('i', ($request->input('page', 1) - 1) * $providers->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $provider = new Provider();

        return view('admin.common.provider.create', compact('provider'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProviderRequest $request): RedirectResponse
    {
        Provider::create($request->validated() + ['ubigeo'=>'130101', 'status'=>1 ]);

        return Redirect::route('providers.index')
            ->with('success', 'Provider created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $provider = Provider::find($id);

        return view('admin.common.provider.show', compact('provider'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $provider = Provider::find($id);

        return view('admin.common.provider.edit', compact('provider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProviderRequest $request, Provider $provider): RedirectResponse
    {
        $provider->update($request->validated());

        return Redirect::route('providers.index')
            ->with('success', 'Provider updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Provider::find($id)->delete();

        return Redirect::route('providers.index')
            ->with('success', 'Provider deleted successfully');
    }
}
