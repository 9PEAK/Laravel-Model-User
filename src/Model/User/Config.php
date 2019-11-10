<?php

namespace Peak\Model\User;

final class Config
{


    const USER_TB = '9peak_user';
    const OAUTHER_TB = '9peak_oauther';
    const MODEL_TIMESTAMPS = false;
    const MODEL_FILLABLE = [
        'account' => 'account',
        'pwd' => 'pwd',
        'name' => 'name',
        'photo' => 'photo',
        'intro' => 'intro',
        'top' => 'top',
        'status' => 'status',
    ];
    const MODEL_HIDDEN = [
        'pwd',
        'type',
    ];

}
