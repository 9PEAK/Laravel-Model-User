<?php

namespace Peak\Model\User\Jwt;

use Peak\Model\User\Core as M;

class Auth extends Encryptor
{


    public function login ($account, $pwd, array $condition=null)
    {
        $qry = M::query()->where('account', $account);
        $condition && $qry->where($condition);
        $qry = $qry->first();

        if (!$qry) return self::debug('用户不存在。');

        $x = $qry->pwd;
        $qry->pwd = $pwd;
        return $x==$pwd ? $qry : self::debug('密码不正确。');
    }



    /**
     * 签发Token
     * @param array $payload
     * @param string $pref
     */
    public function sign (array $payload, $pref='Bearer ')
    {
        return (string)$pref.self::encode($payload);
    }


    /**
     * 验证Token
     * @param $token
     * @return bool|object
     */
    public function check ($token)
    {
        return self::decode($token);
    }


}
