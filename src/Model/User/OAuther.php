<?php

namespace Peak\Model\User;

class OAuther extends \Illuminate\Database\Eloquent\Model
{

	protected $table = '9peak_oauther';

	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'id' => 'id',
		'user_id' => 'user_id',
		'type' => 'type',
	];

	protected $casts = [
		'type' => 'int'
	];

	protected $hidden = [
		'type'
	];


	use \Peak\Plugin\Debuger;

	protected static $types = [
		'token',
		'wechat',
	];


	/**
	 * 编译字符类型的type
	 * */
	static function encodeType ($type)
	{
		$type = is_int($type) ? $type : array_search($type, self::$types);
		return $type===false ? false : $type;
	}

	### 作用域查询

	public function scopeWhereType ($query, $type)
	{
		$type = self::encodeType($type);
		return $type===false ? $query : $query->where('type', $type);
	}


	public function scopeWhereId ($query, $id, $type)
	{
		return $query->where('id', $id)->whereType($type);
	}


	public function scopeWhereUserId ($query, $userId, $type)
	{
		return $query->where('user_id', $userId)->whereType($type);
	}


	### 方法


	protected static function debug_id ($id, $msg='')
	{
		return $id ? true : self::debug($msg.'id未设置。');
	}

	protected static function debug_user_id ($user_id, $msg='') {
		return $user_id ? true : self::debug($msg.'user_id未设置。');
	}

	protected static function debug_type ($type, $msg='', $isReturnVal=false)
	{
		$type = self::encodeType($type);
		return $type===false ? self::debug($msg.'type未设置或无法找到相关配置。') : ($isReturnVal ? $type : true);
	}


	/**
	 * 添加
	 * @return bool
	 * */
	public function add ():bool
	{
		$msg = '添加失败：'.
		$dat = $this->getAttributes();

		if (!self::debug_id($dat['id'], $msg)) {
			return false;
		}

		if (!self::debug_user_id($dat['user_id'],$msg)) {
			return false;
		}

		$dat['type'] = self::debug_type($dat['type'], $msg, true);

		if ($dat['type']===false) {
			return false;
		}

		static::insert($dat);
		return true;
	}


	/**
	 * 删除
	 * @return boolean
	 * */
	public function remove ():bool
	{
		$msg = '删除失败：';

		$dat = $this->getAttributes();

		$dat['type'] = self::debug_type($dat['type']);
		if ($dat['type']===false) {
			return false;
		}

		if ($dat['id']) {
			static::where([
				'id' => $dat['id'],
				'type' => $dat['type'],
			])->delete();
			return true;
		}

		if (isset($dat['user_id'])) {
			static::where([
				'user_id' => $dat['user_id'],
				'type' => $dat['type'],
			])->delete();
			return true;
		}

		return self::debug($msg.'id或user_id至少要设置一项。');


	}



}