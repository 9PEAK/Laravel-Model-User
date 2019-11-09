<?php

namespace Peak\Model\User\Provider;

use Illuminate\Support\ServiceProvider;

class Migration extends ServiceProvider
{

	public function boot()
	{
		// 创建迁移
		$this->publishes(
			[
				__DIR__.'/sql.php' => database_path('migrations/2018_09_13_170327_peak_user.php'),
			],
			'migration'
		);
	}


	public function register ()
	{

	}





}