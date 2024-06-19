<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceQrScanRecord extends Model
{
    use HasFactory;

    protected $fillable = ['service_id', 'ticket_id', 'status', 'date'];

    public function discountService()
    {
        return $this->belongsTo(DiscountService::class, 'service_id', 'id');
    }
}
