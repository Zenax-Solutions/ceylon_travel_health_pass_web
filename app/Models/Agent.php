<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agent extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'type',
        'name',
        'profile_image',
        'email',
        'password',
        'contact_no',
        'id_no',
        'license_no',
        'bank_details',
        'points',
        'commission',
        'commission_payment_status',
        'commission_payment_date',
        'recent_commission_payment_date',
        'recent_info',
        'coupon_code',
        'status',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'commission_payment_date' => 'date',
        'recent_commission_payment_date' => 'date',
    ];

    public function discountShops()
    {
        return $this->hasMany(DiscountShop::class);
    }

    public function discountServices()
    {
        return $this->hasMany(DiscountService::class);
    }

    public function esimServices()
    {
        return $this->hasMany(EsimService::class);
    }
}
