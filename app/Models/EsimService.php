<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EsimService extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'agent_id',
        'service_name',
        'image',
        'per_sim_price',
        'status',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'esim_services';

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function esimQrScanRecord()
    {
        return $this->hasMany(EsimQrScanRecord::class);
    }
}
