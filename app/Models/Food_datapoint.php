<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food_datapoint extends Model
{
    use HasFactory;

	public function food_tracker()
	{
		return $this->belongsTo('App\Models\Food_tracker');
	}
}
