<?php

namespace Peak\Model\User;
/**
 * 开发者 仅限测试环境使用
 * */
class Developer extends Core
{

	const TYPE = 0;

	public function user ($cls)
	{
		return $this->hasOne($cls, 'id', 'name');
	}

}
