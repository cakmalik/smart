<?php

namespace App\Models;

use App\Models\InvoiceUtility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function utilities()
    {
        return $this->hasMany(InvoiceUtility::class);
    }
}
