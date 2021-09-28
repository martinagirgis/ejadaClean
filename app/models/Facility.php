<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $table = 'facilities';
    protected $fillable = [
        'name', 
        'branch_id', 
    ];

    public function times()
    {
        return $this->hasMany(FacilityTimes::class, 'facility_id');
    }
}
