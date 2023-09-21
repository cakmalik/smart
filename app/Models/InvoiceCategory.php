<?php

namespace App\Models;

use App\Models\InvoiceUtility;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bakid\InvoiceCategoryDiscount;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function utilities()
    {
        return $this->hasMany(InvoiceUtility::class);
    }

    public function discounts()
    {
        return $this->hasMany(InvoiceCategoryDiscount::class);
    }
}
