<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CompanyPassword extends Model
{
    protected $table = 'company_passwords';
    protected $fillable = [
        'new_real_password',
        'new_password',
        'old_real_password',
        'old_password',
        'date',
        'company_id',
    ];
}
