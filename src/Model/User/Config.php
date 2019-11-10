<?php

namespace Peak\Model\User;

const USER_TB = '9peak_user';
const OAUTHER_TB = '9peak_oauther';
const MODEL_TIMESTAMPS = false;
const MODEL_FILLABLE = [
    'account' => 'account',
    'pwd' => 'pwd',
    'name' => 'name',
    'photo' => 'photo',
    'intro' => 'intro',
    'top' => 'top',
    'status' => 'status',
];
const MODEL_HIDDEN = [
    'pwd',
    'type',
];

trait Config
{


	protected static function boot()
	{
		parent::boot();

		static::saving(function($model) {
			$model->type = static::TYPE;
		});
	}

}
