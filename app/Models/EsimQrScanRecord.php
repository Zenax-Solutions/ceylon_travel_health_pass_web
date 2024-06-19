<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EsimQrScanRecord extends Model
{
    use HasFactory;

    protected $fillable = ['esim_id', 'ticket_id', 'status', 'date'];


    public function esimService()
    {
        return $this->belongsTo(EsimService::class);
    }
}
