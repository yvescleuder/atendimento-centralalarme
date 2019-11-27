<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Welcome extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'message',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
