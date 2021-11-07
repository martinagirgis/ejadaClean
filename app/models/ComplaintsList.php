<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ComplaintsList extends Model
{
    protected $table = 'complaints_lists';
    protected $fillable = [
        'name',
        'facility_id',
        'type'
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id');
    }
}
