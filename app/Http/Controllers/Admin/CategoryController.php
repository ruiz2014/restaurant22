<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $categories = Category::paginate();
        $deleted = Category::onlyTrashed()->value('id');

        return view('admin.common.category.index', compact('categories', 'deleted'))
            ->with('i', ($request->input('page', 1) - 1) * $categories->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $category = new Category();

        return view('admin.common.category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated() + ['status' => 1]);

        return Redirect::route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $category = Category::findOrFail($id);

        return view('admin.common.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $category = Category::findOrFail($id);

        return view('admin.common.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        
        $category->update($request->validated());

        return Redirect::route('categories.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Category::findOrFail($id)->delete();

        return Redirect::route('categories.index')
            ->with('success', 'Category deleted successfully');
    }

    public function listDelete(Request $request): View
    {
        $categories = Category::onlyTrashed()->paginate();

        return view('admin.common.category.restore', compact('categories'))
            ->with('i', ($request->input('page', 1) - 1) * $categories->perPage());
    }

    public function restore($id): RedirectResponse
    {
        // dd($id);
        $category = Category::onlyTrashed()->find($id);
        $category->restore();

        return Redirect::route('categories.index')
            ->with('success', 'Category updated successfully');

    }
}
