<?php

namespace Peak\Model\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Core extends Authenticatable
{
	protected $table = '9peak_user';
	public $timestamps = false;

	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'account' => 'account',
		'pwd' => 'pwd',
		'name' => 'name',
		'photo' => 'photo',
		'intro' => 'intro',
		'top' => 'top',
		'status' => 'status',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'pwd',
		'type',
	];


	protected static function boot()
	{
		parent::boot();

		static::addGlobalScope('type', function (Builder $builder) {
			$builder->where('type', static::TYPE);
		});

		static::saving(function($model) {
			$model->type = static::TYPE;
		});
	}


	protected static function encode_pwd ($pwd)
	{
		return md5($pwd.$pwd);
	}


	/**
	 * 手动设置密码
	 * */
	public function setPwd($pwd)
	{
		$this->pwd = self::encode_pwd($pwd);
		return $this;
	}


	/**
	 * 自动设置密码
	 * */
	public function setPwdAttribute ($pwd)
	{
		$this->attributes['pwd'] = self::encode_pwd($pwd);
	}


	/**
	 * 搜索帐号
	 * */
	static function findAccount ($account)
	{
		return static::where('account', $account)->first();
	}


	### scope查询

	/**
	 * 搜索名字
	 * */
	public function scopeWhereName ($query, $name, $like=false)
	{
		return $like ? $query->where('name', 'like', '%'.$name.'%') : $query->where('name', $name);
	}


	/**
	 * 搜索状态
	 * */
	public function scopeWhereStatus ($query, $status)
	{
		return $query->where('status', $status);
	}

	/**
	 * 搜索用户组
	 * */
	public function scopeWhereGroup ($query, $groupId)
	{
		return $query->where('group_id', $groupId);
	}




}
