<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\NullToEmptyString;

class Messages extends Model
{
    // 
    // use NullToEmptyString;

	protected $guarded = [];
	protected $table = 'messages';
	protected $primaryKey = 'id';
	public $timestamps = true;

	protected $hidden = [
		
	];

	protected $casts = [
		'msg_status' => 'boolean'
	];

	protected $fillable = [
		'to',
		'from',
		'message',
		'msg_status',
		'created_at',
		'updated_at'
	];
}
