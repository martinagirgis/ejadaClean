<?php

namespace App\models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable implements JWTSubject
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

    protected $guard = 'employee';
    protected $table = 'employees';
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'real_password',
        'phone',
        'job_num',
        'id_num',
        'date',
        'type',
        'supervisor_id',
        'token'
    ]; 

    public function tasks()
    {
        return $this->hasMany(Task::class, 'employee_id');
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class, 'employee_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class, 'supervisor_id');
    }
}
