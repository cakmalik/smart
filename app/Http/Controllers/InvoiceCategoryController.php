<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvoiceCategory;
use App\Tables\InvoiceCategories;
use ProtoneMedia\Splade\Facades\Toast;
use App\Models\Bakid\InvoiceCategoryDiscount;
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
            $route_back = 'invoice.categories';
            return view('invoice.edit-category', compact('category','route_back'));
        }
        return view('invoice.show-category', compact('category'));
    }

    public function update(UpdateInvoiceCategoryRequest $request, InvoiceCategory $category)
    {
        $category->update($request->validated());
        Toast::success('Category updated successfully');
    }

    public function edit(InvoiceCategory $category)
    {
        $category->load('discounts');
        $route_back = 'admission.settings';
        return view('invoice.edit-category', compact('category','route_back'));
    }
}