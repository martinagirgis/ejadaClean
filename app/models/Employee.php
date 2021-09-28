<?php

namespace App\models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use Notifiable;

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
        'supervisor_id'
    ]; 

    public function tasks()
    {
        return $this->hasMany(Task::class, 'employee_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class, 'supervisor_id');
    }
}
