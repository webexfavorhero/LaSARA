<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'trans_items';

    protected $fillable = [
        'v_index',
        'huri_item_name',
        'item_name',
        'mark_color',
        'other_cond',
        'created_at',
        'updated_at'
    ];
}
