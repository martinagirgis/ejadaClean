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
        'employee_id',
        'facility_id',
        'state'
    ];
}
