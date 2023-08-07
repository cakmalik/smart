<?php

namespace App\Models;

use App\Models\InvoiceDetail;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->invoice_number = self::generateInvoiceNumber();
        });
    }
    public static function generateInvoiceNumber()
    {
        $id = IdGenerator::generate(['table' => 'invoices', 'length' => 10, 'prefix' => 'INV-', 'field' => 'invoice_number']);
        return $id;
    }

    public function method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function invoiceCategory()
    {
        return $this->belongsTo(InvoiceCategory::class, 'invoice_category_id');
    }

    public function invoiceDetails()
    {
        return $this->hasMany(InvoiceDetail::class);
    }

    function file()
    {
        return $this->hasOne(InvoicePaymentFile::class, 'invoice_id');
    }
}
