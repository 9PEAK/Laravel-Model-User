<?php

namespace Peak\Model\User;

use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider
{

	public function boot()
	{
		// 创建迁移
		$this->publishes(
			[
				__DIR__.'/publish/migration.php' => database_path('migrations/2018_09_13_170327_peak_user.php'),
			],
			'migration'
		);
	}


	public function register ()
	{

	}





}