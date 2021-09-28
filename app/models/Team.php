<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'teams';
    protected $fillable = [
        'name', 
        'leader_name',
        'leader_phone',
        'clean_mantanance_manager_id',
    ]; 

    public function members()
    {
        return $this->hasMany(TeamMember::class, 'team_id');
    }
}
