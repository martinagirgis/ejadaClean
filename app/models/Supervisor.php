<?php

namespace App\models;

use App\models\Employee;
use App\models\CleanMantananceManager;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Supervisor extends Authenticatable implements JWTSubject
{
    use Notifiable;
    
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

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
        'token'
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
