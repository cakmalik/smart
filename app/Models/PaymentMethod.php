<?php

namespace App\Models;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public static function getIdByCode($code)
    {
        return self::where('code', $code)->value('id');
    }

    public static function getCodeById($id)
    {
        return self::where('id', $id)->value('code');
    }
}
