<?php

namespace App\Models\Bakid;

use App\Models\InvoiceCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceCategoryDiscount extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(InvoiceCategory::class);
    }
}
