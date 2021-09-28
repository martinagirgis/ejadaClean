<?php

namespace App\models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CleanMantananceManager extends Authenticatable
{
    use Notifiable;

    protected $guard = 'clean_mantanance_manager';
    protected $table = 'clean_mantanance_managers';
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'real_password',
        'phone',
        'job_num',
        'id_num', 
        'branch_id',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function supervisor()
    {
        return $this->hasMany(Supervisor::class, 'clean_mantanance_manager_id');
    }
}
