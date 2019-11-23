<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'color_hex',
        'color_rgb'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    use SoftDeletes;
}
