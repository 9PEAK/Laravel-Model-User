<?php

namespace Peak\Model\User;

class Jwt extends Core implements \Tymon\JWTAuth\Contracts\JWTSubject
{

	use \Peak\Laravel\Eloquent\Model\Translater;

	public function getJWTIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Return a key value array, containing any custom claims to be added to the JWT.
	 *
	 * @return array
	 */
	public function getJWTCustomClaims()
	{
		return [];
	}

	/**
	 *  重定义密码字段
	 */
	public function getAuthPassword()
	{
		return $this->getAttribute('pwd');
	}

}