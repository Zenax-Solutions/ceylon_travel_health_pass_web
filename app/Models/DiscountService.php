<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiscountService extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'agent_id',
        'service_name',
        'image',
        'location',
        'area',
        'discount_amount',
        'status',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'discount_services';

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function serviceQrScanRecord()
    {
        return $this->hasMany(ServiceQrScanRecord::class, 'service_id', 'id');
    }
}
