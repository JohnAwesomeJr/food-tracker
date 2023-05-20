<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food_tracker extends Model
{
    use HasFactory;

	public function food_datapoints()
	{
		return $this->hasMany('App\Models\Food_datapoint');
	}
}
