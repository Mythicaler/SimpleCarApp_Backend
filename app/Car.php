<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
	protected $primaryKey = 'id';
	
	protected $fillable = [
		'Make', 'Model', 'Color', 'Milage', 'Year', 'Type', 'Pricing', 'VIN_Number'
	];
}