<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class FacilityTimes extends Model
{
    protected $table = 'facility_times';
    protected $fillable = [
        'day', 
        'time',
        'period',
        'type',
        'employee_id',
        'facility_id'
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id');
    }
}
