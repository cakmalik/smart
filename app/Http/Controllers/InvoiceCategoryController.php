<?php

namespace App\Http\Controllers;

use App\Models\InvoiceCategory;
use App\Tables\InvoiceCategories;
use App\Http\Requests\StoreInvoiceCategoryRequest;
use App\Http\Requests\UpdateInvoiceCategoryRequest;

class InvoiceCategoryController extends Controller
{

    public function index()
    {
        return view('invoice.categories', [
            'categories' => InvoiceCategories::class,
        ]);
    }

    public function show(InvoiceCategory $category, $isEdit = false)
    {
        $category->load('discounts');
        if ($isEdit) {
            return view('invoice.edit-category', compact('category'));
        }
        return view('invoice.show-category', compact('category'));
    }

    public function update(UpdateInvoiceCategoryRequest $request, InvoiceCategory $category)
    {
        $category->update($request->validated());
        return redirect()->route('invoice.categories');
    }
}
