<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $customers = Customer::paginate();

        return view('admin.common.customer.index', compact('customers'))
            ->with('i', ($request->input('page', 1) - 1) * $customers->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $customer = new Customer();

        return view('admin.common.customer.create', compact('customer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request): RedirectResponse
    {
        $band = $this->validateDoc($request->tipo_doc, strlen($request->document));
        if(!$band){
            return redirect()->back()
            ->with('danger','formato de documento no valido .... verifique su tipo de documento elegido')
            ->withInput();
        }

        Customer::create($request->validated());

        return Redirect::route('customers.index')
            ->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $customer = Customer::find($id);

        return view('admin.common.customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $customer = Customer::find($id);

        return view('admin.common.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, Customer $customer): RedirectResponse
    {
        $band = $this->validateDoc($request->tipo_doc, strlen($request->document));
        if(!$band){
            return Redirect::route('customers.edit', ['customer' => $customer->id])->with('danger', 'Formato equivocado de documento.');
        }

        $customer->update($request->validated());

        return Redirect::route('customers.index')
            ->with('success', 'Customer updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Customer::find($id)->delete();

        return Redirect::route('customers.index')
            ->with('success', 'Customer deleted successfully');
    }

    protected function validateDoc($type, $length){
        $band = 0;
        switch($type){
            case "1" :
                    $band = $length == 8 ? 1 : 0;
                break;
            case "6" :
                    $band = $length == 11 ? 1 : 0;
                break;       
        }
        return $band;
    }
}
