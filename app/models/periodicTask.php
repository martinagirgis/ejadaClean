<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class periodicTask extends Model
{
    protected $table = 'periodic_tasks';
    protected $fillable = [
        'title', 
        'description', 
        'date',
        'time',
        'period',
        'attach',
        'note',
        'facility_id', 
        'branch_id',
        'support_type',
        'support_id',
        'state'
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id');
    }

    public function company()
    {
        return $this->belongsTo(SponsorintCompany::class, 'support_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'support_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'support_id');
    }
}
