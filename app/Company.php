<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'office_id',
        'huri_company_name',
        'company_name',
        'created_at',
        'updated_at'
    ];
}
