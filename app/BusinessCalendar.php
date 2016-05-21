<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessCalendar extends Model
{
    protected $table = "busi_cals";

    protected $fillable = [
        'main_date',
        'office_id',
        'office_man_id',
        'cell_id',
        'address',
        'field_name',
        'trans_item_id',
        'time',
        'order_check',
        'edit_status',
        'edit_user',
        'created_at',
        'updated_at'
    ];
}
