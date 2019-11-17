<?php

namespace Peak\Model\User;

trait OAuther
{


    /**
     * 获取OAuther数据表(与方法同名)
     */
    final protected static function table_oauth ()
    {
        return @static::${__FUNCTION__};
    }


    /**
     * 根据OAuther查找用户
     * @param string $id 关联ID
     * @param int $type 类型
     */
    static function findByOAuther ($id, $type)
    {
        $user = (new static)->getTable();
        $oauth = self::table_oauth();

        return static::query()
            ->select($user.'.*')
            ->join($oauth, $user.'.id', '=', $oauth.'.user_id')
            ->where($oauth.'.type', (int)$type)
            ->where($oauth.'.id', $id)
            ->first();
    }


    /**
     *
     * @param int $type
     */
    public function oauther ($type)
    {

    }


    /**
     * 保存OAuther
     * @param string $id
     * @param int $type 类型
     */
    public function saveOAuther ($id, $type)
    {

        \DB::transaction(function () use (&$id, &$type){
            $this->deleteOAuther($type);

            $qry = \DB::table(self::table_oauth());
            $qry->insert([
                'id' => $id,
                'type' => $type,
                'user_id' => $this->id,
            ]);
        });
    }


    /**
     * 删除OAuther
     * @param int $type 类型
     */
    public function deleteOAuther ($type)
    {
        $qry = \DB::table(self::table_oauth());
        $qry->where('user_id', $this->id)
            ->where('type', $type)
            ->delete();
    }



}
