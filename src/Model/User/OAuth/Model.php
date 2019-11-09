<?php

namespace Peak\Model\User\OAuth;

const TB = '9peak_oauther';

trait Model
{



    /**
     * 根据OAuther查找用户
     * @param string $id 关联ID
     */
    static function findByOAuther ($id)
    {
        $user = (new static)->getTable();
        $oauth = TB;

        return static::query()
            ->select($user.'.*')
//            ->where($oauth.'.type', static::TYPE)
            ->where($oauth.'.id', $id)
            ->join($user, $user.'.id', '=', $oauth.'.user_id')
            ->first();
    }





    public function saveOAuther ($id=null)
    {

        $qry = \DB::table(TB);

        if (isset($id)) {
            $qry->insert([
                'id' => $id,
                'type' => static::TYPE,
                'user_id' => $this->id,
            ]);
        } else {
            $qry->where('id', $id)->delete();
        }


    }



}