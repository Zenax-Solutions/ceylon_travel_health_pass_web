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
        'branch_number',
        'image',
        'location',
        'south_asian_price',
        'non_south_asian_price',
        'child_south_asian_price',
        'child_non_south_asian_price',
        'discount_price',
        'stock_count',
        'current_stock_count',
        'is_wildlife',
        'discount_info',
        'status',
    ];

    protected $searchableFields = ['*'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function destinationQrScanRecord()
    {
        return $this->hasMany(DestinationQrScanRecord::class, 'destination_id', 'id');
    }

    public function destinationStock()
    {
        return $this->hasMany(DestinationTicketStockHistory::class, 'destination_id', 'id');
    }
}
