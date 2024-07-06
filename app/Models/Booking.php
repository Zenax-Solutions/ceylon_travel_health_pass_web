<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'package_id',
        'customer_id',
        'agent_id',
        'adult_pass_count',
        'child_pass_count',
        'destination_list',
        'esim_list',
        'total',
        'date',
        'payment_status',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'destination_list' => 'array',
        'esim_list' => 'array',
        'date' => 'date',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id', 'id');
    }
}
