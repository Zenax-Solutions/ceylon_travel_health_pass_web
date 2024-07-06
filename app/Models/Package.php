<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'main_title',
        'second_title',
        'description',
        'gallery',
        'travel_info',
        'health_info',
        'days',
        'price',
        'child_price',
        'additional_per_adult_price',
        'additional_per_day_price',
        'discount_shop_list',
        'discount_service_list',
        'expire_days_count',
        'show_tour_agent_only',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'gallery' => 'array',
        'discount_shop_list' => 'array',
        'discount_service_list' => 'array',
        'child_price' => 'boolean',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
