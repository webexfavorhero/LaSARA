<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConstructionCalendar extends Model
{
    protected $table = "cons_cals";

    protected $fillable = [
        'office_id',
        'company_id',
        'company_man_id',
        'main_date',
        'cell_id',
        'field_name',
        'char_color',
        'content',
        'back_color',
        'start_time',
        'order_amount',
        'created_at',
        'updated_at'
    ];
}
