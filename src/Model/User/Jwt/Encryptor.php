<?php

namespace Peak\Model\User\Jwt;

use Firebase\JWT\JWT as X;

class Encryptor
{

    use \Peak\Plugin\Debuger\Base;

    private static $config = [
        'key' => '',
        'alg' => '',
        'exp' => 0,
    ];


    /**
     * Auth constructor.
     * @param string $key 私钥，不可外泄
     * @param int $exp 过期分钟数
     * @param string $alg 算法
     */
    function __construct($key, $exp=60, $alg='HS256')
    {
        self::$config = [
            'key' => (string)$key,
            'alg' => (string)$alg,
            'exp' => (int)$exp*60,
        ];
    }


    /**
     * 加密
     * @param array $payload
     * @return string
     */
    public static function encode (array $payload)
    {

        // 签发时间
        $payload['iat'] = time();
        // 可用起始时间
        $payload['nbf'] = $payload['iat'];
        // 过期时间
        $payload['exp'] = $payload['iat']+self::$config['exp'];

        return X::encode(
            $payload,
            self::$config['key'],
            self::$config['alg']
        );
    }


    /**
     * 解密
     * @param string $token
     */
    public static function decode ($token)
    {
        try {
            return X::decode($token, self::$config['key'], [self::$config['alg']]);
        } catch (\Exception $e) {
            return self::debug($e->getMessage());
        }
    }

}

