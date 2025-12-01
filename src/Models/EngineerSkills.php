<?php

namespace Simplydigital\EngineerManagement\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class EngineerSkills extends Model
{
	
	protected $fillable = [
		'number',
		'engineer_id',
		'skill_id',
		'active',
	];

	public function setNumberAttribute($value)
	{
		$this->attributes['number'] = Config('engineer-management.ENGSKL_PREFIX') . time();
	}

	public function engineer(): BelongsTo
	{
		return $this->belongsTo(EngineerManagement::class, 'engineer_id');
	}



}

