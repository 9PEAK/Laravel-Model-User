<?php

namespace Peak\Model\User\Jwt;

trait Jwt
{


	protected function regJwtAuth ($secret, $exp, $type)
	{
	    app()->singleton(
	        Auth::class,
            function () use (&$secret, &$exp, &$type) {
	            return new Auth ($secret, $exp, $type);
            }
        );
	}





}