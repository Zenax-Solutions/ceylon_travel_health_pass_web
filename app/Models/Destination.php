<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Destination extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'city_id',
        'destination',
        'image',
        'location',
        'south_asian_price',
        'non_south_asian_price',
        'child_south_asian_price',
        'child_non_south_asian_price',
        'discount_price',
        'status',
    ];

    protected $searchableFields = ['*'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
