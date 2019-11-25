<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    protected $fillable = [
        'user_id',
        'company_id',
        'client',
        'requester',
        'agent_id',
        'time_trigger',
        'time_checkin',
        'time_exit',
        'note'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    use SoftDeletes;

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
