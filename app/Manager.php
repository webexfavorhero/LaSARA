<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $table = 'manager';

    protected $fillable = [
        'username',
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];
}
