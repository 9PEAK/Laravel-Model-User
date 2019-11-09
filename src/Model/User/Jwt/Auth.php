<?php

namespace Peak\Model\User\Jwt;

use Peak\Model\User\Core as M;

class Auth extends Encryptor
{

    use \Peak\Plugin\Cache\Laravel;


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
     * @param M $user 用户
     * @param string $pref
     */
    public function sign (M $user, $pref='Bearer ')
    {
        self::set_cache($user, $user->id, self::$config['exp']);
        $user = [
            'sub' => $user->id
        ];
        return (string)$pref.self::encode($user);
    }


    /**
     * 验证Token
     * @param string $token
     * @return null|object
     */
    public function check ($token)
    {
        if ($token = self::decode($token)) {
            return self::get_cache($token->sub);
        }
    }


}
