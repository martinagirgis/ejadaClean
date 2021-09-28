<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class SponsorintCompany extends Model
{
    protected $table = 'sponsorint_companies';
    protected $fillable = [
        'name', 
        'phone',
        'job_num',
        'id_num',
        'clean_mantanance_manager_id',
    ]; 

    public function cleanManager()
    {
        return $this->belongsTo(CleanMantananceManager::class, 'clean_mantanance_manager_id');
    }

    public function taskCompany()
    {
        return $this->hasMany(SponsorintCompany::class, 'support_id');
    }

    public function taskTeam()
    {
        return $this->hasMany(Team::class, 'support_id');
    }
}
