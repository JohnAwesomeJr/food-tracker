<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datapoint extends Model
{
    use HasFactory;

    public function tracker()
    {
        return $this->belongsTo('App\Models\Tracker', 'id', 'forenkey_tracker_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id', 'forenkey_user_id');
    }
}
