<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationQrScanRecord extends Model
{
    use HasFactory;

    protected $fillable = ['destination_id', 'ticket_id', 'status', 'date'];


    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id', 'id');
    }
}
