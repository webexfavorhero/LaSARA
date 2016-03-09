<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $table = 'offices';

    protected $fillable = [
        'v_index',
        'huri_office_name',
        'office_name',
        'created_at',
        'updated_at'
    ];
}
