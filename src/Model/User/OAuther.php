<?php

namespace Peak\Model\User;

const TB = '9peak_oauther';

trait OAuther
{



    /**
     * 根据OAuther查找用户
     * @param string $id 关联ID
     * @param int $type 类型
     */
    static function findByOAuther ($id, $type)
    {
        $user = (new static)->getTable();
        $oauth = TB;

        return static::query()
            ->select($user.'.*')
            ->where($oauth.'.type', (int)$type)
            ->where($oauth.'.id', $id)
            ->join($user, $user.'.id', '=', $oauth.'.user_id')
            ->first();
    }


    /**
     *
     * @param int $type
     */
    public function oauther ($type)
    {

    }


    public function saveOAuther ($id, $type)
    {

        $qry = \DB::table(TB);

        if (isset($id)) {
            $qry->insert([
                'id' => $id,
                'type' => $type,
                'user_id' => $this->id,
            ]);
        } else {
            $qry->where('id', $id)->delete();
        }

    }



}
