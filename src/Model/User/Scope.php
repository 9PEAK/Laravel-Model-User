<?php

namespace Peak\Model\User;

trait Scope
{



    /**
     * 检测帐号是否存在
     * */
    static function existAccount ($account, $id=0)
    {
        $qry = static::where('account', $account);
        $id && $qry->where('id', '!=', $id);
        return $qry->count();
    }




    /**
     * 搜索帐号
     * */
    static function findAccount ($account)
    {
        return static::where('account', $account)->first();
    }




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
