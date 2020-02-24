<?php

namespace App\Base\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{

	protected $table = 'user_profiles';

	protected $dates = [
		'created_at',
		'updated_at',
	];

	protected $fillable = [
		'user_id',
		'key',
		'value'
	];

}
