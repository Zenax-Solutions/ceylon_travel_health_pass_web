<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiscountShop extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'agent_id',
        'shope_name',
        'image',
        'location',
        'area',
        'discount_amount',
        'status',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'discount_shops';

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
