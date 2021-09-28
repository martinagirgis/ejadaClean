<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $table = 'team_members';
    protected $fillable = [
        'name',  
        'phone',
        'team_id',
    ];
}
