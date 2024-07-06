<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['booking_id', 'ticket_id', 'is_adult', 'expiry_date','regionality', 'status'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'expiry_date' => 'date',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
