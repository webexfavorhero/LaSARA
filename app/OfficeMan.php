<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfficeMan extends Model
{
    protected $table = 'office_mans';

    protected $fillable = [
        'office_id',
        'code',
        'huri_office_man_name',
        'office_man_name',
        'v_index',
        'v_status'
    ];
}
