<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use App\Models\Bakid\InvoiceCategoryDiscount;
use App\Http\Requests\StoreInvoiceCategoryDiscountRequest;
use App\Http\Requests\UpdateInvoiceCategoryDiscountRequest;
use App\Models\InvoiceCategory;

class InvoiceCategoryDiscountController extends Controller
{
    public function create($categoryId)
    {
        return view('invoice.categories-discount-create', compact('categoryId'));
    }

    public function store(StoreInvoiceCategoryDiscountRequest $request, $categoryId)
    {
        $inv_cat = InvoiceCategory::find((int)$categoryId);
        $discountType  = $request->discount_type ?? 'amount';

        $isExist = InvoiceCategoryDiscount::where('invoice_category_id', $categoryId)
            ->where('number_of_child', $request->number_of_child)
            ->first();

        if ($isExist) {
            Toast::danger('Discount for ' . $request->number_of_child . ' child already exist');
            return back()->withInput();
        }

        if ($discountType == 'percentage') {
            $request->validate([
                'discount_amount' => 'required|numeric|min:0|max:100',
            ]);
        } else {
            if ($request->discount_amount > $inv_cat->amount) {
                Toast::danger(__('Discount amount cannot be greater than invoice category amount'));
                return back()->withInput();
            }
        }

        try {
            InvoiceCategoryDiscount::create([
                'invoice_category_id' => $categoryId,
                'number_of_child' => $request->number_of_child,
                'discount_amount' => $request->discount_amount,
                'discount_type' => $discountType,
            ]);
        } catch (\Exception $e) {
            Toast::danger('Error : ' . $e->getMessage());
            return back()->withInput();
        }

        Toast::success(__('Discount added successfully'));
        return redirect()->route('invoice.category.show', ['category' => $categoryId, 'isEdit' => true]);
    }


    public function remove(InvoiceCategoryDiscount $discount)
    {
        $discount->delete();
        Toast::success(__('Discount removed successfully'));
        return back();
    }
}
