<?php

namespace Peak\Model\User;

final class Config
{


    const TB_USER = '9peak_user';
    const TB_OAUTH = '9peak_oauther';
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
