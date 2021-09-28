<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branches';
    protected $fillable = [
        'name',  
        'company_id', 
    ];

    public function cleanManager()
    {
        return $this->hasMany(CleanMantananceManager::class, 'branch_id');
    }

    
}
