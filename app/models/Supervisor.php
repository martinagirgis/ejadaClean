<?php

namespace App\models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Supervisor extends Authenticatable
{
    use Notifiable;

    protected $guard = 'supervisor';
    protected $table = 'supervisors';
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'real_password',
        'phone',
        'job_num',
        'id_num',
        'area',
        'clean_mantanance_manager_id',
    ];

    public function cleanManager()
    {
        return $this->belongsTo(CleanMantananceManager::class, 'clean_mantanance_manager_id');
    }

    public function employee()
    {
        return $this->hasMany(Employee::class, 'supervisor_id');
    }
}
