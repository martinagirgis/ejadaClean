<?php

namespace App\models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CompanyGeneralManager extends Authenticatable
{
    use Notifiable;

    protected $guard = 'company_general_manager';
    protected $table = 'company_general_managers';
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'real_password',
        'phone',
        'job_num',
        'id_num',
        'commercial_register',
    ];

    public function passwordCompany()
    {
        return $this->hasMany(CompanyPassword::class, 'company_id');
    }
}
