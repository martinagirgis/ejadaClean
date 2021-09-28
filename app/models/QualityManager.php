<?php

namespace App\models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class QualityManager extends Authenticatable
{
    use Notifiable;

    protected $guard = 'quality_manager';
    protected $table = 'quality_managers';
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'real_password',
        'phone',
        'job_num',
        'id_num',
        'company_id',
    ];
}
