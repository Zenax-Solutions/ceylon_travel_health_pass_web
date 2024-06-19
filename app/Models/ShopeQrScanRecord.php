<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopeQrScanRecord extends Model
{
    use HasFactory;

    protected $fillable = ['shop_id', 'ticket_id', 'status', 'date'];


    public function discountShop()
    {
        return $this->belongsTo(DiscountShop::class, 'shop_id', 'id');
    }
}
