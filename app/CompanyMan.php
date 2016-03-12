<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyMan extends Model
{
    protected $table = 'company_mans';

    protected $fillable = [
        'office_id',
        'company_id',
        'huri_company_man_name',
        'company_man_name',
        'created_at',
        'updated_at'
    ];
}
