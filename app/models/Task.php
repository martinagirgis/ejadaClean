<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    protected $fillable = [
        'title', 
        'description', 
        'date',
        'time',
        'period',
        'attach',
        'note',
        // 'employee_id', 
        'branch_id',
        'support_type',
        'support_id',
        'state'
    ];

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
