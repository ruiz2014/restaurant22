<?php

namespace App\Http\Controllers;

use App\Models\Biller\Voucher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\VoucherRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $vouchers = Voucher::paginate();

        return view('voucher.index', compact('vouchers'))
            ->with('i', ($request->input('page', 1) - 1) * $vouchers->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $voucher = new Voucher();

        return view('voucher.create', compact('voucher'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VoucherRequest $request): RedirectResponse
    {
        Voucher::create($request->validated() + ['user_id' => 1]);

        return Redirect::route('vouchers.index')
            ->with('success', 'Voucher created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $voucher = Voucher::find($id);

        return view('voucher.show', compact('voucher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $voucher = Voucher::find($id);

        return view('voucher.edit', compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VoucherRequest $request, Voucher $voucher): RedirectResponse
    {
        $voucher->update($request->validated());

        return Redirect::route('vouchers.index')
            ->with('success', 'Voucher updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Voucher::find($id)->delete();

        return Redirect::route('vouchers.index')
            ->with('success', 'Voucher deleted successfully');
    }
}
