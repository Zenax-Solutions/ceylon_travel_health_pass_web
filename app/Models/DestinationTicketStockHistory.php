<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationTicketStockHistory extends Model
{
    use HasFactory;

    protected $fillable = ['destination_id', 'ticket_stock_count', 'selling_ticket_count','over_selling', 'date'];


    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id', 'id');
    }
}
