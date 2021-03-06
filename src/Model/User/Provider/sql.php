<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PeakUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		DB::statement('CREATE TABLE IF NOT EXISTS `9peak_user` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` tinyint(3) NOT NULL,
  `account` varchar(40) default NULL,
  `pwd` text,
  `name` varchar(30) DEFAULT NULL COMMENT \'姓名\',
  `photo` text COMMENT \'头像照片url\',
  `nickname` text COMMENT \'昵称\',
  `gender` tinyint(1) NOT NULL DEFAULT \'0\' COMMENT \'性别\',
  `birthday` date DEFAULT NULL COMMENT \'生日\',
  `group_id` int(10) UNSIGNED NOT NULL DEFAULT \'0\' COMMENT \'用户组\',
  `status` tinyint(1) NOT NULL DEFAULT \'0\' COMMENT \'状态\',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT \'创建时间\',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT \'更新时间\',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`,`type`) USING BTREE,
  KEY `type` (`type`),
  KEY `group_id` (`group_id`),
  KEY `status` (`status`),
  KEY `name` (`name`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;');


		DB::statement('CREATE TABLE IF NOT EXISTS `9peak_oauther` (
  `id` varchar(50) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(3) NOT NULL,
  UNIQUE KEY `id` (`id`,`type`),
  UNIQUE KEY `user_id` (`user_id`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT=\'授权用户\';');


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('9peak_user');
        Schema::dropIfExists('9peak_oauther');
    }
}
