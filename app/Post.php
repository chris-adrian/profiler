<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	// protected  $guarded = [];
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
	    'title','image','description',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
	    // 'password', 'remember_token', 'type',
	];


	public function User() {
		return $this->belongsTo(User::class);
	}
}
