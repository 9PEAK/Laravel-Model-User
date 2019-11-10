<?php

namespace Peak\Model\User;

trait Attribute
{

    /**
     * 自动设置密码
     * */
    public function setPwdAttribute ($pwd)
    {
        $this->attributes['pwd'] = bcrypt($pwd);
    }







}
