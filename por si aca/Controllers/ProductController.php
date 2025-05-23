<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\Category;
use App\Models\Provider;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $products = Product::paginate();

        return view('product.index', compact('products'))
            ->with('i', ($request->input('page', 1) - 1) * $products->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $product = new Product();
        $categories = Category::where('status', 1)->pluck('name', 'id');
        $providers = Provider::where('status', 1)->pluck('name', 'id');
        // dd($categories, $providers);
        return view('product.create', compact('product', 'categories', 'providers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        Product::create($request->validated());

        return Redirect::route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $product = Product::find($id);

        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $product = Product::find($id);
        $categories = Category::where('status', 1)->pluck('name', 'id');
        $providers = Provider::where('status', 1)->pluck('name', 'id');

        return view('product.edit', compact('product', 'categories', 'providers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());

        return Redirect::route('products.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Product::find($id)->delete();
        // dd($id);
        // ::find($id)->update(['status', 0]);
        // Product::findOrFail($id)->update(['status'=>0]);

        return Redirect::route('products.index')
            ->with('success', 'Product deleted successfully');
    }

    public function listDelete(Request $request): View
    {
        $products = Product::onlyTrashed()->paginate();

        return view('product.restore', compact('products'))
            ->with('i', ($request->input('page', 1) - 1) * $products->perPage());
    }

    public function restore($id): RedirectResponse
    {
        // dd($id);
        $product = Product::onlyTrashed()->find($id);
        $product->restore();

        return Redirect::route('products.index')
            ->with('success', 'Product updated successfully');

    }

}
