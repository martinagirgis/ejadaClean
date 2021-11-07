<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $table = 'complaints';
    protected $fillable = [
        'title',
        'description',
        'attach',
        'type',
        'employee_id',
        'branch_id',
        'state'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
